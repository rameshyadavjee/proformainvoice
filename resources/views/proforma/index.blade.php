@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Proforma Invoice') }}</div>

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <a href="{{ route('proforma.create') }}" class="btn btn-primary mb-3">Create New Proforma</a>
                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                        </div>
                        <div class="col-md-5 offset-md-4">
                            <form method="post" name="search" action="{{route('search-proforma')}}">
                                @csrf
                                <input
                                    type="search" class="form-control" placeholder="Find proforma here"
                                    name="search" value="{{ request('search') }}">
                            </form>
                        </div>
                    </div>


                    <table class="table table-hover table-bordered">
                        <thead class="table-active">
                            <tr valign="middle">
                                <th>#</th>
                                <th>Buyer</th>
                                <th>Contact Person</th>
                                <th>Contact Number</th>
                                <th>Total</th>
                                <th>Date</th>
                                <td align="middle"><strong>Status</strong></td>
                                <td align="middle"><strong>By</strong></td>
                                <td width="14%" align="middle"><strong>Action</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proformas as $key => $proforma)
                            <tr valign="middle">
                                <td align="center">{{ $proforma->id }}</td>
                                <td>{{ $proforma->business_name }}</td>
                                <td>{{ $proforma->contact_name }}</td>
                                <td>{{ $proforma->contact_number }}</td>
                                <td>{{ $proforma->total_amount }}</td>
                                <td>@if($proforma->created_at)
                                    {{ $proforma->created_at->format('d-M-Y') }}
                                    @else
                                    Not Available
                                    @endif
                                </td>
                                <td align="middle">{{ $proforma->status }}</td>
                                <td align="middle">{{ $proforma->created_by }}</td>
                                <td align="right">
                                    <a href="{{ route('proforma.show', $proforma->id) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('proforma.edit', $proforma->id) }}" class="btn btn-sm btn-warning">Update</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $proformas->links() }} <!-- Pagination links -->
                </div>

            </div>
        </div>
    </div>
</div>
@endsection