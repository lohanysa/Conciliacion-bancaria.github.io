<?php 
include '../conexion/conexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $dia = $_POST['dia'];
    $mes= $_POST['mes'];
    $agno = $_POST['agno'];
    $dia_anterior = $_POST['dia_anterior'];
    $mes_anterior = $_POST['mes_anterior'];
    $agno_anterior = $_POST['agno_anterior'];
    $saldo_anterior =$_POST['saldo_anterior'];
    $masdepositos = $_POST['masdepositos'];
    $maschequesanulados = $_POST['maschequesanulados'];
    $masnotascredito = $_POST['masnotascredito'];
    $masajusteslibro = $_POST['masajusteslibro'];
    $sub1 = $_POST['sub1'];
    $subtotal1 = $_POST['subtotal1'];
    $menoschequesgirados = $_POST['menoschequesgirados'];
    $menosnotasdebito = $_POST['menosnotasdebito'];
    $menosajusteslibro = $_POST['menosajusteslibro'];
    $sub2 = $_POST['sub2'];
    $saldolibros = $_POST['saldolibros'];
    $saldobanco = $_POST['saldobanco'];
    $masdepositostransito = $_POST['masdepositostransito'];
    $menoschequescirculacion = $_POST['menoschequescirculacion'];
    $masajustesbanco = $_POST['masajustesbanco'];
    $sub3 = $_POST['sub3'];

    $sql = "INSERT INTO conciliacion (dia, mes, agno, dia_anterior, mes_anterior, agno_anterior, saldo_anterior, masdepositos, maschequesanulados, masnotascredito, masajusteslibro, sub1, subtotal1, menoschequesgirados, menosnotasdebito, menosajusteslibro, sub2, saldolibros, saldobanco, masdepositostransito, menoschequescirculacion, masajustesbanco, sub3) VALUES ('$dia', '$mes', '$agno', '$dia_anterior', '$mes_anterior', '$agno_anterior', '$saldo_anterior', '$masdepositos', '$maschequesanulados', '$masnotascredito', '$masajusteslibro', '$sub1', '$subtotal1', '$menoschequesgirados', '$menosnotasdebito', '$menosajusteslibro', '$sub2', '$saldolibros', '$saldobanco', '$masdepositostransito', '$menoschequescirculacion', '$masajustesbanco', '$sub3')";
    
// Ejecutar la consulta
if (mysqli_query($est, $sql)) {
    echo json_encode("Los datos se han guardado correctamente.");
} else {
    echo json_encode( "Error: ");
}

    // Cerrar la conexión
    mysqli_close($conexion);

}

?>