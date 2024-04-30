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
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['mesConciliacion'])&& isset( $_POST['agno'])){
        $mes = $_POST['mesConciliacion'];
        $agno = $_POST['agno'];

        $consulta = 'SELECT * FROM conciliacion WHERE agno= ? AND mes=?';
       $preparado= mysqli_prepare($est, $consulta);
        mysqli_stmt_bind_param($preparado, 'ss',$agno, $mes );
        echo json_encode('estoy en la consulta');
    }else{
        echo json_encode(error_log('Ha ocurrido un error. El año y la fecha están en blanco'));
    }
    
}
?>