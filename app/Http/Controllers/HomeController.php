<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Illuminate\Support\Facades\Log;
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

        $taskList = Task::where('status','=',"En cours")->orderBy('id','desc')->get();
        $finishedtaskList = Task::where('status','=',"terminées")->orderBy('id','desc')->get();

        $data["taskList"]=$taskList;
        $data["finishedtaskList"]=$finishedtaskList;
        $data["currentUser"] = Auth::user()->name;
        $data["currentUser_role"] = Auth::user()->role_id;
        $data["page_flg"]="homePage";
        return view('home_page',$data);
    }
    public function firstpage()
    {
        $taskList = Task::where('status','=',"En cours")->orderBy('id','desc')->get();
        $finishedtaskList = Task::where('status','=',"terminées")->orderBy('id','desc')->get();

        $data["taskList"]=$taskList;
        $data["finishedtaskList"]=$finishedtaskList;
        $data["currentUser"] = Auth::user()->name;
        $data["currentUser_role"] = Auth::user()->role_id;
        
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
