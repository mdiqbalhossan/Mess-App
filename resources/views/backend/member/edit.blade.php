@extends('layouts.backend.app')

@section('title','Member')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Member/</span> Edit Member</h4>

<!-- Basic Layout -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Member</h5>
                <small class="text-muted float-end">Default label</small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('member.update', $member->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label" for="room_no">Room No</label>
                        <input type="text" name="room_no" class="form-control @error('room_no') is-invalid @enderror"
                            id="room_no" value="{{ $member->room_no }}"/>
                        @error('room_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" value="{{ $member->name }}"/>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact_number">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror"
                            id="contact_number" value="{{ $member->contact_number }}"/>
                        @error('contact_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="wa_number">WhatsApp Number</label>
                        <input type="text" name="wa_number" class="form-control @error('wa_number') is-invalid @enderror"
                            id="wa_number" value="{{ $member->wa_number }}"/>
                        @error('wa_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
@endpush