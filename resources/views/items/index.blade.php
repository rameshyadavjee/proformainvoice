@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Items Master</div>

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Create New Item</a>
                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                        </div>
                        <div class="col-md-5 offset-md-4">
                            <form method="post" name="search" action="{{route('search-item')}}">
                                @csrf
                                <input
                                    type="search" class="form-control" placeholder="Find item here"
                                    name="search" value="{{ request('search') }}">
                            </form>
                        </div>
                    </div>

                    <table class="table table-hover table-bordered">
                        <thead class="table-active">
                            <tr valign="middle">
                                <td align="center"><strong>ID</strong></td>
                                <th>SKU</th>
                                <th>Item Name</th>
                                <th>Dimension</th>
                                <th>Case Pack</th>
                                <th>Dealer Price</th>
                                <th>Trader Price</th>
                                <th>MSP Price</th>
                                <td width="12%" align="middle"><strong>Action</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr valign="middle">
                                <td align="center">{{ $item->nav_id }}</td>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->dimension }}</td>
                                <td>{{ $item->case_pack }}</td>
                                <td>{{ $item->dealer_rate }}</td>
                                <td>{{ $item->trader_rate }}</td>
                                <td>{{ $item->msp_rate }}</td>
                                <td align="right">
                                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $items->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection