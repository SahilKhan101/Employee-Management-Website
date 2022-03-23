<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();     //or "asc"
        return view('tasks.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->user_type != 'Administrator'){
            return redirect()->route('e-dashboard')->with('error', 'Unauthorized Page');
        }
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'todo' => 'required',
            // 'status' => 'required',
        ]);

        //Check for correct user
        if(auth()->user()->user_type != 'Administrator'){
            return redirect()->route('e-dashboard')->with('error', 'Unauthorized Page');
        }

        $users = User::orderBy('created_at', 'desc')->get();     //or "asc"
        foreach($users as $user){
            // Create Profile
            $task = new Task;
            $task->todo = $request->input('todo');
            $task->status = 'Incomplete';
            $task->user_id = $user->id;
            $task->save();
        }

        return redirect()->route('a-dashboard')->with('success', 'Task Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return View('tasks.show')->with('task', $task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        //Check for correct user
        if(auth()->user()->id !== $task->user_id){
            return redirect('/tasks')->with('error', 'Unauthorized Page');
        }

        return View('tasks.edit')->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'todo' => 'required',
        ]);

        // Create Profile
        $task = Task::find($id);
        $tasks = Task::where('todo','=',$task->todo)->get();


        if(auth()->user()->user_type != 'Administrator'){
            $task->todo = $request->input('todo');
            $task->status = $request->input('status');
            $task->user_id = auth()->user()->id;
            $task->save();
        } else {
            foreach($tasks as $task2){
                $task2->todo = $request->input('todo');
                $task2->status = $request->input('status');
                $task2->user_id = $task2->user_id;
                $task2->save();
            }
        }

        if(auth()->user()->user_type != 'Administrator'){
            return redirect()->route('e-dashboard')->with('success', 'Task Updated');
        }
        else{
            return redirect()->route('a-dashboard')->with('success', 'Task Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $tasks = Task::where('todo','=',$task->todo)->get();

        //Check for correct user
        if(auth()->user()->user_type != 'Administrator'){
            return redirect('/tasks')->with('error', 'Unauthorized Page');
        }

        foreach($tasks as $task2){
            $task2->delete();
        }
        return redirect()->route('a-dashboard')->with('success', 'Task Deleted');
    }
}
