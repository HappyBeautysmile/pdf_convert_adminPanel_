<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PicturesController extends Controller
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
        $jsonFolderDirInform = file_get_contents("./TCPDFCustomize/DATA/jsonFolderDirInform.txt");
        $imageFilesInformData = file_get_contents("./TCPDFCustomize/DATA/jsonImagesInform.txt");
        $data["jsonFolderDirInform"]= $jsonFolderDirInform;
        $data["imageFilesInformData"]= $imageFilesInformData;
        
        $data["page_flg"]="pictures";
        $data['user'] =  Auth::user()->name;
        return view('pictures',$data);
    }
    public function imageFilesInform()
    {
        $imageFilesInformData = $_REQUEST['imageFilesInformData'];

        $json_data = json_encode($imageFilesInformData);
        file_put_contents("./TCPDFCustomize/DATA/jsonImagesInform.txt", $json_data);
        $success = "success";
        return response()->json($success);
    }
}
