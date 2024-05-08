<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use DataTables;
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
        return view('tasks.index');
    }

    public function getTasks(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->role == 'Admin') {
                $data = Tasks::all();
            } else {
                $data = Tasks::all()->where('user_id', Auth::user()->id);
            }
            $data = $data->sortByDesc(function ($task) {
                return $task->created_at;
            });
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);

        }
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
        $tasks->status = $request->input('status');
        $tasks->save();
        return redirect()->route('tasks.index')->with('success', 'Task successfully saved');
    }

    public function show($id)
    {
        $task = Tasks::find($id);
        if (Auth::user()->role == 'Admin' || Auth::user()->id == $task->user_id) {
            return view('/tasks/edit')->with('tasks', $task);
        } else {
            return redirect()->route('tasks.index')->with('error', 'Access Denied: Unauthorized Person');
        }
    }

    public function update(Request $request, $id)
    {
        $task = Tasks::find($id);
        if (Auth::user()->role == 'Admin' || Auth::user()->id == $task->user_id) {
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->status = $request->input('status');
            $task->save();
            return redirect()->route('tasks.index')->with('success', 'Task successfully updated');
        } else {
            return redirect()->route('tasks.index')->with('error', 'Access Denied: Unauthorized Person');
        }
    }

    public function destroy($id)
    {
        $task = Tasks::find($id);
        if (Auth::user()->role == 'Admin' || Auth::user()->id == $task->user_id) {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Task successfully deleted');
        } else {
            return redirect()->route('tasks.index')->with('error', 'Access Denied: Unauthorized Person');
        }
    }
}
