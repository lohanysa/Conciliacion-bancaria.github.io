<?php 
require_once "../conexion/conexion.php";
if (isset($_POST['envia'])) {
    moverarchivo();
}

function moverArchivo(){
    if(isset($_FILES['archivo'])){
        $directorioDestino = "../html/uploads/";
        $archivoSubido = $directorioDestino . basename($_FILES['archivo']['name']);
    
        // Intenta mover el archivo de la vista cliente a tu directorio uploads
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $archivoSubido)) {
            echo json_encode("El archivo ha sido subido con éxito.");
        } else {
            echo json_encode("Hubo un error subiendo el archivo.");
        }
    } else {
        echo json_encode("El archivo está vacío.");
    }

}

function subirMaria(){
    
}


?>