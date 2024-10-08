@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Clients List</div>

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Add New Client</a>
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                            @endif
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
                        <thead class="table-active">
                            <tr valign="middle">
                                <th>ID</th>
                                <th>Business Name</th>
                                <th>Contact Name</th>
                                <th>Contact Phone</th>
                                <th>GST Number</th>
                                <th>Client Type</th>
                                <td width="12%" align="middle"><strong>Action</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $key => $client)
                            <tr valign="middle">
                                <td align="center">{{ $key + 1}}</td>
                                <td>{{ $client->business_name }}</td>
                                <td>{{ $client->contact_name }}</td>
                                <td>{{ $client->contact_number }}</td>
                                <td>{{ $client->gst_number }}</td>
                                <td>{{ $client->client_type }}</td>
                                <td align="right">
                                    <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-info">Show</a>
                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning">Edit</a>

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