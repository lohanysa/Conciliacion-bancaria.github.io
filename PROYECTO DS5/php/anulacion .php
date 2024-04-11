<?php 
require_once "../conexion/conexion.php";
 $num_cheque =(string) $_POST['noCheque'];
 
 $consulta = mysqli_prepare($est,'SELECT numero_cheque, fecha, beneficiario, monto,descripcion FROM cheques WHERE numero_cheque = ?');
 mysqli_stmt_bind_param($consulta,'s',$num_cheque);
 mysqli_stmt_execute($consulta);
 $resultado = mysqli_stmt_get_result($consulta);
 $num_filas = mysqli_num_rows($resultado);

 if($num_filas>0){
   while($fila = mysqli_fetch_array($resultado)){
      $fila_dict = array(
         'fecha' => $fila['fecha'],
         'paguese' => $fila['beneficiario'],
         'suma' => $fila['monto'],
         'descripcion' => $fila['descripcion']
     );
     echo json_encode( $fila_dict);
   }
 }else{
   echo json_encode("");
 }
?>