<?php
header('Content-type: application/pdf');

class PDF extends FPDF
{

    function Impresion($NumGuia)
    {
        $connection = \Yii::$app->db;
        $sqlStatement = "SELECT NUM_GUIA,FECH_LLEGA,FECH_CORTE,DI_GRACIA,COD_GUIA FROM fac_guia WHERE NUM_GUIA = '" . $NumGuia . "' AND COD_ESTA = 1";
        $comando = $connection->createCommand($sqlStatement);
        $resultado = $comando->query();

        while ($row = $resultado->read()) {
            $row['NUM_GUIA'];
            $row['FECH_LLEGA'];
            $row['FECH_CORTE'];
            $row['DI_GRACIA'];
            $row['COD_GUIA'];


            $this->SetFont('Arial', 'B', 16);                        // $this->Cell(Ancho , Alto , cadena , bordes , posición , alinear , fondo, URL )
            $this->Image(Yii::getAlias('@alsinaLogo'), 1, 1, 4, 1.5);// $this->Image('ruta de imagen', horizontal, vertical, ancho, alto);
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
            $this->Cell(19.2, 0.5, utf8_decode(strtoupper('N° de GuÍa: ' . $row['NUM_GUIA'])), 1, '', 'L');
            $this->Ln();
            $this->Cell(6.4, 0.5, utf8_decode(strtoupper('FECHA DE LLEGADA A OBRA: ' . Yii::$app->formatter->asDate($row['FECH_LLEGA'], "php:d-m-Y"))), 1, '', 'L');
            $this->Cell(6.4, 0.5, utf8_decode(strtoupper('FECHA DE CORTE: ' . Yii::$app->formatter->asDate($row['FECH_CORTE'], "php:d-m-Y"))), 1, '', 'L');
            $this->Cell(6.4, 0.5, utf8_decode(strtoupper('DIAS DE GRACIA: ' . number_format($row['DI_GRACIA'], 2))), 1, '', 'L');
            $this->Ln(1);

            $this->Cell(19.2, 0.5, utf8_decode(strtoupper('Lista de Productos:')), 0, '', 'L');
            $this->Ln();
            $this->Cell(0.6, 0.45, utf8_decode("#"), 1, '', 'C');
            $this->Cell(1.5, 0.45, utf8_decode("Código"), 1, '', 'C');
            $this->Cell(5.9, 0.45, utf8_decode("Elementos"), 1, '', 'C');
            $this->Cell(1.4, 0.45, utf8_decode("P. x dia"), 1, '', 'C');
            $this->Cell(1.4, 0.45, utf8_decode("P. Real"), 1, '', 'C');
            $this->Cell(1.4, 0.45, utf8_decode("P. Volum."), 1, '', 'C');
            $this->Cell(1, 0.45, utf8_decode("Ud."), 1, '', 'C');
            $this->Cell(1.5, 0.45, utf8_decode("P. R. Total"), 1, '', 'C');
            $this->Cell(1.5, 0.45, utf8_decode("Cant. Dias"), 1, '', 'C');
            $this->Cell(1.5, 0.45, utf8_decode("Costo total"), 1, '', 'C');
            $this->Cell(1.5, 0.45, utf8_decode("P. V. Total"), 1, '', 'C');
            $this->Ln();

            $connection = \Yii::$app->db;
            $sqlStatement = "SELECT NUM_PROD,DESC_CORTAR,PREC_X_DIA,PESO_REAL,PESO_VOL,UD,PESO_REAL_TOTAL,CANT_DIAS,COST_TOTAL,PESO_V_TOTAL
                        FROM fac_guia_detal WHERE FAC_COD_GUIA = '" . $row['COD_GUIA'] . "' AND COD_ESTA = 1";
            $comando = $connection->createCommand($sqlStatement);
            $resultado = $comando->query();

            $i = 1;
            while ($row = $resultado->read()) {

                if (strlen($row['DESC_CORTAR']) < 33):
                    $this->SetFont('Arial', '', 7);
                    $this->Cell(0.6, 0.45, $i, 1, '', 'C');
                    $this->Cell(1.5, 0.45, utf8_decode(strtoupper($row['NUM_PROD'])), 1, '', 'L');
                    $this->Cell(5.9, 0.45, utf8_decode(strtoupper($row['DESC_CORTAR'])), 1, '', 'L');
                    $this->Cell(1.4, 0.45, utf8_decode(strtoupper($row['PREC_X_DIA'])), 1, '', 'C');
                    $this->Cell(1.4, 0.45, utf8_decode(strtoupper($row['PESO_REAL'])), 1, '', 'C');
                    $this->Cell(1.4, 0.45, utf8_decode(strtoupper($row['PESO_VOL'])), 1, '', 'C');
                    $this->Cell(1, 0.45, utf8_decode(strtoupper($row['UD'])), 1, '', 'C');
                    $this->Cell(1.5, 0.45, utf8_decode(strtoupper($row['PESO_REAL_TOTAL'])), 1, '', 'C');
                    $this->Cell(1.5, 0.45, utf8_decode(strtoupper($row['CANT_DIAS'])), 1, '', 'C');
                    $this->Cell(1.5, 0.45, utf8_decode(strtoupper($row['COST_TOTAL'])), 1, '', 'C');
                    $this->Cell(1.5, 0.45, utf8_decode(strtoupper($row['PESO_V_TOTAL'])), 1, '', 'C');
                    $i++;
                    $this->Ln();
                else:
                    $this->SetFont('Arial', '', 7);
                    $this->Cell(0.6, 0.90, $i, 1, '', 'C');
                    $this->Cell(1.5, 0.90, utf8_decode(strtoupper($row['NUM_PROD'])), 1, '', 'L');
                    $y = $this->GetY();
                    $x = $this->GetX();
                    $width = 5.9;
                    $this->Multicell(5.9, 0.45, utf8_decode(strtoupper($row['DESC_CORTAR'])), 1, 'L', false);
                    $this->SetXY($x + $width, $y);
                    $this->Cell(1.4, 0.90, utf8_decode(strtoupper($row['PREC_X_DIA'])), 1, '', 'C');
                    $this->Cell(1.4, 0.90, utf8_decode(strtoupper($row['PESO_REAL'])), 1, '', 'C');
                    $this->Cell(1.4, 0.90, utf8_decode(strtoupper($row['PESO_VOL'])), 1, '', 'C');
                    $this->Cell(1, 0.90, utf8_decode(strtoupper($row['UD'])), 1, '', 'C');
                    $this->Cell(1.5, 0.90, utf8_decode(strtoupper($row['PESO_REAL_TOTAL'])), 1, '', 'C');
                    $this->Cell(1.5, 0.90, utf8_decode(strtoupper($row['CANT_DIAS'])), 1, '', 'C');
                    $this->Cell(1.5, 0.90, utf8_decode(strtoupper($row['COST_TOTAL'])), 1, '', 'C');
                    $this->Cell(1.5, 0.90, utf8_decode(strtoupper($row['PESO_V_TOTAL'])), 1, '', 'C');
                    $i++;
                    $this->Ln();
                endif;
            }

            $connection = \Yii::$app->db;
            $sqlStatement = "SELECT sum(COST_TOTAL) AS TOTAL FROM fac_guia_detal WHERE FAC_COD_GUIA = '" . $row['COD_GUIA'] . "' AND COD_ESTA = 1";
            $comando = $connection->createCommand($sqlStatement);
            $resultado = $comando->query();
            while ($row = $resultado->read()) {
                $this->Cell(19.2, 0.5, utf8_decode('Costo Total: ' . strtoupper($row['TOTAL'])), 1, '', 'L');
                $this->Ln(1);
            }
        }
    }

    function parametros($NumGuia)
    {
        $this->Impresion($NumGuia);
    }
}

$cantiad = count($NumeroGuia);

$pdf = new PDF('P', 'cm', 'A4');
$Reporte = "Guia.pdf";

for ($i = 0; $i < $cantiad; $i++) {
    if ($i <> ($cantiad)) {
        $pdf->AddPage();
        $pdf->parametros($NumeroGuia[$i]);
        $pdf->SetTitle("Reporte de Guia");
        $pdf->SetAuthor("Encofrado Alsina");
    }
}

$pdf->Output($Reporte, 'I');
$pdf->Close();
exit();