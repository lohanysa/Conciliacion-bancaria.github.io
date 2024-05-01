<?php
include "../conexion/conexion.php";

/*
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['mesConciliacion']) && isset($_POST['agno'])) {
        $mes = $_POST['mesConciliacion'];
        $agno = $_POST['agno'];
        $mes_numero = intval($mes);
        $agno_numero = intval($agno);
        // para que se pueda hacer la conciliación, debe haber una conciliación del mes anterior 
        switch ($mes_numero) {
            case '01': // Cambiado a cadena
                $mes = '12';
                $agno = strval($agno_numero - 1);
                break;
            default:
                $mes = strval($mes_numero - 1);
                if(($mes_numero - 1)<=9){
                    $mes ='0'. strval($mes_numero - 1);
                }
        }

        $consulta = 'SELECT * FROM conciliacion WHERE mes=? AND agno=? ';
        $preparado = mysqli_prepare($est, $consulta);
        mysqli_stmt_bind_param($preparado, 'ss', $mes, $agno);
        mysqli_stmt_execute($preparado);
        $resultado = mysqli_stmt_get_result($preparado);
        $row = mysqli_fetch_assoc($resultado);

        
        if (mysqli_num_rows($resultado) == 0) {
            echo json_encode('No hay conciliación del mes anterior: '.$mes);
        } else {
            //echo json_encode('valores de la tabla: '. $row['mes'] . $row['agno'] .'valores que calculo: '.$mes . $agno);
            $diccionario = array(
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


            echo json_encode($diccionario);
        }
    } else {
        echo json_encode('Ha ocurrido un error. El año y la fecha están en blanco');
    }
}




?>