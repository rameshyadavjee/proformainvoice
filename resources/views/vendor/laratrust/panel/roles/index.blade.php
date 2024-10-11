@extends('laratrust::panel.layout')

@section('title', 'Roles')

@section('content')
<div class="card-body">
  <a href="{{ route('laratrust.roles.create') }}" class="btn btn-primary mb-3">+ New Role</a>
  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-hover table-bordered">
    <thead class="table-active table-dark">
      <tr>
        <td align="center"><strong>ID</strong></td>
        <th>Display Name</th>
        <th>Name</th>
        <td align="center"><strong># Permissions</strong></td>
        <td align="center"><strong>Action</strong></td>
      </tr>
    </thead>
    <tbody>
      @foreach ($roles as $role)
      <tr>
        <td align="center">{{$role->getKey()}}</td>
        <td>{{$role->display_name}}</td>
        <td>{{$role->name}}</td>
        <td align="center">{{$role->permissions_count}}</td>
        <td align="center" width="15%">
          <div class="row">
            @if (\Laratrust\Helper::roleIsEditable($role))
            <div class="col-md-6"><a href="{{route('laratrust.roles.edit', $role->getKey())}}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></a></div>
            @else
            <div class="col-md-6"><a href="{{route('laratrust.roles.show', $role->getKey())}}" class="btn btn-sm btn-secondary"><i class="bi bi-search"></i></a></div>
            @endif
            <div class="col-md-6">
              <form
                action="{{route('laratrust.roles.destroy', $role->getKey())}}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to delete the record?');">
                @method('DELETE')
                @csrf
                <input type="submit" class="btn btn-sm btn-danger"
                  @if(!\Laratrust\Helper::roleIsDeletable($role)) disabled @endif value="Delete">
              </form>
            </div>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $roles->links('laratrust::panel.pagination') }}
</div>

@endsection