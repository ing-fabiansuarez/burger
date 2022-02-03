<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\DetailorderModel;
use App\Models\InfostateModel;
use App\Models\OrderModel;
use App\Models\PrintModel;
use App\Models\TypeshippingModel;
use Exception;
use FPDF;

class Reports extends BaseController
{
    public function printOrder()
    {
        $REF = $this->request->getPostGet('reference');
        $mdlOrder = new OrderModel();
        $mdlPrint = new PrintModel();
        $order = $mdlOrder->find($REF);
        //Se declara la libreria
        $pdf = new PDF_AutoPrint("P", "mm", array(80, 297));
        $this->contentCustomer($REF, $pdf); //pagina de la hoja del cliente
        $this->contentKitchen($REF, $pdf); //pagina de la hoja que pasa a cocina
        if ($order->hasSticker()) {
            $this->contentSticker($REF, $pdf); //pagina para el Stikers
        }
        /*  if($order->isPrint()){
            return "ESTA ORDEN YA ESTABA IMPRESA";
        } */

        try {
            $mdlPrint->insert(
                [
                    'order_id_order' => $order->id_order,
                    'hour_print' => date("Y-m-d H:i:s"),
                    'print_by_id_empoyee' => session()->cedula_employee,
                ]
            );
        } catch (Exception $e) {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'Ocurrio un error con el modelo, al tratar de insertar La Impresion. <br>Excepción capturada:' .  $e->getMessage()
            ]);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->AutoPrint(true);
        $pdf->Output();
    }

    public function contentCustomer($REF, $pdf)
    {
        //modelos
        $mdlOrder = new OrderModel();
        $mdlClient = new ClientModel();
        $order = $mdlOrder->find($REF);
        /* $pdf = new \FPDF("P", "mm", array(75, 150)); */
        $pdf->AddPage();
        //Margenes del archivo
        $pdf->SetMargins(3, 3, 3);
        //Establecemos el margen inferior
        $pdf->SetAutoPageBreak(true, 5);
        $pdf->SetFont('Times', 'B', 10);
        // CONTENIDO DE LA PAGINA
        $pdf->cell(50, 10, '', 0, 1, 'C');
        $pdf->Image(base_url('', 'http') . '/public/img/peraburgelogo1.png', 13, 1, 50);
        $pdf->cell(69, 4, 'FACTURA DE VENTA', 0, 1, 'C');
        $pdf->cell(69, 4, utf8_decode('N° K-' . $order->consecutive_order), 0, 1, 'C');
        $pdf->SetFont('Times', 'B', 8);
        $pdf->cell(69, 4, 'KATHE CREATIVA SAS', 0, 1, 'C');
        $pdf->SetFont('Times', 'B', 10);
        $pdf->cell(69, 4, 'NIT: 901478708-6', 0, 1, 'C');
        $pdf->cell(69, 4, 'Agente Responsable de Impuesto al Consumo', 0, 1, 'C');
        $pdf->cell(69, 4, 'Calle 8 # 6-67', 0, 1, 'C');
        $pdf->cell(69, 4, 'Pamplona - Norte de Santander', 0, 1, 'C');

        $pdf->cell(69, 4, 'Consumidor final', 0, 1, 'C');
        $pdf->cell(69, 4, utf8_decode('Identificación: 222222222'), 0, 1, 'C');

        $pdf->cell(69, 4, '------------------------------------------------', 0, 1, 'C');
        $pdf->cell(69, 4, '', 0, 1, 'C');
        $pdf->MultiCell(69, 4, utf8_decode('N° de orden: ' . $REF), 0, 'L');
        $client = $mdlClient->find($REF);
        $pdf->MultiCell(69, 5, utf8_decode('PeRa Amig@: ' . $client['name_client'] . ' ' . $client['surname_client']), 0, 'L');

        $pdf->SetFont('Times', 'B', 10);
        $pdf->cell(69, 6, '', 0, 1, 'C');
        $pdf->cell(10, 6, 'Cant.', 1, 0, 'C');
        $pdf->cell(39, 6, utf8_decode('Descripción'), 1, 0, 'C');
        $pdf->cell(20, 6, utf8_decode('Precio'), 1, 1, 'C');
        $pdf->SetWidths(array(10, 39, 20));
        $pdf->SetAligns(array('L', 'L', 'R'));

        $high = 125;

        foreach ($order->getListofProducts() as $item_list) {
            $priceDetail = $order->getPricesOfDetail($item_list['id_detailorder']);
            $high += $pdf->Row(array($item_list['quantity_detailorder'], utf8_decode($item_list['name_product']), '$ ' . number_format($priceDetail['total'])));
        }

        $pdf->cell(10, 4, '', 'T', 0, 'C');
        $pdf->cell(39, 8, utf8_decode('TOTAL'), 'T', 0, 'C');
        $pdf->cell(20, 8, '$ ' . number_format($order->getTotalWthitOutDomicilio()), 'T', 1, 'R');
        $pdf->cell(10, 4, '', 0, 1, 'C');
        $pdf->cell(69, 4, '------------------------------------------------', 0, 1, 'C');
        $pdf->SetFont('Times', 'B', 9);
        $pdf->MultiCell(69, 4, utf8_decode('Resolución DIAN N° 18764017921434 con prefijo K desde 2001 hasta 15000 con vigencia desde 11/09/2021 hasta 10/09/2022'), 0, 'C');
        $pdf->cell(10, 4, '', 0, 1, 'C');
        $pdf->cell(35, 4, 'PeRa Burger', 0, 0, 'L');
        $pdf->cell(34, 4, date('Y-m-d g:i a'), 0, 1, 'R');
        $pdf->Image(base_url('', 'http') . '/public/img/cree_en_ti.jpg', 25, $high, 20);
    }

    public function contentKitchen($REF, $pdf)
    {
        //atributo del formularo
        //$REF = $this->request->getPostGet('reference');
        //declaracion de los modelos
        $mdlDetailOrder = new DetailorderModel();
        $mdlClient = new ClientModel();
        $mdlOrder = new OrderModel();
        $mdlType = new TypeshippingModel();
        //uso de los modelos
        $client = $mdlClient->find($REF);
        $list_of_products = $mdlDetailOrder->getListOrderByReference($REF);
        $order = $mdlOrder->find($REF);
        /* *************************************************************************************
        *************************************************************************************
        CONTENIDO DEL PDF
        **************************************************************************************
        ************************************************************************************** */
        $pdf->AddPage();
        //Margenes del archivo
        $pdf->SetMargins(3, 3, 3);
        //Establecemos el margen inferior
        $pdf->SetAutoPageBreak(true, 5);
        $pdf->SetFont('Helvetica', 'B', 12);
        // CONTENIDO DE LA PAGINA
        $pdf->Image(base_url('', 'http') . '/public/img/peraburgelogo1.png', 3, 0, 30);
        $pdf->cell(50, 8, '', 0, 1, 'C');
        $pdf->cell(15, 6, 'TURNO', 'LT', 0, 'L');
        $pdf->SetFont('Helvetica', 'B', 30);
        $pdf->cell(15, 12, $order->turnmachine_order, 'T', 0, 'L');
        $pdf->SetFont('Helvetica', 'B', 12);
        $pdf->cell(39, 6, $mdlType->find($order->typeshipping_id_typeshipping)['name_typeshipping'], 'TR', 1, 'R');
        $pdf->SetFont('Helvetica', 'B', 12);
        $pdf->cell(30, 6, '', 'LB', 0, 'L');
        $pdf->cell(39, 6, utf8_decode('Orden: ') . $REF, 'BR', 1, 'R');
        $pdf->MultiCell(69, 6, utf8_decode('Cliente: ' . $client['name_client'] . ' ' . $client['surname_client']), 'LRB', 'L');
        if ($order->typeshipping_id_typeshipping == 1) {
            $pdf->MultiCell(69, 6, 'Tel: ' . $order->getDomicilio()['whatsapp_domicilio'], 'LRB', 'L');
        }
        $pdf->ln(5);
        $pdf->SetFont('Helvetica', 'B', 20);
        $pdf->cell(69, 7, 'COCINA', 1, 1, 'C');
        $pdf->SetFont('Helvetica', 'B', 12);
        $pdf->ln(3);
        $pdf->cell(11, 6, 'Cant.', 'LRBT', 0, 'C');
        $pdf->cell(58, 6, utf8_decode('Descripción'), 1, 1, 'C');
        foreach ($list_of_products as $item_list) {
            $pdf->SetFont('Times', 'B', 10);
            $pdf->cell(11, 7, $item_list['quantity_detailorder'], 'LR', 0, 'C');
            $pdf->cell(58, 7,  $item_list['name_product'], 1, 1, 'L');
            $pdf->SetFont('Times', '', 10);
            foreach ($item_list['whitout'] as $whitout) {
                $pdf->cell(11, 5, '', 'LR', 0, 'R');
                $pdf->cell(58, 5, 'Sin ' . $whitout['name_ingredient'], 'RL', 1, 'R');
            }
            $pdf->SetFont('Times', '', 10);
            $pdf->cell(11, 0, '', 0, 0, 'R');
            $pdf->cell(58, 0, '', 1, 1, 'R');
            foreach ($item_list['with'] as $with) {
                $pdf->cell(11, 5, '', 'LR', 0, 'R');
                $pdf->cell(58, 5, utf8_decode('Con Adición ' . $with['name_addition']), 'RL', 1, 'R');
            }
            $pdf->cell(69, 0, '', 1, 1, 'R');
        }
        if ($order->observations_order != '') {
            $pdf->SetFont('Times', 'B', 10);
            $pdf->cell(69, 7, utf8_decode('OBSERVACIÓN: '), 'TLR', 1, 'L');
            $pdf->SetFont('Times', '', 10);
            $pdf->MultiCell(69, 6, utf8_decode($order->observations_order), 'BLR', 'L');
            $pdf->cell(69, 4, ' ', 0, 1, 'R');
        }
        $pdf->cell(35, 4, 'PeRa Burger', 0, 0, 'L');
        $pdf->cell(34, 4, date('Y-m-d g:i a'), 0, 1, 'R');

        /* *************************************************************************************
        *************************************************************************************
        FIN DEL CONTENIDO 
        **************************************************************************************
        ************************************************************************************** */
    }
    public function contentSticker($REF, $pdf)
    {
        $mdlOrder = new OrderModel();
        $mdlClient = new ClientModel();
        $order = $mdlOrder->find($REF);
        $domicilio = $order->getDomicilio();
        $client = $mdlClient->find($REF);
        $pdf->AddPage();
        //Margenes del archivo
        $pdf->SetMargins(0, 0, 0);
        //Establecemos el margen inferior
        $pdf->SetAutoPageBreak(true, 0);
        $pdf->SetFont('ZapfDingbats', 'B', 9);
        // CONTENIDO DE LA PAGINA
        $pdf->Image(base_url('', 'http') . '/public/admin/dist/img/others/stikersdomi1.jpeg', 3, 0, 70);
        //dd($domicilio);
        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->ln(14);
        $pdf->cell(30, 1, '', 0, 0, 'L');
        $pdf->MultiCell(40, 5, utf8_decode($client['name_client'] . ' ' . $client['surname_client']), 1, 'C');
        $pdf->cell(30, 5, '', 0, 0, 'L');

        if ($order->typeshipping_id_typeshipping == 1) {
            if ($order->getDomicilio()['address_domicilio'] == '') {
                $pdf->SetFont('Helvetica', '', 9);
                $pdf->MultiCell(40, 8, utf8_decode('PARA LLEVAR'), 0, 'L');
            } else {

                $pdf->MultiCell(40, 5, utf8_decode('Dirección:'), 0, 'L');

                $pdf->SetFont('Arial', '', 9);
                $pdf->cell(30, 1, '', 0, 0, 'L');
                $pdf->MultiCell(40, 4, utf8_decode($domicilio['address_domicilio'] . ' Barrio ' . $domicilio['neighborhood_domicilio']), 0, 'L');
            }
        }


        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->cell(30, 1, '', 0, 0, 'L');
        $pdf->MultiCell(40, 5, utf8_decode('Telefono:'), 0, 'L');

        $pdf->SetFont('Arial', '', 9);
        $pdf->cell(30, 1, '', 0, 0, 'L');
        $pdf->MultiCell(40, 4,  utf8_decode($domicilio['whatsapp_domicilio']), 0, 'L');

        if ($domicilio['observation_domicilio'] != '') {
            $pdf->SetFont('Helvetica', 'B', 9);
            $pdf->cell(30, 1, '', 0, 0, 'L');
            $pdf->MultiCell(40, 5, utf8_decode('Observación:'), 0, 'L');

            $pdf->SetFont('Arial', '', 9);
            $pdf->cell(30, 1, '', 0, 0, 'L');
            $pdf->MultiCell(40, 4,  utf8_decode($domicilio['observation_domicilio']), 0, 'L');
        }
    }
}

