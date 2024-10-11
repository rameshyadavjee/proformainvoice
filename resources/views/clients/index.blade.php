@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Clients List</div>

                <div class="card-body">
                    <div class="row mb-2">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                        @endif
                        <div class="col-md-3">
                            <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Add New Client</a>
                        </div>
                        <div class="col-md-5 offset-md-4">
                            <form method="post" name="search" action="{{route('search-client')}}">
                                @csrf
                                <input
                                    type="search" class="form-control" placeholder="Find client here"
                                    name="search" value="{{ request('search') }}">
                            </form>
                        </div>
                    </div>


                    <table class="table table-hover table-bordered">
                        <thead class="table-active table-dark">
                            <tr valign="middle">
                                <th>ID</th>
                                <th>Business Name</th>
                                <th>Contact Name</th>
                                <td align="center"><strong>Contact Phone</strong></td>
                                <td align="center"><strong>GST Number</strong></td>
                                <td align="center"><strong>Client Type</strong></td>
                                <td width="18%" align="middle"><strong>Action</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $key => $client)
                            <tr valign="middle">
                                <td align="center">{{ $client->id}}</td>
                                <td>{{ $client->business_name }}</td>
                                <td>{{ $client->contact_name }}</td>
                                <td align="center">{{ $client->contact_number }}</td>
                                <td align="center">{{ $client->gst_number }}</td>
                                <td align="center">{{ $client->client_type }}</td>
                                <td align="center">
                                <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-info"><i class="bi bi-search"></i></a>
                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $clients->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection