<?php 



/*******************************ESTE SACA DE CIRCULACION EL CHEQUE****************************************/


require_once "../conexion/conexion.php";
//verifico que se envie la informacion con el metodo "POST"
if($_SERVER["REQUEST_METHOD"]=="POST"){

    //verifico que la anulacion y el detalle no esten en balnco
    if(isset($_POST['fechaSacarCirculacion'])){
        //preparo la consulta de actualizacion
        $numCk=$_POST['numeroChequeCirculacion'];
        $fecha=$_POST['fechaSacarCirculacion'];
        $actualizar ='UPDATE cheques SET fecha_circulacion = ? WHERE numero_cheque = ?';
        $stmt = mysqli_prepare($est, $actualizar);
        mysqli_stmt_bind_param($stmt, 'ss',$fecha, $numCk);
        if(mysqli_stmt_execute($stmt)){
            echo json_encode('Se a sacado de circulacion con EXITO');
        }else{
            echo json_encode('a FRACASADO la operacion');
        }

    }else{
        echo json_encode('No puede dejar la fecha en blanco');
    }
}
?>