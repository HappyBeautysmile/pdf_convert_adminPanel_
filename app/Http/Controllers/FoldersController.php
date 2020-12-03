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
}
