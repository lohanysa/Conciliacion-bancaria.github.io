<?php 
include '../conexion/conexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

   
    $saldo_conciliado_cadena = $_POST['saldo_conciliado'];
    $saldo_conciliado_2 = $_POST['saldo_conciliado_2'];
    
    // Dividir la cadena para obtener los valores individuales
    $partes_conciliado = explode(' ', $saldo_conciliado_cadena);
    $partes_conciliado_2 = explode(' ', $saldo_conciliado_2);
    
    // Obtener los valores específicos
    $dia = intval($partes_conciliado[5]);
    $mes = intval(date('m', strtotime($partes_conciliado[7])));
    $agno = intval($partes_conciliado[9]);
    $dia_anterior = intval($partes_conciliado_2[5]);
    $mes_anterior = intval(date('m', strtotime($partes_conciliado_2[7])));
    $agno_anterior = intval($partes_conciliado_2[9]);
    



$saldo_anterior = doubleval($_POST['saldo_anterior']);
$masdepositos = doubleval($_POST['masdepositos']);
$maschequesanulados = doubleval($_POST['maschequesanulados']);
$masnotascredito = doubleval($_POST['masnotascredito']);
$masajusteslibro = doubleval($_POST['masajusteslibro']);
$sub1 = doubleval($_POST['sub1']);
$subtotal1 = doubleval($_POST['subtotal1']);
$menoschequesgirados = doubleval($_POST['menoschequesgirados']);
$menosnotasdebito = doubleval($_POST['menosnotasdebito']);
$menosajusteslibro = doubleval($_POST['menosajusteslibro']);
$sub2 = doubleval($_POST['sub2']);
$saldolibros = doubleval($_POST['saldolibros']);
$saldobanco = doubleval($_POST['saldobanco']);
$masdepositostransito = doubleval($_POST['masdepositostransito']);
$menoschequescirculacion = doubleval($_POST['menoschequescirculacion']);
$masajustesbanco = doubleval($_POST['masajustesbanco']);
$sub3 = doubleval($_POST['sub3']);
$saldo_conciliado = doubleval($_POST['saldo_igualado']);
try{
    $sql = "INSERT INTO conciliacion (dia, mes, agno, dia_anterior, mes_anterior, agno_anterior, saldo_anterior, masdepositos, maschequesanulados, masnotascredito, masajusteslibro, sub1, subtotal1, menoschequesgirados, menosnotasdebito, menosajusteslibro, sub2, saldolibros, saldobanco, masdepositostransito, menoschequescirculacion, masajustesbanco, sub3, saldo_conciliado) VALUES ('$dia', '$mes', '$agno', '$dia_anterior', '$mes_anterior', '$agno_anterior', '$saldo_anterior', '$masdepositos', '$maschequesanulados', '$masnotascredito', '$masajusteslibro', '$sub1', '$subtotal1', '$menoschequesgirados', '$menosnotasdebito', '$menosajusteslibro', '$sub2', '$saldolibros', '$saldobanco', '$masdepositostransito', '$menoschequescirculacion', '$masajustesbanco', '$sub3', '$saldo_conciliado')";
    if(mysqli_query($est, $sql)){
        echo json_encode('Se ha guardado exitosamente');
    } else {
            echo json_encode('Error al insertar datos: ' . mysqli_error($est));
        }

}catch (Exception $e){
    echo json_encode('error:  ' .$e->getMessage());
}
    


    // Cerrar la conexión
    mysqli_close($est);

}

?>