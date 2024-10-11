@extends('laratrust::panel.layout')
@section('title', 'Roles Assignment')
@section('content')
<div
  x-data="{ model: @if($modelKey) '{{$modelKey}}' @else 'initial' @endif }"
  x-init="$watch('model', value => value != 'initial' ? window.location = `?model=${value}` : '')">

  <div class="card-body">

    <table class="table table-hover table-bordered">
      <thead class="table-active table-dark">
        <tr>
          <td align="center"><strong>Id</strong></td>
          <th>Name</th>
          <td width="10%" align="center"><strong># Roles</strong></td>
          @if(config('laratrust.panel.assign_permissions_to_user'))
          <td  align="center"><strong># Permissions</strong></td>
          @endif
          <td width="5%" align="center"><strong>Action</strong></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td align="center">{{$user->getKey()}}</td>
          <td>{{$user->name ?? 'The model doesn\'t have a `name` attribute'}}</td>
          <td align="center">{{$user->roles_count}}</td>
          @if(config('laratrust.panel.assign_permissions_to_user'))
          <td align="center">{{$user->permissions_count}}</td>
          @endif
          <td align="center">
            <a href="{{route('laratrust.roles-assignment.edit', ['roles_assignment' => $user->getKey(), 'model' => $modelKey])}}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>

@if ($modelKey)
{{ $users->appends(['model' => $modelKey])->links('laratrust::panel.pagination') }}
@endif


@endsection