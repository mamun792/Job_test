<div class="container">
    <h1>Employee Details</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Designation</th>
                <th>Salary</th>
                <th>Status</th>
                <th>Company</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>
                    Action</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->designation }}</td>
                <td>${{ $employee->salary }}</td>
                <td>{{ $employee->status }}</td>
                <td>{{ $employee->company_id }}</td>
                <td>{{ $employee->created_at }}</td>
                <td>{{ $employee->updated_at }}</ </tr>
                <td>
                    {{-- restore --}}
                    <form action="{{ route('employees.restore', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                    {{-- delete --}}
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
        </tbody>
    </table>
</div>
