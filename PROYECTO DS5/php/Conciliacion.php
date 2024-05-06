<?php
include "../conexion/conexion.php";

/*
CAMPOS DE CONCILIACION BD
 dia
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
                break;
            default:
                $mes_anterior= strval($mes_numero - 1);
                if(($mes_numero - 1)<=9){
                    $mes_anterior ='0'. strval($mes_numero - 1);
                }
        }
        //consulta para saber si existe la conciliacion
        $consulta = 'SELECT * FROM conciliacion WHERE mes=? AND agno=? ';
        $preparado = mysqli_prepare($est, $consulta);
        mysqli_stmt_bind_param($preparado, 'ss', $mes_anterior, $agno_anterior);
        mysqli_stmt_execute($preparado);
        $resultado = mysqli_stmt_get_result($preparado);
        $row = mysqli_fetch_assoc($resultado);

        
        if (mysqli_num_rows($resultado) == 0) {
            echo json_encode('No hay conciliación del mes anterior');
        } else {
            //INFORMACION DEL MES ACTUAL 
            try{
                $consulta_CK=mysqli_execute_query($est, 'SELECT fecha, monto FROM cheques WHERE fecha ="'.$mes_actual.'"');//TRAE EL CHEQUE DEL MES ACTUAL
                $consulta_CK_anulados =$est->query('SELECT fecha_anulado, monto FROM cheques WHERE fecha_anulado="'.$mes_actual.'"');//TRAE MONTO Y FECHA DE LOS ANULADOS
                $consulta_CK_circulacion=$est->query('SELECT fecha_circulacion, monto FROM cheques WHERE fecha_circulacion="'.$mes_actual.'"');//TRAE MONTO Y FECHA DE CIRCULACION
                $consulta_Transacciones = $est->query('SELECT fecha, monto FROM otros WHERE fecha="'.$mes_actual.'"');//TRAE LAS TRANSACCIONES HECHAS 
                $consulta_meses = $est->query('SELECT dia, mes, nombre_mes FROM meses WHERE mes="'.$mes_actual.'"');//TRAE LOS DIAS, Y MESES (PARA GUANDAR EL DIA Y MES QUE SE HACE LA CONCILIACION)
    
    
    
                /****RESULTADOS DEL QUERYN */
                $resultado_CK = mysqli_fetch_assoc($consulta_CK);
                $resultado_CK_anulados = mysqli_fetch_assoc($consulta_CK_anulados);
                $resultado_CK_circulacion = mysqli_fetch_assoc($consulta_CK_circulacion);
                $resultado_Transacciones =mysqli_fetch_assoc($consulta_Transacciones);
                $resultado_meses = mysqli_fetch_assoc($consulta_meses);
            }catch(Exception $e){
                print json_encode("Hubo un error: ".$e->getMessage()."En la linea: ".$e->getLine());
            }
           
            /***SUMAR **/
            $suma_CK_creados=0;
            $suma_CK_anulados =0;
            $suma_CK_circulacion =0;
            $suma_CK_transaccion =0;
            
            // Sumar los cheques creados del mes actual
            while ($resultado_CK && $resultado_CK_anulados && $resultado_CK_circulacion && $resultado_Transacciones) {
                // Verificar si hay más filas disponibles en cada resultado
                if ($resultado_CK) {
                    $suma_CK_creados += $resultado_CK['monto'];
                    $resultado_CK = mysqli_fetch_assoc($consulta_CK);
                }
                if ($resultado_CK_anulados) {
                    $suma_CK_anulados += $resultado_CK_anulados['monto'];
                    $resultado_CK_anulados = mysqli_fetch_assoc($consulta_CK_anulados);
                }
                if ($resultado_CK_circulacion) {
                    $suma_CK_circulacion +=  $resultado_CK_circulacion['monto'];
                    $resultado_CK_circulacion = mysqli_fetch_assoc($consulta_CK_circulacion);
                }
                if ($resultado_Transacciones) {
                    $suma_CK_transaccion += $resultado_Transacciones['monto'];
                    $resultado_Transacciones = mysqli_fetch_assoc($consulta_Transacciones);
                }
            }

            //VOY A GUARDAR TODOS LOS LAS OPERACIONES EN UN DICCIONARIO DE DICCIONARIO
            $diccionario = array(
                'sumas'=> array(
                    'suma_CK_creados' => $suma_CK_creados,
                    'suma_CK_anulados' => $suma_CK_anulados,
                    'suma_CK_circulacion' => $suma_CK_circulacion,
                    'suma_CK_transaccion' =>  $suma_CK_transaccion
                ),



                'fecha' => array(
                    'dia' => $resultado_meses['dia'],
                    'mes' => $resultado_meses['mes'],
                    'nombre_mes' =>  $resultado_meses['nombre_mes']
                )

                );
            


            //echo json_encode('valores de la tabla: '. $row['mes'] . $row['agno'] .'valores que calculo: '.$mes . $agno);
           /* $diccionario = array(
                'agno' =>$row['agno'],
                'dia' => $row['dia'],
                'mes' => $row['mes'],
                'dia_anterior' => $row['dia_anterior'],
                'mes_anterior' => $row['mes_anterior'],
                'agno_anterior' => $row['agno_anterior'],
                'saldo_anterior' => $row['saldo_anterior'],
                'masdepositos' => $row['masdepositos'],
                'maschequesanulados' => $row['maschequesanulados'],
                'masnotascredito' => $row['masnotascredito'],
                'masajusteslibro' => $row['masajusteslibro'],
                'sub1' => $row['sub1'],
                'subtotal1' => $row['subtotal1'],
                'menoschequesgirados' => $row['menoschequesgirados'],
                'menosnotasdebito' => $row['menosnotasdebito'],
                'menosajusteslibro' => $row['menosajusteslibro'],
                'sub2' => $row['sub2'],
                'saldolibros' => $row['saldolibros'],
                'saldobanco' => $row['saldobanco'],
                'masdepositostransito' => $row['masdepositostransito'],
                'menoschequescirculacion' => $row['menoschequescirculacion'],
                'masajustesbanco' => $row['masajustesbanco'],
                'sub3' => $row['sub3']
            );


            echo json_encode($diccionario);*/
        }
    }else {
        echo json_encode('Ha ocurrido un error. El año y la fecha están en blanco');
    }
}




?>