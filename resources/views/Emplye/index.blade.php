@extends('layouts.fontend_master');

@section('content')
    <div class=" ">
        <div class="row">
            <div class="col-sm col-6">
                <div class="container mt-3">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-header">
                            <h2 class="card-title">Employee Information Form</h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('employees.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" class="form-control" name="first_name"
                                        placeholder="Enter first name">
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" class="form-control" name="last_name"
                                        placeholder="Enter last name">
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone:</label>
                                    <input type="tel" class="form-control" name="phone"
                                        placeholder="Enter phone number">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation:</label>
                                    <input type="text" class="form-control" name="designation"
                                        placeholder="Enter designation">
                                    @if ($errors->has('designation'))
                                        <span class="text-danger">{{ $errors->first('designation') }}</span>
                                    @endif
                                </div>
                                <div class="form-group pt-2">
                                    <label for="salary">Salary:</label>
                                    <input type="number" class="form-control" name="salary" placeholder="Enter salary">
                                    @if ($errors->has('salary'))
                                        <span class="text-danger">{{ $errors->first('salary') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control  pt-2" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                                <div class="form-group pt-2 pb-3">
                                    <label for="image">Image:</label>
                                    <input type="file" class="form-control-file" name="image">
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                                <div class="form-group pt-2 pb-3">
                                    <label for="company_id">Company ID:</label>
                                    <input type="text" class="form-control" name="company_id"
                                        placeholder="Enter company ID">
                                    @if ($errors->has('company_id'))
                                        <span class="text-danger">{{ $errors->first('company_id') }}</span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm col-6">
                <div class="container mt-3">
                    <h2>Employee List</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Email</th>
                                <th>Designation</th>
                                <th>phone</th>
                                <th>Salary</th>
                                <th>Status</th>

                                <th>Company ID</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emplye as $emplyes)
                                <tr>
                                    <td>
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td>
                                        {{ $emplyes->first_name }} {{ $emplyes->last_name }}
                                    </td>
                                    <td>
                                        <img src="{{ asset('uploads/employee/' . $emplyes->image) }}"
                                            alt="{{ $emplyes->first_name }}" width="100px" height="100px">
                                    </td>
                                    <td>{{ $emplyes->email }}</td>
                                    <td>
                                        {{ $emplyes->designation }}
                                    </td>
                                    <td>
                                        {{ $emplyes->phone }}
                                    </td>
                                    <td>
                                        {{ $emplyes->salary }}
                                    </td>
                                    <td>
                                        {{ $emplyes->status }}
                                    </td>
                                    <td>
                                        {{ $emplyes->company_id }}
                                    </td>
                                    <td>
                                        <div class="btn-group gap">
                                            <a class="btn btn-primary" href="{{ route('employees.show', $emplyes->id) }}">
                                                <i class="ri-pencil-line">Edit</i>
                                            </a>

                                            <button class="btn btn-danger"
                                                onclick="confrimDelete({{ $emplyes->id }})">Delete</button>


                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>Trashed Employees</h1>
        @isset($employees)
            @foreach ($employees as $employee)
                <x-employee-card :employee="$employee" />
            @endforeach
        @else
            <p>No trash</p>
        </div>
    @endisset
@endsection

@section('fotter_scprit')
    <script>
        function confrimDelete(id) {
            const data = id;
            let choice = confirm('Are you sure, You want to delete this record?');
            if (choice) {


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('employees.softDelete', '') }}/" + data,
                    data: {
                        id: data
                    },

                    success: function(response) {
                        console.log('Response:', response);
                        alert(response.success);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

            }
        }
    </script>
@endsection
