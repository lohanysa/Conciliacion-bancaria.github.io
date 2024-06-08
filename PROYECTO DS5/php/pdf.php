<?php 
require ('tcpdf/tcpdf.php');
require_once "../conexion/conexion.php";

// Verificar que los datos sean enviados correctamente

if (!isset($_POST["codigo"]) || !isset($_POST["inicio"]) || !isset($_POST["final"])) {
    echo json_encode('Error: Datos incompletos.');
    exit;
}

// Preparar consulta SQL
$consulta_nombre = "SELECT nombre1, apellido1, codigo_marcacion FROM rrhh WHERE codigo_marcacion = ?";
$stmt_nom = mysqli_prepare($est, $consulta_nombre);
mysqli_stmt_bind_param($stmt_nom, "s", $_POST["codigo"]);
mysqli_stmt_execute($stmt_nom);
$nombre = mysqli_stmt_get_result($stmt_nom);
while ($row = mysqli_fetch_assoc($nombre)) {
    $nombre_completo = $row['apellido1'] . ' ' . $row['nombre1'];
}

$consulta = "SELECT 
    codigo, 
    DATE_FORMAT(fecha, '%d - %m - %Y') AS fecha_formateada, 
    CASE DAYNAME(fecha)
        WHEN 'Monday' THEN 'Lun'
        WHEN 'Tuesday' THEN 'Mart'
        WHEN 'Wednesday' THEN 'Mier'
        WHEN 'Thursday' THEN 'Jue'
        WHEN 'Friday' THEN 'Vier'
        WHEN 'Saturday' THEN 'Sab'
        WHEN 'Sunday' THEN 'Dom'
    END AS dia, 
    MIN(hora) AS entrada, 
    MAX(hora) AS salida 
FROM datos 
WHERE codigo = ?
  AND fecha BETWEEN ? AND ?
GROUP BY codigo, fecha 
ORDER BY fecha ASC";

$stmt = mysqli_prepare($est, $consulta);
if (!$stmt) {
    echo json_encode('Error en la preparación de la consulta: ' . mysqli_error($est));
    exit;
}

mysqli_stmt_bind_param($stmt, "iss", $_POST["codigo"], $_POST["inicio"], $_POST["final"]);
mysqli_stmt_execute($stmt);

// Procesar resultados de la consulta
$result = mysqli_stmt_get_result($stmt);
if (!$result) {
    echo json_encode('Error en la ejecución de la consulta: ' . mysqli_error($est));
    exit;
}



class generarPDF extends TCPDF {
    public function Header() {
        global $nombre_completo;
        
        // Obtener las fechas desde el formulario
        $inicio = isset($_POST["inicio"]) ? $_POST["inicio"] : '';
        $final = isset($_POST["final"]) ? $_POST["final"] : '';
        
        // Configurar la fuente y agregar el título
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 15, 'Reporte de Asistencias de ' . $nombre_completo, 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        
        // Agregar el rango de fechas
        $this->SetFont('helvetica', '', 10);
        $this->Cell(0, 15, 'Desde ' . $inicio . ' Hasta ' . $final, 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        
        // Espacio después del encabezado
        $this->Ln(5);
    }


    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// Crear instancia del PDF
$pdf = new generarPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Configurar información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('LOHANYS MENA, JESUS CLAROS');
$pdf->SetTitle('Reporte de Asistencia');
$pdf->SetSubject('Reportes de asistencia');
$pdf->SetKeywords('TCPDF, PDF, asistencia, reporte, fechas');

// Configurar márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Añadir una página
$pdf->AddPage();

// Agregar título
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Reporte de Asistencia', 0, true, 'C', 0, '', 0, false, 'M', 'M');

// Agregar espacio antes de la tabla
$pdf->Ln(10);

// Configurar encabezados de columna
$pdf->SetFont('helvetica', 'B', 12);
$header = array('Codigo', 'Fecha', 'Dia', 'Entrada', 'Salida');
$w = array(30, 40, 30, 30, 30);
foreach ($header as $i => $col) {
    $pdf->Cell($w[$i], 10, $col, 1, 0, 'C', 0, '', 1, false, 'M', 'M');
}
$pdf->Ln();


$pdf->SetFont('helvetica', '', 12);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell($w[0], 10, $row['codigo'], 1, 0, 'C', 0, '', 1, false, 'M', 'M');
        $pdf->Cell($w[1], 10, $row['fecha_formateada'], 1, 0, 'C', 0, '', 1, false, 'M', 'M');
        $pdf->Cell($w[2], 10, $row['dia'], 1, 0, 'C', 0, '', 1, false, 'M', 'M');
        $pdf->Cell($w[3], 10, $row['entrada'], 1, 0, 'C', 0, '', 1, false, 'M', 'M');
        $pdf->Cell($w[4], 10, $row['salida'], 1, 0, 'C', 0, '', 1, false, 'M', 'M');
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No hay datos disponibles', 1, 1, 'C');
}


header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="reporte_asistencia.pdf"');
$pdf->Output('reporte_asistencia.pdf', 'I');

$est->close();
?>
