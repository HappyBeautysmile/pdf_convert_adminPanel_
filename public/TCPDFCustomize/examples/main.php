<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
// new \Kanboard\Analysis\TCPDF(...);

function formatJavaScript($string, $doubleQuotesContext = true, $addQuotes = false) {

    // It must be a string else numbers get mangled
    $string = (string) $string;
        
    // Encode as standard JSON, double quotes
    $string = json_encode($string);
        
    // Remove " from start and end"
    $string = mb_substr($string, 1, -1);
    
    // If using single quotes, reaplce " with ' and escape
    if ($doubleQuotesContext === false) {
        
        // Remove \ from "
        $string = str_replace('\"', '"', $string);
            
        // Escape single quotes
        $string = str_replace("'", "\'", $string);
        
    }
        
    if ($addQuotes === true) {
    
        if ($doubleQuotesContext === true) {
        
            $string = '"' . $string . '"';
        
        } else {
        
            $string = "'" . $string . "'";
            
        }
    
    }
        
    return $string;
        
}
function pdfConvertFunc($printID)
{
$htmldata = ($_REQUEST["htmldata"]);
$dirInform =($_REQUEST["dirInform"]);
$convertedPdfName =($_REQUEST["convertedPdfName"]);
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle($convertedPdfName[$printID]);
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// // set header and footer fonts
// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// // set default monospaced font
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// // set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// // set auto page breaks
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// // set image scale factor
// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content


///----------------1D Barcode---------------------

$barcodenum = '';
for($item = 0; $item<32; $item++)
{
	$barcodenum .= rand(0,9);
}

$params = $pdf->serializeTCPDFtagParameters(array($barcodenum, 'C128C', '', '', 0, 0, 0.2, array('position'=>'S', 'border'=>false, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>false, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>2), 'N'));    
$str='<table cellspacing="0" cellpadding="1" border="0">            
<tr> 
    <td align="left">barcode</td>
</tr>
<tr> 
    <td align="center" style="padding-left:5px;">';
    $str .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
    $str .='</td>
</tr>
</table>';

// $pdf->writeHTML($str,true, false,false,false,'left');
//---------------------2D HTML-----------------------

// $style = array(
//     'border' => 0,
//     'vpadding' => '0',
//     'hpadding' => '0',
//     'fgcolor' => array(0,0,0),
//     'bgcolor' => false, //array(255,255,255)
//     'module_width' => 1, // width of a single module in points
//     'module_height' => 1 // height of a single module in points
// );
// $pdf->write2DBarcode('http://www.tcpdf.org', 'DATAMATRIX', 80, 150, 50, 50, $style, 'N');
//--------------------------------------------------

// $q = json_decode($_REQUEST["q"]);


// $html ='<p style="color: rgb(212, 212, 212); background-color: rgb(30, 30, 30); font-family: Consolas, &quot;Courier New&quot;, monospace; font-size: 14px; line-height: 19px; white-space: pre;"><span style="color: #dcdcaa;">getTrumbowygContent</span></p>WOOWOWOWOOW';


// $html = formatJavaScript($html);

// output the HTML content
$pdf->writeHTML($htmldata[$printID], true, false, true, false, '');

// Print some HTML Cells

$ordernumber = 22 ;
// ---------------------------------------------------------


$pdf->lastPage();
// $pdf->Output('kuitti'.$ordernumber.'.pdf', 'D');
// $pdf->Output(__DIR__ .'/images/'. 'kuitti'.$ordernumber.'.pdf', 'F');
$pdf->Output(__DIR__ .'../../'.$dirInform.'/'.$convertedPdfName[$printID].'.pdf', 'F');

// Store the file name into variable 
//============================================================+
// END OF FILE
//============================================================+
// file_put_contents('kuitti'.$ordernumber.'.pdf',$pdf);
// $pdf->Upload('My Post Code.pdf', $pdf->data);

}
$pdfValue =($_REQUEST["pdfValue"]);

for($i = 0 ; $i < $pdfValue ; $i++)
{
    pdfConvertFunc($i);
}


