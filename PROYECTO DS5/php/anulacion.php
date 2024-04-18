<?php 
require_once "../conexion/conexion.php";
$num_cheque =$_POST['noCheque'];
 $consul_beneficiario = mysqli_query($est,'SELECT codigo, nombre FROM proveedores WHERE codigo = "'. $num_cheque.'"');
 $consulta = mysqli_prepare($est, 'SELECT cheques.numero_cheque, cheques.fecha, cheques.beneficiario, cheques.monto, cheques.descripcion
                            WHERE cheques.numero_cheque = ?');

mysqli_stmt_bind_param($consulta, 's', $num_cheque);
mysqli_stmt_execute($consulta);
$resultado = mysqli_stmt_get_result($consulta);
$num_filas = mysqli_num_rows($resultado);

 if($num_filas>0){
   while($fila = mysqli_fetch_array($resultado)){
      $fila_dict = array(
         'fecha' => $fila['fecha'],
         'beneficiario' => $consul_beneficiario['beneficiario'],// nombre de proveedores
         'suma' => $fila['monto'],
         'descripcion' => $fila['descripcion']
     );
     echo json_encode( $fila_dict);
   }
 }else{
   echo json_encode("");
 }
  

?>