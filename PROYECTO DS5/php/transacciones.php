<?php 
 include "../conexion/conexion.php";

 if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['fechaOtrasTrans']) && isset($_POST['montoOtrasTrans'])){

        $fecha = $_POST['fechaOtrasTrans'];
        $monto = $_POST['montoOtrasTrans'];
        $codigo =  $_POST['transaccionOtrasTrans'];

        $consulta= "INSERT INTO otros (transaccion, fecha, monto)  VALUES (?, ?, ?)";;

        $stmt= mysqli_prepare($est, $consulta);

        mysqli_stmt_bind_param($stmt, 'ssd',$codigo, $fecha, $monto);

        //***************EN CASO QUE LA CONSULTA FALLE*************************************

        if(mysqli_stmt_execute($stmt)){

            echo json_encode('la transaccion fue un EXITO');
        }else{
            echo json_encode('hubo un error en la transaccion: '. mysqli_stmt_errno($stmt));
        }
        
    }else{
        echo json_encode('la fecha y el monto no puede estar vacio, llene todos los campos');
    }
 }

?>