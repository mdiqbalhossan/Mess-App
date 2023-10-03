@extends('layouts.backend.app')

@section('title', 'Notice')

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Notice /</span> Notice List</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Notice List
        <a href="{{ route('notice.create') }}" class="btn btn-primary btn-sm float-end"><i class="fa fa-plus-circle"
                aria-hidden="true"></i>Add Notice</a>

    </h5>
    <div class="table-responsive text-nowrap p-2">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($notices as $key => $notice)
                <tr>
                    <td>
                        {{ Str::ucfirst($notice->type) }}
                    </td>
                    <td>
                        {{ $notice->title }}
                    </td>
                    <td>
                       {!! Str::limit($notice->description, 20) !!}
                    </td>
                    <td>
                       <span class="badge bg-primary">{{$notice->status == 1 ? 'Active' : 'Disable'}}</span>
                    </td>
                    <td title="{{$notice->created_at}}">
                        {{ $notice->created_at->diffForHumans() }}
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('notice.edit', $notice->id) }}"><i
                                        class="bx bx-edit-alt me-1"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"
                                    onclick="if(confirm('Are you sure want to delete?')){document.getElementById('dForm').submit()}"><i
                                        class="bx bx-trash me-1"></i>
                                    Delete</a>

                                <form action="{{ route('notice.destroy', $notice->id) }}" method="post" id="dForm">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

@push('js')
<script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    let table = new DataTable('#myTable');
</script>
@endpush
