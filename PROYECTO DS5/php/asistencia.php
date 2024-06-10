<?php 
require_once "../conexion/conexion.php";
//este archivo se llama dos veces, hice verificaciones para identificar las funciones que se deben
//ejecutar en cada llama;

if (isset($_FILES['archivo'])) {
    // Cuando se sube un archivo, la ejecución inicia aquí 
    moverArchivo();
}

function moverArchivo() {
    global $datos_file, $est;

    if (isset($_FILES['archivo'])) {
        try {
            $directorioDestino = "../html/uploads/";
            $nombreArchivo = basename($_FILES['archivo']['name']);
            $archivoSubido = $directorioDestino . $nombreArchivo;
    
            // Verificar si el archivo ya existe
            if (!file_exists($archivoSubido)) {
                // Intenta mover el archivo de la vista cliente a tu directorio uploads
                if (move_uploaded_file($_FILES['archivo']['tmp_name'], $archivoSubido)) {
                    $archivo = file($archivoSubido, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
    
                    // Iniciar transacción
                    mysqli_begin_transaction($est);
    
                    foreach ($archivo as $linea) {
                        if (!empty(trim($linea))) {
                            $datos = explode("\t", trim($linea));
    
                            foreach ($datos as $clave => $valor) {
                                switch ($clave) {
                                    case 1:
                                        $datos_file[$clave] = explode(" ", trim($valor));
                                        break;
                                    default:
                                        $datos_file[$clave] = $valor;
                                }
                            }
    
                            // Función para guardar los datos
                            MariaDB($datos_file);
                        }
                    }
    
                    // Commit de la transacción
                    mysqli_commit($est);
    
                    echo json_encode("Se han guardado los datos");
                } else {
                    echo json_encode("Hubo un error subiendo el archivo.");
                }
            } else {
                echo json_encode("El archivo ya existe.");
            }
        } catch (Exception $e) {
            // Rollback de la transacción en caso de error
            mysqli_rollback($est);
            echo json_encode("Error: " . $e->getMessage());
        }
    } else {
        echo json_encode("El archivo está vacío.");
    }
}

function MariaDB($datos_file) {
    global $est;

    $consulta = "INSERT INTO datos VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($est, $consulta)) {
        mysqli_stmt_bind_param($stmt, 'sssssss',
            $datos_file[0],
            $datos_file[1][0],
            $datos_file[1][1],
            $datos_file[2],
            $datos_file[3],
            $datos_file[4],
            $datos_file[5]
        );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode("Error en la preparación de la consulta: " . mysqli_error($est));
    }
}


    //print_r($datos_file);
    
         /*  phpMyAdmin intentó conectarse con el servidor MySQL, y el servidor rechazó esta conexión.
     Deberá revisar el host, nombre de usuario y contraseña en config.inc.php y 
    asegurarse que corresponden con la información provista por el administrador del servidor MySQL. */
    





?>