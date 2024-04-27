
<?php 
require_once "../conexion/conexion.php";
//verifico que se envie la informacion con el metodo "POST"
if($_SERVER["REQUEST_METHOD"]=="POST"){

    //verifico que la anulacion y el detalle no esten en balnco
    if(isset($_POST['numeroChequeCirculacion']) && isset($_POST['fechaSacarCirculacion'])){
        //preparo la consulta de actualizacion
        $numCk=$_POST['numeroChequeCirculacion'];
        $fecha=$_POST['fechaSacarCirculacion'];
        $actualizar ='UPDATE cheques SET fecha_circulacion = ? WHERE numero_cheque = ?';
        $stmt = mysqli_prepare($est, $actualizar);
        mysqli_stmt_bind_param($stmt, 'sss',$fecha, $numCk);
        if(mysqli_stmt_execute($stmt)){
            echo json_encode('La anulacion es un EXITO');
        }else{
            echo json_encode('La anulacion a FRACASADO');
        }

    }else{
        echo json_encode('no puede dejar la fecha y el detalle de anulacion en blanco');
    }
}
?>