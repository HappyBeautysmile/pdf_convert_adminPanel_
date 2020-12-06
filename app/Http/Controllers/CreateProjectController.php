<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateProjectController extends Controller
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
        $jsonDataInformDir = file_get_contents("./TCPDFCustomize/DATA/jsonDataInform.txt");
        $data["jsonDataInformDir"]= $jsonDataInformDir;

        $jsonFolderDirInform = file_get_contents("./TCPDFCustomize/jsonFolderDirInform.txt");
        $data["jsonFolderDirInform"]= $jsonFolderDirInform;

        $data["page_flg"]="createProject";
        return view('create_project',$data);
    }

    public function operating_pdf(){

        $soureDir = $_REQUEST['soureDir'];
        $fileName = $_REQUEST['fileName'];
        $src_pdfFileArray = scandir($soureDir,0);

        $jsonDataDir = file_get_contents("./TCPDFCustomize/DATA/jsonData/".$fileName.".txt");
        $jsonData = json_decode($jsonDataDir);

        return response()->json(array('src_pdfFileArray' => $src_pdfFileArray, 'jsonData' =>  $jsonData));
    }


    public function pdfGenerate(){

        $fileName = $_REQUEST['fileName'];

        $jsonDataDir = file_get_contents("./TCPDFCustomize/DATA/jsonData/".$fileName.".txt");
        $jsonData = json_decode($jsonDataDir);

        return response()->json(array('jsonData' =>  $jsonData));
    }
}
