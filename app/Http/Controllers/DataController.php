<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $data["page_flg"]="data";
        return view('data',$data);
    }
}
