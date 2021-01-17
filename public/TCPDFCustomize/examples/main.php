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

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
    }

    // Page footer
    public function Footer() {
        // // Position at 15 mm from bottom
        // $this->SetY(-15);
        // // Set font
        // $this->SetFont('helvetica', 'I', 8);
        // // Page number
        // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

function pdfConvertFunc($printID)
{
    $htmldata = ($_REQUEST["htmldata"]);
    $dirInform =($_REQUEST["dirInform"]);
    $convertedPdfName =($_REQUEST["convertedPdfName"]);
    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('rsu hyon');
    $pdf->SetTitle($convertedPdfName[$printID]);
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    // TCPDF_FONTS::addTTFfont(__DIR__.'/customize_font/Chandiluna/Chandiluna.ttf', 'TrueTypeUnicode', '', 96);
    // TCPDF_FONTS::addTTFfont(__DIR__.'/customize_font/bright_star/bright_star.ttf', 'TrueTypeUnicode', '', 96);
    // TCPDF_FONTS::addTTFfont(__DIR__.'/customize_font/Baby_Chipmunk/Baby_Chipmunk.ttf', 'TrueTypeUnicode', '', 96);
    // TCPDF_FONTS::addTTFfont(__DIR__.'/customize_font/heysweet/heysweet.ttf', 'TrueTypeUnicode', '', 96);
    // TCPDF_FONTS::addTTFfont(__DIR__.'/customize_font/sunday/sunday.ttf', 'TrueTypeUnicode', '', 96);
    
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    // $pdf->SetFont('dejavusans', '', 10);

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
    $html = '<span style="text-align:justify;">a <u>abc</u> abcdefghijkl (abcdef) abcdefg <b>abcdefghi</b> a ((abc)) abcd <img src="images/logo_example.png" border="0" height="41" width="41" /> <img src="images/tcpdf_box.svg" alt="test alt attribute" width="80" height="60" border="0" /> abcdef abcdefg <b>abcdefghi</b> a abc abcd abcdef abcdefg <b>abcdefghi</b> a abc abcd abcdef abcdefg <b>abcdefghi</b> a <u>abc</u> abcd abcdef abcdefg <b>abcdefghi</b> a abc \(abcd\) abcdef abcdefg <b>abcdefghi</b> a abc \\\(abcd\\\) abcdef abcdefg <b>abcdefghi</b> a abc abcd abcdef abcdefg <b>abcdefghi</b> a abc abcd abcdef abcdefg <b>abcdefghi</b> a abc abcd abcdef abcdefg abcdefghi a abc abcd <a href="http://tcpdf.org">abcdef abcdefg</a> start a abc before <span style="background-color:yellow">yellow color</span> after a abc abcd abcdef abcdefg abcdefghi a abc abcd end abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi<br />abcd abcdef abcdefg abcdefghi<br />abcd abcde abcdef</span>';

    // $pdf->writeHTML($htmldata[$printID], true, false, true, false, '');
    $pdf->writeHTML($htmldata[$printID], true, 0, true, true);
    // Print some HTML Cells

    $ordernumber = 22 ;
    // ---------------------------------------------------------


    $pdf->lastPage();
    $pdf->Output(__DIR__ .'../../'.$dirInform.'/'.$convertedPdfName[$printID].'.pdf', 'F');


}
$pdfValue =($_REQUEST["pdfValue"]);

for($i = 0 ; $i < $pdfValue ; $i++)
{
    pdfConvertFunc($i);
}


