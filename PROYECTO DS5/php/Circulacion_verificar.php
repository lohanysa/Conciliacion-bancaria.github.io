<?php

/*********************************ESTO TRAE LOS DATOS DEL CHEQUE****************************************/


require_once "../conexion/conexion.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['numeroChequeCirculacion']) && !empty($_POST['numeroChequeCirculacion'])) {


        $numCk= $_POST['numeroChequeCirculacion'];
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
    
             
            //else encaso de que ya este anulado 
          }else{
            // Obtener una fila de resultados como un array asociativo
              $fila_resultado = mysqli_fetch_assoc($resultado);
    
            //verifica que el cheque no este anulado
            if( $fila_resultado['fecha_circulacion']=='0000-00-00' || (is_null( $fila_resultado['fecha_circulacion']))){
    
              $proveedores = 'SELECT nombre,codigo FROM proveedores WHERE codigo= ? ';
    
              //verificar que la preparacion de consulta tuvo exito
              if($stmt_2 = mysqli_prepare($est, $proveedores)){
    
    
                $beneficiario = $fila_resultado['beneficiario'];
    
                mysqli_stmt_bind_param($stmt_2, 's', $beneficiario);
                mysqli_stmt_execute($stmt_2);
      
      
                //guardo los resultado de la consulta 
               $resultado_proveedor =mysqli_stmt_get_result($stmt_2);
                //paso los resultados a un array asociativo
                $fila_proveedor= mysqli_fetch_assoc($resultado_proveedor);
    
    
                /*******************ESTA PARTE ES PARA MANDAR LOS DATOS AL JS *********************************/
    
    
    
                // Construir el diccionario
                $diccionario = array(
                  'fechaDeSacarCirculacion' => $fila_resultado['fecha'],
                  'sumaDeSacarCirculacion' => $fila_resultado['monto'],
                  'descripcionSacarCirculacion' => $fila_resultado['descripcion'],
                  //'beneficiarioDeAnulacion' => $fila_resultado['beneficiario']
              );
    
    
              //beneficiario lo guardo aparte porque por alguna razon dice que esta null, voy hacer una condicion 
              //para ese error
    
              if($fila_proveedor) {
               // Verificar si el campo 'nombre' está presente y no es nulo
               if(isset($fila_proveedor['nombre']) && $fila_proveedor['nombre'] !== null) {
                // Si el campo 'nombre' no es nulo, asignarlo al diccionario
                 $diccionario['pagueseSacarCirculacion'] = $fila_proveedor['nombre'];
              } else {
                // Si el campo 'nombre' es nulo, asignar un valor predeterminado
                $diccionario['pagueseSacarCirculacion'] = "Nombre no disponible";
                }
              }else {
              // Si la consulta no devolvió ninguna fila, asignar un valor predeterminado
              $diccionario['pagueseSacarCirculacion'] = "No se encontró beneficiario";
          }   
              // Enviar respuesta al script
              echo json_encode($diccionario);
               }
           
            }else{
              echo json_encode('El cheque esta fuera de circulacion');
            }
            
    
          }
    
    
        }else{
          echo json_encode('Hubo un error');
        }
    
    
      }else{
        echo json_encode('el numero de cheque esta vacio');
      }
    
}


?>




