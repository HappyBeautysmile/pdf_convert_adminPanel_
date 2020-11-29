<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateProjectController extends Controller
{
    public function index()
    {
        $jsonDataInformDir = file_get_contents("./TCPDFCustomize/ResourceData/DATA/2020/Janvier/jsonDataInform.txt");
        $data["jsonDataInformDir"]= $jsonDataInformDir;
        $data["page_flg"]="createProject";
        return view('create_project',$data);
    }

    public function operating_pdf(){

        $soureDir = $_REQUEST['soureDir'];
        $src_pdfFileArray = scandir($soureDir,0);

        return response()->json($src_pdfFileArray);
    }
}
