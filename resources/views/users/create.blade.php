@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5>Add New User</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>                    

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create User</button>
                <a href="{{route('users.index')}}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const departmentSelect = document.getElementById('department');
        const subdepartmentSelect = document.getElementById('subdepartment');

        const subdepartments = {
            'Finance & Account': ['AAA', 'BBB', 'CCC'],
            'IT': ['DDD', 'EEE', 'FFF'],
            'Legal': ['GGG', 'HHH', 'III']
        };

        // Function to populate subdepartments based on the selected department
        function updateSubdepartments() {
            const selectedDepartment = departmentSelect.value;
            const options = subdepartments[selectedDepartment] || [];

            // Clear previous subdepartments
            subdepartmentSelect.innerHTML = '';

            // Populate new subdepartments
            options.forEach(function(subdepartment) {
                const option = document.createElement('option');
                option.value = subdepartment;
                option.textContent = subdepartment;
                subdepartmentSelect.appendChild(option);
            });
        }

        // Update subdepartments on department change
        departmentSelect.addEventListener('change', updateSubdepartments);

        // Trigger the update on page load
        updateSubdepartments();
    });
</script>

@endsection