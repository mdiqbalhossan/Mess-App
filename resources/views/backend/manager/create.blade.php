@extends('layouts.backend.app')

@section('title','Manager')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manager/</span> Add Manager</h4>

<!-- Basic Layout -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add Manager</h5>
                <small class="text-muted float-end">Default label</small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('manager.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Select Member</label>
                                <select class="form-select" name="member_id" id="exampleFormControlSelect1" aria-label="Default select example">
                                  <option selected>Open this select member</option>
                                  @foreach ($member as $val)
                                  <option value="{{ $val->id }}">{{ $val->name }} ({{ $val->room_no }})</option>
                                  @endforeach                                  
                                </select>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    id="name" />
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="month">Month</label>
                                <input type="month" name="month" class="form-control @error('month') is-invalid @enderror"
                                    id="month" />
                                @error('month')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="cash">Starting Cash</label>
                                <input type="number" name="cash" class="form-control @error('cash') is-invalid @enderror"
                                    id="cash" />
                                @error('cash')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" />
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" />
                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" />
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>                  
                    
                    
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection