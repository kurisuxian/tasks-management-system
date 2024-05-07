@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header">{{ __('Tasks') }}</div>

                <div class="card-body">

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif

                    <div class="mb-2">
                        <a class="btn btn-outline-success" href='tasks/create'>
                            <i class="fa fa-plus"></i> &nbsp; Add
                        </a>
                    </div>

                    <table class="table table-bordered table-stripe">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($tasks))
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{$task->title}}</td>
                                        <td>{{$task->description}}</td>
                                        <td class="d-flex justify-content-center">
                                            <a class="btn btn-outline-primary m-1" href="{{'tasks/' . $task->id . '/edit'}}">
                                                <i class="fa fa-edit"></i> &nbsp; Edit
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger m-1">
                                                    <i class="fa fa-trash"></i> &nbsp; Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
