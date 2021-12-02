<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
class TasksController extends Controller
{

    public function getTasks($id){
        $task=Tasks::where('iduser',$id)->get();
        return response()->json(['data'=>$task]); 
    }
    public function deleteTasks($id){
        Tasks::destroy($id);
        return response()->json(['message'=>'deleted']);

    }
    public function UpdateTasks(Request $request,$id){
        $Tasks =  Tasks::find($id);
        $Tasks->title = $request->title;
        $Tasks->update();
        return response()->json($Tasks);
    }
    public function SaveTasks(Request $request){
        $Tasks = new Tasks();
        $Tasks->title = $request->title;
        $Tasks->iduser = $request->iduser;
   
        $Tasks->save();
        return response()->json($Tasks);
    }
    public function getSignal($id){
   $tasks=Tasks::where('id',$id)->first();
        return response()->json($tasks);
    }
}