@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Items Master </div>

                <div class="card-body">
                    <div class="row mb-2">
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="col-md-3">
                            <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Create New Item</a>
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
                        <thead class="table-active table-dark">
                            <tr valign="middle">
                                <td align="center"><strong>ID</strong></td>
                                <th>SKU</th>
                                <th>Item Name</th>
                                <td align="center"><strong>Dimension</strong></td>
                                <td align="center"><strong>Case Pack</strong></td>
                                <td align="center"><strong>Dealer Price</strong></td>
                                <td align="center"><strong>Trader Price</td>
                                <td align="center"><strong>MSP Price</strong></td>
                                <td align="center"><strong>GST</strong></td>
                                <td width="18%" align="middle"><strong>Action</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr valign="middle">
                                <td align="center">{{ $item->nav_id }}</td>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->item_name }}</td>
                                <td align="center">{{ $item->dimension }}</td>
                                <td align="center">{{ $item->case_pack }}</td>
                                <td align="center">{{ $item->dealer_rate }}</td>
                                <td align="center">{{ $item->trader_rate }}</td>
                                <td align="center">{{ $item->msp_rate }}</td>
                                <td align="center">{{ $item->gst }}</td>
                                <td align="center">
                                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-sm btn-info"><i class="bi bi-search"></i></a>
                                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash-fill"></i></button>
                                    </form>
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