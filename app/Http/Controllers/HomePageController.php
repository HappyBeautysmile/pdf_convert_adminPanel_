<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        
        $data["page_flg"]="homePage";
        return view('home_page',$data);
    }
}
