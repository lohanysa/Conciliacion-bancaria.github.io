<?php
require_once "../conexion/conexion.php";
# method="post": Este atributo especifica el método HTTP que se utilizará al enviar el formulario. 
#En este caso, está configurado como “post”, lo que significa que los 
#datos del formulario se enviarán al servidor como parte del cuerpo de la solicitud HTTP.
 //$_SERVER["REQUEST_METHOD"]. Luego, se comprueba si el campo 'nombre' está presente en $_POST. 
 
 //Si lo está, se asigna su valor a la variable $nombre, que luego se puede usar según sea necesario. 
 //Si el campo 'nombre' no está presente, se muestra un mensaje indicando que no se ha enviado el campo.
 $numero_cheque = $_POST["numero"];
 $verificarNum = mysqli_prepare($est, 'SELECT numero_cheque FROM cheques WHERE numero_cheque= ?');
 mysqli_stmt_bind_param($verificarNum, 's', $numero_cheque);
 mysqli_stmt_execute($verificarNum);
 $resultado = mysqli_stmt_get_result($verificarNum);
$fila= mysqli_num_rows($resultado) ;
 if($fila > 0) {
    //es buena idea enviarlo como un diccionario :)
        echo json_encode(array('message' => 'El número ' . $numero_cheque . ' ya existe'));
        
        }else{
            try {
                $numero_cheque = $_POST["numero"];
                $fecha = $_POST["fecha"];
                $beneficiario = $_POST["beneficiario"]; 
                $monto = $_POST["monto"]; 
                $descripcion = $_POST["detalle"];
                $codigo_objeto1 = NULL;  
                $monto_objeto1 = 0.0;
                
                $Con_insert = mysqli_query($est, "INSERT INTO cheques (numero_cheque, fecha, beneficiario, monto, descripcion, codigo_objeto1, monto_objeto1) VALUES ('$numero_cheque', '$fecha', '$beneficiario', '$monto', '$descripcion', '$codigo_objeto1', '$monto_objeto1')");
            
                if ($Con_insert) {
                    echo json_encode(array('message' => 'Se ha guardado correctamente el cheque número: ' . $numero_cheque));
                } else {
                    throw new Exception(mysqli_error($est));
                }
            } catch (Exception $e) {
                echo json_encode(array('error' => $e->getMessage()));
            }
            
        }
?>
