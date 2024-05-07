<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::find(Auth::id());
        if ($user->role == 'Admin') {
            $tasks = Tasks::all();
        } else {
            $tasks = Tasks::all()->where('user_id', $user->id);
        }
        return view('tasks.index')->with('tasks', $tasks);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $tasks = new Tasks();
        $tasks->title = $request->input('title');
        $tasks->description = $request->input('description');
        $tasks->user_id = Auth::id();
        $tasks->save();
        return redirect()->route('tasks.index')->with('success', 'Task successfully saved');
    }
    public function show($id)
    {
        $tasks = Tasks::find($id);
        $user = User::find(Auth::id());
        if ($user->role == 'Admin' || $user->id == $tasks->user_id) {
            return view('/tasks/create')->with('tasks', $tasks);
        } else {
            return redirect()->route('tasks.index')->with('error', 'Access Denied: Unauthorized Person');
        }
    }

    public function update(Request $request, $id)
    {
        $task = Tasks::find($id);
        $user = User::find(Auth::id());
        if ($user->role == 'Admin' || $task->user_id == $user->id) {
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->save();
            return redirect()->route('tasks.index')->with('success', 'Task successfully updated');
        } else {
            return redirect()->route('tasks.index')->with('error', 'Access Denied: Unauthorized Person');
        }
    }

    public function destroy($id)
    {
        $task = Tasks::find($id);
        $user = User::find(Auth::id());
        if ($user->role == 'Admin' || $task->user_id == $user->id) {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Task successfully deleted');
        } else {
            return redirect()->route('tasks.index')->with('error', 'Access Denied: Unauthorized Person');
        }
    }
}
