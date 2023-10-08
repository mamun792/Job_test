@extends('layouts.fontend_master');

@section('content')
    <div class="container mt-5 ">
        <div class="row">
            <!-- Employee Card -->
            <div class="col-md-4 mb-4 ">
                <div class="card p-3">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('error') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employees.update', $employee->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" name="first_name"
                                value="{{ $employee->first_name }}">

                            @if ($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="editLastName">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" value="{{ $employee->last_name }}">
                            @if ($errors->has('last_name'))
                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="editPhone">Phone:</label>
                            <input type="tel" class="form-control" name="phone" value="{{ $employee->phone }}">
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="editDesignation">Designation:</label>
                            <input type="text" class="form-control" name="designation"
                                value="{{ $employee->designation }}">
                            @if ($errors->has('designation'))
                                <span class="text-danger">{{ $errors->first('designation') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="editDesignation">Salary:</label>
                            <input type="text" class="form-control" name="salary" value="{{ $employee->salary }}">
                            @if ($errors->has('salary'))
                                <span class="text-danger">{{ $errors->first('salary') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="editDesignation">Company Id:</label>
                            <input type="text" class="form-control" name="company_id"
                                value="{{ $employee->company_id }}">
                            @if ($errors->has('company_id'))
                                <span class="text-danger">{{ $errors->first('company_id') }}</span>
                            @endif
                        </div>
                        {{-- submit button --}}
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>

            </div>
        </div>
        <!-- End of Employee Card -->
    </div>
    </div>
@endsection
