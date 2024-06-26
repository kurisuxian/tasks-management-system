@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tasks') }}</div>

                <div class="card-body">
                    <form action="/tasks" method="POST">
                        <div class="form-group mb-2">
                            <label class="form-label" for="title">Title</label>
                            <input class="form-control" id="title" name="title">
                        </div>

                        <div class="form-group mb-2">
                            <label class="form-label" for="description">Description</label>
                            <input class="form-control" id="description" name="description">
                        </div>

                        <div class="form-group mb-2">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option>PENDING</option>
                                <option>CANCELED</option>
                                <option>IN-PROGRESS</option>
                                <option>COMPLETED</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <a class="btn btn-outline-secondary" href="{{ route('tasks.index') }}">
                                <i class="fa fa-home"></i> &nbsp; Back
                            </a>
                            
                            <button class="btn btn-outline-success" type="submit">
                                @csrf
                                <i class="fa fa-save"></i> &nbsp; Add Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
