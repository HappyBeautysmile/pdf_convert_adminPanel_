<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllPdfController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data["page_flg"]="allPdf";
        $jsonFolderDirInform = file_get_contents("./TCPDFCustomize/jsonFolderDirInform.txt");
        $data["jsonFolderDirInform"]= $jsonFolderDirInform;
        return view('all_pdf',$data);
    }
    public function pdfInformArray(){

        $soureDir = $_REQUEST['soureDir'];
        $src_pdfFileArray = scandir($soureDir,0);

        return response()->json($src_pdfFileArray);
    }
}
