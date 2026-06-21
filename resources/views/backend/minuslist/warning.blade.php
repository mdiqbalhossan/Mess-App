@extends('layouts.backend.app')

@section('title', 'Warning List')

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Warning /</span> Warning List</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Warning List
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
                @foreach ($balancesWarning as $key => $user)
                <tr>
                    <td>
                        {{ $user->room_no }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        ৳{{ $user->balance }}
                    </td>
                    <td>
                        <button
                            class="btn btn-dark btn-sm smsBtn"
                            data-bs-toggle="modal"
                            data-bs-target="#smsModal"
                            data-contact_num="{{ $user->contact_number }}"
                            data-id="{{ $user->id }}"
                            title="Send Message"
                        ><i class="bx bx-mail-send me-1"></i></button>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
<!--/ Basic Bootstrap Table -->
<div class="modal fade" id="smsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Send SMS</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form action="{{ route('sendMessage') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <input type="hidden" name="id" id="sms_id" value="">
                        <div class="col mb-0">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number_sms" class="form-control" placeholder="012xxxxxxxx" readonly/>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="template" class="form-label">Select Template</label>
                        <select class="form-select" id="template" name="template" aria-label="Default select example" required>
                            <option selected disabled>-- Select Template --</option>
                            <option value="warning">Warning</option>
                        </select>
                    </div>
                    <div class="d-none" id="template_text">
                        <label for="template_data" class="form-label">Template Text</label>
                        <textarea class="form-control" id="template_data" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-dark">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    let table = new DataTable('#myTable');
    $(document).on('click', '.smsBtn', function(e){
        e.preventDefault();
        var contact_num = $(this).data('contact_num');
        var id = $(this).data('id');

        $("#contact_number_sms").val(contact_num);
        $("#sms_id").val(id);
    })
    @php
        $templates = config('sms.template');
    @endphp
    $(document).on('change', '#template', function(){
        $("#template_text").removeClass('d-none');
        var key = $(this).val();
        var data = @json($templates);
        $("#template_data").val(data[key]);
    })
</script>
@endpush
