<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data["page_flg"]="homePage";
        return view('home_page',$data);
    }
    public function firstpage()
    {
        $currentUserName = Auth::user()->name ;
        if($currentUserName != null && $currentUserName!="")
        {
            $data["page_flg"]="homePage";
            return view('home_page',$data);
        }
        else
        {
            return view('login');
        }
    }
}
