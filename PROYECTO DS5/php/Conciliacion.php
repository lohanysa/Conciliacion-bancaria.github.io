<?php
include "../conexion/conexion.php";

/*
CAMPOS DE CONCILIACION BD
dia 1	
mes	
agno	
dia_anterior	
mes_anterior	
agno_anterior	
saldo_anterior	
masdepositos	
maschequesanulados	
masnotascredito	
masajusteslibro	
sub1	
subtotal1	
menoschequesgirados	
menosnotasdebito	
menosajusteslibro	
sub2	
saldolibros	
saldobanco	
masdepositostransito	
menoschequescirculacion	
masajustesbanco	
sub3	
saldo_conciliado
 */
/*****
 //CAMPOS DE CHEQUES BD
 numero_cheque 
 fecha
 beneficiario
 monto
 descripcion
 fecha_anulado
 detalle_anulado
 fecha_circulacion
 fecha_reintegro
 codigo_objeto1
 monto_objeto1

 //TABLA OTROS
  transaccion
 fecha
 monto

 //TABLA DE MESES
  mes
 nombre_mes
 dia
 abreviatura
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    if (isset($_POST['mesConciliacion']) && isset($_POST['agno'])) {
        //PRIMERO SE VERIFICA QUE EXISTA UNA CONCILIACION DEL MES ANTERIOS Y SE GUARDA
        $mes_actual = $_POST['mesConciliacion'];
        $agno = $_POST['agno'];
        $mes_numero = intval($mes_actual);
        $agno_numero = intval($agno);
        // para que se pueda hacer la conciliación, debe haber una conciliación del mes anterior 
        switch ($mes_numero) {
            case '01': // Cambiado a cadena
                $mes_anterior = '12';
                $agno_anterior = strval($agno_numero - 1);
                $fechas_anteriores =mysqli_fetch_assoc($est->query('SELECT nombre_mes FROM meses WHERE mes = "'.$mes_anterior.'"'));
                break;
            default:
                $mes_anterior= strval($mes_numero - 1);
                $agno_anterior =  strval($agno_numero);
                if(($mes_numero - 1)<=9){
                    $mes_anterior ='0'. strval($mes_numero - 1);
                }
                $fechas_anteriores =mysqli_fetch_assoc($est->query('SELECT * FROM meses WHERE mes = "'.$mes_anterior.'"'));
        }
        //consulta para saber si existe la conciliacion
        $consulta = 'SELECT * FROM conciliacion WHERE mes=? AND agno=? ';
        $preparado = mysqli_prepare($est, $consulta);
        mysqli_stmt_bind_param($preparado, 'ss', $mes_anterior, $agno_anterior);
        mysqli_stmt_execute($preparado);
        $resultado = mysqli_stmt_get_result($preparado);
        $row = mysqli_fetch_assoc($resultado);

        
        if (mysqli_num_rows($resultado) == 0) {
            echo json_encode('No hay conciliación del mes anterior ');
        } else {
            //INFORMACION DEL MES ACTUAL 
            try{
                $consulta_CK=$est->query('SELECT fecha, monto FROM cheques WHERE EXTRACT(YEAR FROM fecha) = ' . $agno . ' AND EXTRACT(MONTH FROM fecha) = ' . $mes_actual);//TRAE EL CHEQUE DEL MES ACTUAL
                $consulta_CK_anulados =$est->query('SELECT fecha_anulado, monto FROM cheques WHERE EXTRACT(YEAR FROM fecha_anulado) = ' . $agno . ' AND EXTRACT(MONTH FROM fecha_anulado) = ' . $mes_actual);//TRAE MONTO Y FECHA DE LOS ANULADOS
                $consulta_CK_circulacion=$est->query('SELECT fecha_circulacion, monto FROM cheques WHERE EXTRACT(YEAR FROM fecha_circulacion) = ' . $agno . ' AND EXTRACT(MONTH FROM fecha_circulacion) = ' . $mes_actual);//TRAE MONTO Y FECHA DE CIRCULACION
                $consulta_transacciones = $est->query("SELECT transaccion, SUM(monto) AS total_monto FROM otros WHERE EXTRACT(YEAR FROM fecha) = " . $agno . " AND EXTRACT(MONTH FROM fecha) = " . $mes_actual);
                $consulta_meses = $est->query('SELECT dia, mes, nombre_mes FROM meses WHERE mes="'.$mes_actual.'"');//TRAE LOS DIAS, Y MESES (PARA GUANDAR EL DIA Y MES QUE SE HACE LA CONCILIACION)
    
    
    
                /****RESULTADOS DEL QUERYN */
                $ultimo_saldo_conciliado = $row['saldo_conciliado'];
                $resultado_CK = mysqli_fetch_assoc($consulta_CK);
                $resultado_CK_anulados = mysqli_fetch_assoc($consulta_CK_anulados);
                $resultado_CK_circulacion = mysqli_fetch_assoc($consulta_CK_circulacion);
                $resultado_meses = mysqli_fetch_assoc($consulta_meses);
                $resultado_transacciones =mysqli_fetch_assoc($consulta_transacciones);

                
            }catch(Exception $e){
                print json_encode("Hubo un error: ".$e->getMessage()."En la linea: ".$e->getLine());
            }
            
            /***SUMAR **/
       // Inicializar las sumas
            $suma_CK_creados = 0;
            $suma_CK_anulados = 0;
            $suma_CK_circulacion = 0;

            // Sumar los cheques creados del mes actual
            while ($resultado_CK = mysqli_fetch_assoc($consulta_CK)) {
                $suma_CK_creados += $resultado_CK['monto'];
            }

            // Sumar los cheques anulados del mes actual
            while ($resultado_CK_anulados = mysqli_fetch_assoc($consulta_CK_anulados)) {
                $suma_CK_anulados += $resultado_CK_anulados['monto'];
            }

            // Sumar los cheques en circulación del mes actual
            mysqli_data_seek($consulta_CK_circulacion, 0);
            while ($resultado_CK_circulacion = mysqli_fetch_assoc($consulta_CK_circulacion)) {
                $suma_CK_circulacion += $resultado_CK_circulacion['monto'];
            }

            //VOY A GUARDAR TODOS LOS LAS OPERACIONES EN UN DICCIONARIO DE DICCIONARIO
            $diccionario = array(
                'segunda_columna'=> array(
                    'suma_CK_creados' => $suma_CK_creados,
                    'suma_CK_anulados' => $suma_CK_anulados,
                    'suma_CK_circulacion' => $suma_CK_circulacion,
                ),

                'fecha' => array(
                    'dia' => $resultado_meses['dia'],//dia actual
                    'mes' => $resultado_meses['nombre_mes'],//mes actual
                    'año_actual' => $agno,
                    'nombre_mes' =>  $fechas_anteriores['nombre_mes'],//mes anterior
                    'mes_anterior' => $mes_anterior,//numero del mes anterior
                    'agno_anterior' =>$agno_anterior, //año anterior
                    'dia_anterior' => $fechas_anteriores['dia'] //dia del mes anterior
                ),

                'ultima_conciliacion'=> $ultimo_saldo_conciliado
                );


                
                if ($consulta_transacciones->num_rows > 0) {
                    // Inicializar las claves dentro del diccionario para las transacciones
                    $diccionario['mas_depositos'] = 0;
                    $diccionario['mas_notas_credito'] = 0;
                    $diccionario['mas_ajustes_libro'] = 0;
                    $diccionario['menos_notas_debito'] = 0;
                    $diccionario['menos_ajustes_libro'] = 0;
                    $diccionario['mas_depositos_transito'] = 0;
                    $diccionario['mas_ajustes_banco'] = 0;
                
                    while ($resultado_transacciones = mysqli_fetch_assoc($consulta_transacciones)) {
                        $transaccion_codigo = $resultado_transacciones["transaccion"];
                        $monto_transaccion = $resultado_transacciones["total_monto"];
                
                        // Asignar el valor de la transacción al array $diccionario, incluyendo 0
                        switch ($transaccion_codigo) {
                            case "1":
                                $diccionario['mas_depositos'] += $monto_transaccion;
                                break;
                            case "2":
                                $diccionario['mas_notas_credito'] += $monto_transaccion;
                                break;
                            case "3":
                                $diccionario['mas_ajustes_libro'] += $monto_transaccion;
                                break;
                            case "4":
                                $diccionario['menos_notas_debito'] += $monto_transaccion;
                                break;
                            case "5":
                                $diccionario['menos_ajustes_libro'] += $monto_transaccion;
                                break;
                            case "6":
                                $diccionario['mas_depositos_transito'] += $monto_transaccion;
                                break;
                            case "7":
                                $diccionario['mas_ajustes_banco'] += $monto_transaccion;
                                break;
                            // Puedes agregar más casos según sea necesario
                        }
                    }
                }
            
                
                echo json_encode($diccionario);


        }
    }else {
        echo json_encode('Ha ocurrido un error. El año y la fecha están en blanco');
    }
}




?>