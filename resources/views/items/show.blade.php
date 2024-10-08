@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Client Details</div>

                <div class="card-body">
                    <p><strong>Nav ID:</strong> {{ $item->nav_id }}</p>
                    <p><strong>SKU:</strong> {{ $item->sku }}</p>
                    <p><strong>Item Name:</strong> {{ $item->item_name }}</p>
                    <p><strong>Item Number:</strong> {{ $item->item_number }}</p>                    
                    <p><strong>Dimension:</strong> {{ $item->dimension }}</p>
                    <p><strong>Case Pack:</strong> {{ $item->case_pack }}</p>
                    <p><strong>Dealer Rate:</strong> {{ $item->dealer_rate }}</p>
                    <p><strong>Trader Rate:</strong> {{ $item->trader_rate }}</p>
                    <p><strong>MSP Rate:</strong> {{ $item->msp_rate }}</p>
                    <a href="{{ route('items.index') }}" class="btn btn-primary">Back to Clients</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection