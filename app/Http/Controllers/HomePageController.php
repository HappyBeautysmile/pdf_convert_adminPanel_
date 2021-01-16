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
        
        $taskList = Task::where('status','=',"En cours")->orderBy('id','desc')->get();
        $finishedtaskList = Task::where('status','=',"terminées")->orderBy('id','desc')->get();
        Log::Info( $taskList ); //accessory
        
        $data["page_flg"]="homePage";
        $data["taskList"]=$taskList;
        $data["finishedtaskList"]=$finishedtaskList;
        $data["currentUser"] = Auth::user()->name;
        $data["currentUser_role"] = Auth::user()->role_id;

        return view('home_page',$data);
    }
    public function newTask(Request $request)
    {
    // protected $fillable = ['task_name', 'task_ticket', 'start_date', 'end_date', 'status', 'author'];

        $input = $request->all();
        // Log::Info( $input ); //accessory
        $task = new Task;
        $task->task_name = $input["task_name"];
        $task->task_ticket = $input["task_ticket"];
        $task->start_date = $input["datepicker"];
        $task->end_date = $input["datepicker_2"];
        $task->folder_dir = $input["folder_dir"];
        $task->status = "En cours";
        $task->author = Auth::user()->name;
        $task->save();
        return redirect()->route('dashboard')->with('success','new task successfully.');
    }

    public function editTask(Request $request)
    {

        $input = $request->all();
        // Log::Info( $input ); //accessory

         $task = Task::findOrFail($input['task_id_edit']);
         $task->task_name = $input["task_name_edit"];
         $task->task_ticket = $input["task_ticket_edit"];
         $task->start_date = $input["datepicker_3"];
         $task->end_date = $input["datepicker_4"];
         $task->folder_dir = $input["folder_dir_edit"];
         $task->update();

        return redirect()->route('dashboard')->with('success','edit task successfully.');
    }

    public function finishTask(Request $request)
    {

        $input = $request->all();
         $task = Task::findOrFail($input['task_id_finish']);
        Log::Info( $task ); //accessory

         $task->status = 'terminées';
         $task->update();
        return redirect()->route('dashboard')->with('success','finish task successfully.');
    }

    public function removeTask(Request $request)
    {

        $input = $request->all();
         $task = Task::findOrFail($input['task_id_remove']);
        Log::Info( $task ); //accessory
        $task->delete();
        return redirect()->route('dashboard')->with('success','remove task successfully.');
    }
    
}
