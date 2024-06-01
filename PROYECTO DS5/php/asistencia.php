<?php 
require_once "../conexion/conexion.php";
    moverarchivo();
    $datos_file = array();

    function moverArchivo(){
    if(isset($_FILES['archivo'])){
        //colocar un try catch para mover el archivo
        $directorioDestino = "../html/uploads/";
        $archivoSubido = $directorioDestino . basename($_FILES['archivo']['name']);


        // Intenta mover el archivo de la vista cliente a tu directorio uploads
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $archivoSubido)) {

            $archivo = file(
                "../html/uploads/asistencia.dat",
                FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES
            );

    
            foreach ($archivo as $linea) {
                /*explode() divide una cadena en un array, utilizando otro string como delimitador.
                    En este caso, la cadena $linea se dividirá en elementos de un array cada vez que encuentre una
                    tabulación ("\t"). 
                Los elementos resultantes se almacenarán en la variable $datos.*/

                if (!empty(trim($linea))) {
                    $datos = explode("\t", trim($linea));
                    
                    foreach($datos as $clave =>$valor){
                        switch ($clave){
                            case 1:
                                $datos_file[$clave] = explode(" ",trim($valor));
                                break;
                            default:
                                $datos_file[$clave] = $valor;
                        }
                            
                    }
                    MariaDB($datos_file);
                
                }
                
            
             }
            
             echo json_encode("Se han guardado los datos");

        } else {
             echo json_encode("Hubo un error subiendo el archivo.");
        }


    } else {
        echo json_encode("El archivo está vacío.");
    }

}
    
    
    function MariaDB($datos_file){
    global $est; 
    $consulta = "INSERT INTO datos VALUES (?,?,?,?,?,?,?)";
    if($stmt = mysqli_prepare($est,$consulta)){
        mysqli_stmt_bind_param($stmt, 'sssssss', $datos_file[0], $datos_file[1][0],
        $datos_file[1][0], $datos_file[2], $datos_file[3], $datos_file[4], $datos_file[5]);
        $stmt->execute();
    }

    //print_r($datos_file);
    
    
    } /*  phpMyAdmin intentó conectarse con el servidor MySQL, y el servidor rechazó esta conexión.
     Deberá revisar el host, nombre de usuario y contraseña en config.inc.php y 
    asegurarse que corresponden con la información provista por el administrador del servidor MySQL. */
    
    


?>