<?php
header('Content-type: application/pdf');

class PDF extends FPDF
{

    function Impresion($informacion)
    {
        foreach ($informacion as $value):
        endforeach;
        $this->SetFont('Arial', 'B', 16);                        // $this->Cell(Ancho , Alto , cadena , bordes , posición , alinear , fondo, URL )
        $this->Image(Yii::getAlias('@alsinaLogo'), 1, 1, 3, 1.5);// $this->Image('ruta de imagen', horizontal, vertical, ancho, alto);
        $this->Cell(19.2, 1.5, utf8_decode('Guía de Productos'), 0, 'C', 'C');
        $this->Ln(2);

        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(150, 54, 52);                        // establece el color del fondo de la celda.
        $this->SetDrawColor(150, 54, 52);                        // establece el color del contorno de la celda.
        $this->SetTextColor(255, 255, 255);                      // Establece el color del texto.
        $this->Cell(0.2, 0.2, utf8_decode(''), 0, 0, 'C', True);
        $this->Cell(18.8, 0.2, utf8_decode(''), 1, 0, 'C', True);
        $this->Cell(0.2, 0.2, utf8_decode(''), 0, 0, 'C', True);
        $this->Ln(0.6);

        $this->SetFont('Arial', 'B', 8);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(19.2, 0.5, utf8_decode(strtoupper('N° de GuÍa: ' . $value['NUM_GUIA'])), 1, '', 'L');
        $this->Ln();
        $this->Cell(6.4, 0.5, utf8_decode(strtoupper('FECHA DE LLEGADA A OBRA: ' . Yii::$app->formatter->asDate($value['FECH_LLEGA'], "php:d-m-Y"))), 1, '', 'L');
        $this->Cell(6.4, 0.5, utf8_decode(strtoupper('FECHA DE CORTE: ' . Yii::$app->formatter->asDate($value['FECH_CORTE'], "php:d-m-Y"))), 1, '', 'L');
        $this->Cell(6.4, 0.5, utf8_decode(strtoupper('DIAS DE GRACIA: ' . number_format($value['DI_GRACIA'], 2))), 1, '', 'L');
        $this->Ln(1);

        $this->Cell(19.2, 0.5, utf8_decode(strtoupper('Lista de Productos:')), 0, '', 'L');
        $this->Ln();
        $this->Cell(0.6, 0.45, utf8_decode("#"), 1, '', 'C');
        $this->Cell(1.5, 0.45, utf8_decode("Código"), 1, '', 'C');
        $this->Cell(6.7, 0.45, utf8_decode("Elementos"), 1, '', 'C');
        $this->Cell(1.4, 0.45, utf8_decode("P. x dia"), 1, '', 'C');
        $this->Cell(1.4, 0.45, utf8_decode("P. Real"), 1, '', 'C');
        $this->Cell(1.4, 0.45, utf8_decode("P. Volum."), 1, '', 'C');
        $this->Cell(1, 0.45, utf8_decode("Ud."), 1, '', 'C');
        $this->Cell(1.4, 0.45, utf8_decode("P. R. Total"), 1, '', 'C');
        $this->Cell(1.4, 0.45, utf8_decode("Cant. Dias"), 1, '', 'C');
        $this->Cell(1.4, 0.45, utf8_decode("Costo total"), 1, '', 'C');
        $this->Cell(1.4, 0.45, utf8_decode("P. V. Total"), 1, '', 'C');
        $this->Ln();

        $connection = \Yii::$app->db;
        $sqlStatement = "SELECT NUM_PROD,DESC_CORTAR,PREC_X_DIA,PESO_REAL,PESO_VOL,UD,PESO_REAL_TOTAL,CANT_DIAS,COST_TOTAL,PESO_V_TOTAL
                        FROM fac_guia_detal WHERE FAC_COD_GUIA = " . $value['COD_GUIA'];
        $comando = $connection->createCommand($sqlStatement);
        $resultado = $comando->query();

        $i = 1;
        while ($row = $resultado->read()) {
            $this->SetFont('Arial', '', 7);
            $this->Cell(0.6, 0.45, $i, 1, '', 'C');
            $this->Cell(1.5, 0.45, utf8_decode(strtoupper($row['NUM_PROD'])), 1, '', 'L');
            $y = $this->GetY();
            $x = $this->GetX();
            $width = 6.7;
            $this->MultiCell(6.7, 0.45, utf8_decode(strtoupper($row['DESC_CORTAR'])), 1, '', 'L');
            $this->SetXY($x + $width, $y);
            $this->Cell(1.4, 0.45, utf8_decode(strtoupper($row['PREC_X_DIA'])), 1, '', 'C');
            $this->Cell(1.4, 0.45, utf8_decode(strtoupper($row['PESO_REAL'])), 1, '', 'C');
            $this->Cell(1.4, 0.45, utf8_decode(strtoupper($row['PESO_VOL'])), 1, '', 'C');
            $this->Cell(1, 0.45, utf8_decode(strtoupper($row['UD'])), 1, '', 'C');
            $this->Cell(1.4, 0.45, utf8_decode(strtoupper($row['PESO_REAL_TOTAL'])), 1, '', 'C');
            $this->Cell(1.4, 0.45, utf8_decode(strtoupper($row['CANT_DIAS'])), 1, '', 'C');
            $this->Cell(1.4, 0.45, utf8_decode(strtoupper($row['COST_TOTAL'])), 1, '', 'C');
            $this->Cell(1.4, 0.45, utf8_decode(strtoupper($row['PESO_V_TOTAL'])), 1, '', 'C');
            $i++;
            $this->Ln();
        }
    }
}

$pdf = new PDF('P', 'cm', 'A4');
$Reporte = "Guia.pdf";
$pdf->AddPage();
$pdf->Impresion($informacion);
$pdf->SetTitle("Reporte de Guia");
$pdf->SetAuthor("Encofrado Alsina");
$pdf->Output($Reporte, 'I');
$pdf->Close();
exit();