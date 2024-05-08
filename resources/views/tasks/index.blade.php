@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Tasks') }}</div>

                <div class="card-body">
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{session('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
                    </div>
                    @endif

                    <div class="mb-2">
                        <a class="btn btn-outline-success" href='tasks/create'>
                            <i class="fa fa-plus"></i> &nbsp; Add
                        </a>
                    </div>

                    <table class="table table-bordered table-stripe tasks-datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th width=200px>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="module">
    var table = $('.tasks-datatable').DataTable({
        processing: true,
        serverside: true,
        dom: '<"d-flex justify-content-between" lf>t<"d-flex justify-content-between" ip>',
        ajax: "{{ route('tasks.list') }}",
        ordering: false,
        columns: [
            { data: 'title' },
            { data: 'description' },
            {
                data: 'status',
                render: (data) => {
                    let bgcolor
                    if(data == 'PENDING') { bgcolor = 'bg-dark'; }
                    else if(data == 'CANCELED') { bgcolor = 'bg-danger'; }
                    else if(data == 'IN-PROGRESS') { bgcolor = 'bg-primary'; }
                    else if(data == 'COMPLETED') { bgcolor = 'bg-success'; }
                    return `<span class="badge rounded-pill ${bgcolor}">${data}</span>`;
                }
            },
            {
                data: null,
                render: (task) => {
                    return `
                    <div class="d-flex justify-content-center">
                        <div class="my-auto">
                            <a class="btn btn-outline-primary m-1" href="tasks/${task.id}/edit">
                                <i class="fa fa-edit"></i> &nbsp; Edit
                            </a>
                        </div>
                        
                        <form action="tasks/${task.id}" method="POST" class="my-auto">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger m-1">
                                <i class="fa fa-trash"></i> &nbsp; Delete
                            </button>
                        </form>
                    </div>
                    `               
                }
            },
        ]
    })
</script>
@endpush