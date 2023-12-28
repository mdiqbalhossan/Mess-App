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
                aria-hidden="true"></i>Notify All</a>
        <a href="{{ route('member.import') }}" class="btn btn-danger btn-sm float-end mx-2"><i class="fa fa-plus-circle"
            aria-hidden="true"></i>Import Member</a>
    </h5>
    <div class="table-responsive text-nowrap p-2">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Name</th>
                    <th>Number</th>
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
                        <span class="badge bg-dark">C:- {{ $user->contact_number }}</span>
                        <span class="badge bg-dark">W:- {{ $user->wa_number }}</span>
                    </td>
                    <td>
                        @if(amount($user->balance) < 0)
                        <span class="badge bg-label-danger me-1">৳{{ $user->balance }}</span>
                        @else
                        <span class="badge bg-label-success me-1">৳{{ $user->balance }}</span>
                        @endif
                    </td>
                    <td>
                        <button
                            class="btn btn-info btn-sm editBtn"
                            data-bs-toggle="modal"
                            data-bs-target="#basicModal"
                            data-contact_num="{{ $user->contact_number }}"
                            data-wa_num="{{ $user->wa_number }}"
                            data-id="{{ $user->id }}"
                        ><i class="bx bx-edit-alt me-1"></i></button>
                        <button
                            class="btn btn-dark btn-sm smsBtn"
                            data-bs-toggle="modal"
                            data-bs-target="#smsModal"
                            data-contact_num="{{ $user->contact_number }}"
                            data-id="{{ $user->id }}"
                            title="Send Message"
                        ><i class="bx bx-mail-send me-1"></i></button>
                        <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure want to delete?')){document.getElementById('dForm').submit()}"><i
                                class="bx bx-trash me-1"></i></a>
                        <form action="{{ route('member.destroy', $user->id) }}" method="post" id="dForm">
                            @csrf
                            @method('DELETE')
                        </form>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
<!--/ Basic Bootstrap Table -->

{{--Modal--}}


<!-- Edit Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit User</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="012xxxxxxxx" />
                        </div>
                        <div class="col mb-0">
                            <label for="wa_number" class="form-label">Whatsapp Number</label>
                            <input type="text" name="wa_number" id="wa_number" class="form-control" placeholder="017xxxxxxx" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--SMS Modal--}}
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
                            @foreach(config('sms.template') as $key => $template)
                                <option value="{{ $key }}">{{ ucwords($key) }}</option>
                            @endforeach
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
{{--Modal End--}}
@endsection

@push('js')
<script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    let table = new DataTable('#myTable');
    $(document).on('click', '.editBtn', function(e){
        e.preventDefault();
        var contact_num = $(this).data('contact_num');
        var wa_num = $(this).data('wa_num');
        var id = $(this).data('id');

        $("#contact_number").val(contact_num);
        $("#wa_number").val(wa_num);

        var actionUrl = "{{ route('member.update', ':id') }}";
        actionUrl = actionUrl.replace(':id', id);
        $('#editForm').attr('action', actionUrl);
    })
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
