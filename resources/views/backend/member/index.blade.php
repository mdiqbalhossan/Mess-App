@extends('layouts.backend.app')

@section('title', 'Member')

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Member /</span> Member List</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Member List
        <a href="{{ route('member.create') }}" class="btn btn-primary btn-sm float-end"><i class="fa fa-plus-circle"
                aria-hidden="true"></i>Add Member</a>
        {{-- <a href="{{ route('member.import') }}" class="btn btn-danger btn-sm float-end mx-2"><i class="fa fa-plus-circle"
            aria-hidden="true"></i>Import Member</a> --}}
    </h5>
    <div class="table-responsive text-nowrap p-2">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Month-Year</th>
                    <th>Unique Id</th>
                    <th>Balance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($users as $key => $user)
                <tr>
                    <td>
                        {{ $user->room_no }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        <small>C:- {{ $user->contact_number }}</small>
                        <small>W:- {{ $user->wa_number }}</small>
                    </td>
                    <td>
                        {{ $user->month }}, {{ $user->year }}
                    </td>
                    <td>
                        {{ $user->u_id }}
                    </td>
                    <td>
                        @if($user->balance < 0)
                        <span class="badge bg-label-danger me-1">৳{{ $user->balance }}</span>
                        @else
                        <span class="badge bg-label-success me-1">৳{{ $user->balance }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('member.edit', $user->id) }}"><i
                                        class="bx bx-edit-alt me-1"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"
                                    onclick="if(confirm('Are you sure want to delete?')){document.getElementById('dForm').submit()}"><i
                                        class="bx bx-trash me-1"></i>
                                    Delete</a>

                                <form action="{{ route('member.destroy', $user->id) }}" method="post" id="dForm">
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