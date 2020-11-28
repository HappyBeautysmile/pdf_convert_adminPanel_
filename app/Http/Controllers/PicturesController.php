<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PicturesController extends Controller
{
    public function index()
    {
        $data["page_flg"]="pictures";
        return view('pictures',$data);
    }
}
