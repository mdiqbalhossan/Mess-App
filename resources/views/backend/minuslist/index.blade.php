@extends('layouts.backend.app')

@section('title', 'Deposit')

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Deposit /</span> Deposit List</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Deposit List
    </h5>
    <div class="table-responsive text-nowrap p-2">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Name</th>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($minusLists as $key => $value)
                <tr>
                    <td>
                        {{ $value->room_no }}
                    </td>
                    <td>
                        {{ $value->name }}
                    </td>
                    <td>
                        ৳{{ $value->balance }}
                    </td>               
                    <td>
                        <a href="{{ route('messagesend', $value->id) }}" class="btn btn-primary me-1">Notify</a>
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