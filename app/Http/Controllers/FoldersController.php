<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoldersController extends Controller
{
    //
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jsonFolderDirInform = file_get_contents("./TCPDFCustomize/ResourceData/jsonFolderDirInform.txt");
        $data["jsonFolderDirInform"]= $jsonFolderDirInform;
        $data["page_flg"]="folders";
        return view('folders',$data);
    }
    public function addFolder()
    {
        $folderName = $_REQUEST['folderName'];
        $addFolderDir = $_REQUEST['addFolderDir'];
        $jsonFolderDirInform = $_REQUEST['jsonFolderDirInform'];
        mkdir("./TCPDFCustomize/".$addFolderDir.$folderName,0777);

        $json_data = json_encode($jsonFolderDirInform);
        file_put_contents("./TCPDFCustomize/ResourceData/jsonFolderDirInform.txt", $json_data);

        return response()->json("nice");
    }
}
