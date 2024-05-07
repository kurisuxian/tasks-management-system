@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tasks') }}</div>

                <div class="card-body">
                    @if(isset($tasks)) <form action="{{ route('tasks.update', $tasks->id) }}" method="POST">
                    @else <form action="/tasks" method="POST">
                    @endif
                        <div class="form-group mb-2">
                            <label class="form-label" for="title">Title</label>
                            <input class="form-control" id="title" name="title" value="@if(isset($tasks)) {{$tasks->title}} @endif">
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label" for="description">Description</label>
                            <input class="form-control" id="description" name="description" value="@if(isset($tasks)) {{$tasks->description}} @endif">
                        </div>
                        <div class="mb-2">
                            <button class="btn btn-outline-success" type="submit">
                                @csrf
                                <i class="fa fa-save"></i> &nbsp; 
                                @if(isset($tasks)) Update Task
                                @method('PUT')
                                @else Add Task
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
