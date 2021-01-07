<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
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
        
        $data["page_flg"]="homePage";
        return view('home_page',$data);
    }
    public function newTask(Request $request)
    {
    // protected $fillable = ['task_name', 'task_ticket', 'start_date', 'end_date', 'status', 'author'];

        $input = $request->all();
        Log::Info( $input ); //accessory
        $task = new Task;
        $task->task_name = $input["task_name"];
        $task->task_ticket = $input["task_ticket"];
        $task->start_date = $input["datepicker"];
        $task->end_date = $input["datepicker_2"];
        $task->status = "En cours";
        $task->author = Auth::user()->name;
        $task->save();

        $data["page_flg"]="homePage";
        return view('home_page',$data);
    }
}
