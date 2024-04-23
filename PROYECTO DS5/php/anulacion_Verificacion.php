<?php 
require_once "../conexion/conexion.php";
// verificar que optiene datos por el metodo post
if($_SERVER["REQUEST_METHOD"]=="POST"){

 //verifica que los campos no esten vacios
  if(isset($_POST['numeroChequeAnulacion']) && !empty($_POST['numeroChequeAnulacion'])) {


    $numCk= $_POST['numeroChequeAnulacion'];
    //consulta de sql
    $consulta_Ck = 'SELECT * FROM cheques WHERE numero_cheque= ?';


    //if verifica si la consulta preparada tuvo exito
    if($stmt = mysqli_prepare($est, $consulta_Ck)){


      //se añade los parametros
      mysqli_stmt_bind_param($stmt, 's', $numCk);
      mysqli_stmt_execute($stmt);

      //tomo el resultado de la consulta 
      $resultado = mysqli_stmt_get_result($stmt);

      //el numero de filas es igual a 0 entonces enviar mensaje que el cheque no existe
      if(mysqli_num_rows($resultado) == 0){

        echo json_encode('No existe el numero de cheque: '.$numCk);

         
        //elif encaso de que ya este anulado 
      }else{


        //verifica que el cheque no este anulado
        if($resultado['fecha_anulado']=='0000-00-00' || (is_null($resultado['fecha_anulado']))){

          $proveedores = 'SELECT nombre FROM proveedores WHERE codigo= ? ';

          //verificar que la preparacion de consulta tuvo exito
          if($stmt_2 = mysqli_prepare($est, $proveedores)){
  
            mysqli_stmt_bind_param($stmt_2, 's', $resultado['beneficiario']);
            mysqli_stmt_execute($stmt_2);
  
  
            //guardo los resultado de la consulta 
           $resultado_proveedor =mysqli_stmt_get_result($stmt_2);

            //paso los valores en un diccionario
           while($fila = mysqli_fetch_array($resultado)){
            $diccionario =  array(
              'fechaDeAnulacion' => $fila['fecha'],
              'sumaDeAnulacion' => $fila['monto'],
              'detalleDeAnulacion' => $fila['descripcion'],
              );
           }
           //añadi el beneficiario fuera del while, por que es una sola respuesta 
           $diccionario['beneficiarioDeAnulacion'] = $resultado_proveedor['nombre'];

             //envio respuesta a el script
             echo json_encode($diccionario);
           }


       
        }else{

          echo json_encode('El cheque esta anulado');
        }
        

      }


    }else{
      echo json_encode('error: ');
    }


  }else{
    echo json_encode('el numero de cheque esta vacio');
  }

}

?>