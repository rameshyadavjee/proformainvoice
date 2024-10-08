@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>User List</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-3">
                    <a href="{{ route('users.create') }}" class="btn btn-success">Add New User</a>
                </div>
                <div class="col-md-5 offset-md-4">
                    <form method="post" name="search" action="{{route('search-user')}}">
                        @csrf
                        <input
                            type="search" class="form-control" placeholder="Find user here"
                            name="search" value="{{ request('search') }}">
                    </form>
                </div>
            </div>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <td align="center"><strong>#</strong></td>
                            <th>
                                <a href="{{ route('search-user', ['search' => request('search'), 'sort_by' => 'name', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                    Name
                                    @if(request('sort_by') == 'name')
                                    @if(request('order') == 'asc')
                                    <i class="fa fa-arrow-up"></i>
                                    @else
                                    <i class="fa fa-arrow-down"></i>
                                    @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('search-user', ['search' => request('search'), 'sort_by' => 'email', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                    Email
                                    @if(request('sort_by') == 'email')
                                    @if(request('order') == 'asc')
                                    <i class="fa fa-arrow-up"></i>
                                    @else
                                    <i class="fa fa-arrow-down"></i>
                                    @endif
                                    @endif
                                </a>
                            </th>
                            
                            <th>Role</th> 
                            <td align="middle"><strong>Status</strong></td>
                            <td width="5%" align="middle"><strong>Reset</strong></td>
                            <td width="5%" align="middle"><strong>Edit</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $key => $user)
                        <tr valign="middle">
                            <td align="center">{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                             
                            <td>{{ $user->roles->first()->display_name ?? "No role assigned "}}</td>
                             
                            <td align="middle">{{ $user->status }}</td>
                            <td align="center"><a href="{{ route('users.edit-password', $user->id) }}">Reset</a></td>
                            <td align="center"><a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Data Not Found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div>{{ $users->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>
@endsection