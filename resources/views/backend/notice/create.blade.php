@extends('layouts.backend.app')

@section('title','Notice')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Notice/</span> Add Notice</h4>

<!-- Basic Layout -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add Notice</h5>
                <small class="text-muted float-end">Default label</small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('notice.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            id="room_no" />
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3"></textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Notice Type</label>
                        <select class="form-select" name="type" id="type" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="food">Food</option>
                            <option value="utility">Utility</option>
                            <option value="cooker">Cooker</option>
                            <option value="management">Management</option>
                        </select>
                        @error('type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Status</label>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="status" />
                            <label class="form-check-label" for="status"> Publish </label>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
