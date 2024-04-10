<?php
require_once "../conexion/conexion.php";

echo 'estoy en grabarCheque';
 //$_SERVER["REQUEST_METHOD"]. Luego, se comprueba si el campo 'nombre' está presente en $_POST. 
 //Si lo está, se asigna su valor a la variable $nombre, que luego se puede usar según sea necesario. 
 //Si el campo 'nombre' no está presente, se muestra un mensaje indicando que no se ha enviado el campo.
 if($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_cheque = $_POST["numero"];
    $fecha = $_POST["fecha"];
    $beneficiario = $_POST["beneficiario"]; 
    $monto = $_POST["monto"]; 
    $descripcion = $_POST["detalle"];
    $codigo_objeto1 = NULL;  
    $monto_objeto1 = 0.0;
    echo $monto;
        $Con_insert = mysqli_query($est ,"INSERT INTO cheques (numero_cheque, fecha, beneficiario, monto, descripcion, codigo_objeto1, monto_objeto1) VALUES ('$numero_cheque', '$fecha' , ' $beneficiario' , ' $monto' , '$descripcion' , '$codigo_objeto1' , '$monto_objeto1')");
       
        
        }
?>
