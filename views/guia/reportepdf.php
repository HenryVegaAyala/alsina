<?php
header('Content-type: application/pdf');

class PDF extends FPDF
{

    function Impresion($model)
    {
                                                                 // $this->Cell(Ancho , Alto , cadena , bordes , posición , alinear , fondo, URL )
        $this->SetFont('Arial', 'B', 15);
                                                                 // $this->Image('ruta de imagen', horizontal, vertical, ancho, alto);
        $this->Image(Yii::getAlias('@alsinaLogo'), 1, 1, 2.8, 1.5);
        $this->Cell(19.2, 1, utf8_decode('Lista de Contabilidad'), 0, 'C', 'C');
        $this->Ln(2);

        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(150, 54, 52);                        // establece el color del fondo de la celda.
        $this->SetDrawColor(150, 54, 52);                        // establece el color del contorno de la celda.
        $this->SetTextColor(255, 255, 255);                      // Establece el color del texto.
        $this->Cell(0.2, 0.2, utf8_decode(''), 0, 0, 'C', True);
        $this->Cell(18.8, 0.2, utf8_decode(''), 1, 0, 'C', True);
        $this->Cell(0.2, 0.2, utf8_decode(''), 0, 0, 'C', True);
        $this->Ln(0.6);

        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(0, 0, 0);

        $this->Cell(19.2, 0.5, utf8_decode(strtoupper('Datos Personales')), 1, '', 'C');
        $this->Ln();
        $this->Cell(6.4, 0.5, utf8_decode(strtoupper('Datos Personales')), 1, '', 'C');
        $this->Cell(6.4, 0.5, utf8_decode(strtoupper('DNI')), 1, '', 'C');
        $this->Cell(6.4, 0.5, utf8_decode(strtoupper('Edad')), 1, '', 'C');
        $this->Ln(0.5);

//        $connection = \Yii::$app->db;
//        $sqlStatement = "";
//        $comando = $connection->createCommand($sqlStatement);
//        $resultado = $comando->query();
//
//        while ($row = $resultado->read()) {
        $this->SetFont('Arial', '', 7.5);
//            $this->Cell(6.5, 0.45, utf8_decode(strtoupper($row['Dato'])), 1, '', 'L');
//            $this->Cell(2.5, 0.45, utf8_decode(strtoupper($row['dni'])), 1, '', 'C');
//            $this->Cell(1.5, 0.45, utf8_decode(strtoupper($row['Edad'])), 1, '', 'C');
//            $this->Cell(4.5, 0.45, utf8_decode(strtoupper($row['Estado_Civil'])), 1, '', 'L');
//            $this->Cell(3, 0.45, utf8_decode(strtoupper($row['Telefono_Celular'])), 1, '', 'C');
//            $this->Cell(5.5, 0.45, utf8_decode(strtoupper($row['Email'])), 1, '', 'L');
//            $this->Cell(4, 0.45, utf8_decode(strtoupper($row['Tarjeta_De_Credito'])), 1, '', 'L');
        $this->Ln();
//        }

//        $this->SetXY(1.93, 17.58);

//        $connection = \Yii::$app->db;
//        $sqlStatement = "";
//        $comando = $connection->createCommand($sqlStatement);
//        $resultado = $comando->query();
//
//        while ($row = $resultado->read()) {
//            $this->SetFont('Arial', 'B', 9);
//            $this->Ln();
//            $this->Cell(27.5, 0.7, utf8_decode(strtoupper('Total del clientes durante el periodo: ' . $row['cantidad'])), 0, '', 'L');
//            $this->Ln();
//        }
    }
}

$pdf = new PDF('P', 'cm', 'A4');
$Reporte = "Guia.pdf";
$pdf->AddPage();
$pdf->Impresion($model);
$pdf->SetTitle("Reporte de Guia");
$pdf->SetAuthor("Encofrado Alsina");
$pdf->Output($Reporte, 'I');
$pdf->Close();
exit();