@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tasks') }}</div>

                <div class="card-body">
                    <form action="{{ route('tasks.update', $tasks->id) }}" method="POST">
                        <div class="form-group mb-2">
                            <label class="form-label" for="title">Title</label>
                            <input class="form-control" id="title" name="title" value="{{$tasks->title}}">
                        </div>

                        <div class="form-group mb-2">
                            <label class="form-label" for="description">Description</label>
                            <input class="form-control" id="description" name="description" value="{{$tasks->description}}">
                        </div>

                        <div class="form-group mb-2">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-control" id="status" name="status" value="{{$tasks->status}}">
                                <option {{ $tasks->status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                <option {{ $tasks->status == 'CANCELED' ? 'selected' : '' }}>CANCELED</option>
                                <option {{ $tasks->status == 'IN-PROGRESS' ? 'selected' : '' }}>IN-PROGRESS</option>
                                <option {{ $tasks->status == 'COMPLETED' ? 'selected' : '' }}>COMPLETED</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <a class="btn btn-outline-secondary" href="{{ route('tasks.index') }}">
                                <i class="fa fa-home"></i> &nbsp; Back
                            </a>
                            
                            <button class="btn btn-outline-success" type="submit">
                                @csrf
                                @method('PUT')
                                <i class="fa fa-save"></i> &nbsp; Update Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
