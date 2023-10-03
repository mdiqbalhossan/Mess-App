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
                <form method="POST" action="{{route('notice.update', $notice->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input type="text" name="title" value="{{$notice->title}}" class="form-control @error('title') is-invalid @enderror"
                               id="room_no" />
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">
                            {!! $notice->description !!}
                        </textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Notice Type</label>
                        <select class="form-select" name="type" id="type" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="food" {{$notice->type == 'food' ? 'selected' : ''}}>Food</option>
                            <option value="utility" {{$notice->type == 'utility' ? 'selected' : ''}}>Utility</option>
                            <option value="cooker" {{$notice->type == 'cooker' ? 'selected' : ''}}>Cooker</option>
                            <option value="management" {{$notice->type == 'management' ? 'selected' : ''}}>Management</option>
                        </select>
                        @error('type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Status</label>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{$notice->status == 1 ? 'checked' : ''}}/>
                            <label class="form-check-label" for="status"> Publish </label>
                        </div>

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
