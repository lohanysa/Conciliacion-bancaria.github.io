<?php 
//echo 'ola estoy en grabar';
require_once "../conexion/conexion.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $numCheque = $_POST['numeroDeCheque'];
    $fecha = $_POST["fechaDeCheque"];
    $beneficiario = $_POST["beneficiarioDeCheque"];
    $monto = $_POST["sumaDeCheque"];
    $detalle = $_POST["detalleDeCheque"];
    $objetoGasto = $_POST["objetoDeCheque"];
    $montoObjeto = $_POST["montoDeCheque"];
    $consulta = "INSERT INTO cheques (numero_cheque, fecha, beneficiario, monto, descripcion, codigo_objeto1, monto_objeto1) VALUES (?, ?, ?, ?, ?, ?, ?)";
   
    if($stmt = mysqli_prepare($est, $consulta)){
      mysqli_stmt_bind_param($stmt, 'sssssss', $numCheque, $fecha, $beneficiario, $monto, $detalle, $objetoGasto, $montoObjeto);
      
      if(mysqli_stmt_execute($stmt)){
              echo json_encode('se a guardado con exito el cheque numero:'.$numCheque);
           }else{
              echo json_encode('error:'.mysqli_stmt_errno($stmt));
           }
      }else{
         echo json_encode('error en la preraracion de la consulta: '.mysqli_stmt_errno($stmt));
      }
    }
   

    $est->close();
?>
