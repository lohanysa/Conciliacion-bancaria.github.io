<?php
require_once "../conexion/conexion.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $numCheque = $_POST['numeroDeCheque'];
    // Preparar la consulta SQL para verificar si el número de cheque ya existe
    $stmt = $est->prepare("SELECT * FROM cheques WHERE numero_cheque = ?");
    $stmt->bind_param('s', $numCheque);
    $stmt->execute();

// Obtener el resultado de la consulta
    $result = $stmt->get_result();

// Verificar si el número de filas devueltas es mayor que cero
    if ($result->num_rows > 0) {
    // Si el número de filas devueltas es mayor que cero, significa que el número de cheque ya existe
        echo json_encode('Ese número ya existe');
    } else{
        echo json_encode('');
    }
}
?>


 