@extends('layouts.backend.app')

@section('title', 'Manager')

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manager /</span> Manager List</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Manager List
        <a href="{{ route('manager.create') }}" class="btn btn-primary btn-sm float-end"><i class="fa fa-plus-circle"
                aria-hidden="true"></i>Add Manager</a>        
    </h5>
    <div class="table-responsive text-nowrap p-2">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Month-Year</th>                    
                    <th>Starting Cash</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($managers as $key => $manager)
                <tr>
                    <td>
                        {{ $manager->member->room_no }}
                    </td>
                    <td>
                        {{ $manager->member->name }}
                    </td>
                    <td>
                        {{ $manager->user->phone }}
                    </td>
                    <td>
                        {{ $manager->user->email }}
                    </td>
                    <td>
                        {{ $manager->month }}, {{ $manager->year }}
                    </td>
                    <td>
                        {{ $manager->cash }}
                    </td>
                    
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('member.edit', $manager->id) }}"><i
                                        class="bx bx-edit-alt me-1"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"
                                    onclick="if(confirm('Are you sure want to delete?')){document.getElementById('dForm').submit()}"><i
                                        class="bx bx-trash me-1"></i>
                                    Delete</a>

                                <form action="{{ route('manager.delete', $manager->id) }}" method="post" id="dForm">
                                    @csrf                                    
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