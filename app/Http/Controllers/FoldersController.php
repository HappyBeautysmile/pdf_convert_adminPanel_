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
        $jsonFolderDirInform = file_get_contents("./TCPDFCustomize/DATA/jsonFolderDirInform.txt");
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
        file_put_contents("./TCPDFCustomize/DATA/jsonFolderDirInform.txt", $json_data);

        return response()->json("nice");
    }
    // getFolderDirInform
    public function getFolderDirInform()
    {
        $jsonFolderDirInform = file_get_contents("./TCPDFCustomize/DATA/jsonFolderDirInform.txt");
        $data["jsonFolderDirInform"]= $jsonFolderDirInform;
        return  response()->json($data);
    }
    public function renameFolder()
    {
        $folderName = $_REQUEST['folderName'];
        $rename = $_REQUEST['rename'];
        $renameFolderDir = $_REQUEST['renameFolderDir'];
        $jsonFolderDirInform = $_REQUEST['jsonFolderDirInform'];
        rename("./TCPDFCustomize/".$renameFolderDir.$folderName,"./TCPDFCustomize/".$renameFolderDir.$rename);
        $json_data = json_encode($jsonFolderDirInform);
        file_put_contents("./TCPDFCustomize/DATA/jsonFolderDirInform.txt", $json_data);
        return response()->json("nice");
    }
    public function deleteFolder()
    {
        $folderName = $_REQUEST['folderName'];
        $deleteFolderDir = $_REQUEST['deleteFolderDir'];
        $jsonFolderDirInform = $_REQUEST['jsonFolderDirInform'];
        # recursively remove a directory
        function rrmdir($dir) {
            foreach(glob($dir . '/*') as $file) {
                if(is_dir($file))
                    rrmdir($file);
                else
                    unlink($file);
            }
            rmdir($dir);
        }
        rrmdir("./TCPDFCustomize/".$deleteFolderDir.$folderName);
        $json_data = json_encode($jsonFolderDirInform);
        file_put_contents("./TCPDFCustomize/DATA/jsonFolderDirInform.txt", $json_data);
        return response()->json("nice");
    }
}
