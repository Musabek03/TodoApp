<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function addTask(Request $request)
    {

        $user = $request->user();

        Task::create([
            "user_id"=> $user->id,
            'title'=>$request->title,
            'description'=>$request->description,
            'deadline'=>$request->deadline,

        ]);
        return [
            'task created successful'
        ];

    }

    public function getTask(Request $request){
        return Task::where('user_id', $request->user()->id)->select('id', 'title', 'description', 'deadline', 'active') ->get();
    }

    public function updateTask(Request $request, Task $task){


        $update = Task::all()->find($task);
        $update['title'] = $request->title;
        $update['description'] = $request->description;
        $update['deadline'] = $request->deadline;
        $update->update();
        return $update;
        //return "Task is the updated successful";
    }

  public function deleteTask($task){


$delete = Task::all()->find($task);
    if(!$delete){
       return "Task is not find";
    }
    $delete->delete();
        return [
            "Task is deleted successful"
        ];
    }


}
