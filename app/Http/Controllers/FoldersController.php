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
        $jsonDataInformDir = file_get_contents("./TCPDFCustomize/ResourceData/DATA/2020/Janvier/jsonDataInform.txt");
        $data["jsonDataInformDir"]= $jsonDataInformDir;

        $data["page_flg"]="folders";
        return view('folders',$data);
    }
}
