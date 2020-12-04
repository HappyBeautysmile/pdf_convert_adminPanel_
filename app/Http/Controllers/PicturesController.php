<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $jsonFolderDirInform = file_get_contents("./TCPDFCustomize/ResourceData/jsonFolderDirInform.txt");
        $data["jsonFolderDirInform"]= $jsonFolderDirInform;
        
        $data["page_flg"]="pictures";
        return view('pictures',$data);
    }
}
