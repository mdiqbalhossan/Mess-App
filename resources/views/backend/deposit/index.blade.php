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
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($deposits as $key => $value)
                <tr>
                    <td>
                        {{ $value->member->room_no }}
                    </td>
                    <td>
                        {{ $value->member->name }}
                    </td>
                    <td>
                        ৳{{ $value->amount }}
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