class PDF_JavaScript extends FPDF
{
    var $javascript;
    var $n_js;
    function IncludeJS($script)
    {
        $this->javascript = $script;
    }
    function _putjavascript()
    {
        $this->_newobj();
        $this->n_js = $this->n;
        $this->_out('<<');
        $this->_out('/Names [(EmbeddedJS) ' . ($this->n + 1) . ' 0 R]');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_newobj();
        $this->_out('<<');
        $this->_out('/S /JavaScript');
        $this->_out('/JS ' . $this->_textstring($this->javascript));
        $this->_out('>>');
        $this->_out('endobj');
    }
    function _putresources()
    {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }
    function _putcatalog()
    {
        parent::_putcatalog();
        if (!empty($this->javascript)) {
            $this->_out('/Names <</JavaScript ' . ($this->n_js) . ' 0 R>>');
        }
    }
}
/****************************************************************/

/*************** Clase PDF_AutoPrint basandose en PDF_JavaScript *************/
class PDF_AutoPrint extends PDF_JavaScript
{
    function AutoPrint($dialog = false)
    {
        $param = ($dialog ? 'true' : 'false');
        $script = "print($param);";
        $this->IncludeJS($script);
    }

    function AutoPrintToPrinter($server, $printer, $dialog = false)
    {
        $script = "var pp = getPrintParams();";
        if ($dialog)
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
        else
            $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
        $script .= "pp.printerName = '\\\\\\\\" . $server . "\\\\" . $printer . "';";
        $script .= "print(pp);";
        $this->IncludeJS($script);
    }
    var $widths;
    var $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
        return $h;
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}
