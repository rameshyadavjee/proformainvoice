@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Item</div>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                
                <div class="card-body">
                    <form action="{{ route('items.update', $item->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-2 mb-2">
                                <label>Nav ID</label>
                                <input type="text" name="nav_id" value="{{ old('nav_id', $item->nav_id ?? '') }}" class="form-control">
                                @error('nav_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 mb-2">
                                <label>SKU</label>
                                <input type="text" name="sku" value="{{ old('sku', $item->sku ?? '') }}" class="form-control">
                                @error('sku')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label>Item Name</label>
                                <input type="text" name="item_name" value="{{ old('item_name', $item->item_name ?? '') }}" class="form-control">
                                @error('item_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 mb-2">
                                <label>Item Number</label>
                                <input type="text" name="item_number" value="{{ old('item_number', $item->item_number ?? '') }}" class="form-control">
                                @error('item_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-2 mb-2">
                                <label>Dimension</label>
                                <input type="text" name="dimension" value="{{ old('dimension', $item->dimension ?? '') }}" class="form-control">
                                @error('dimension')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 mb-2">
                                <label>Case Pack</label>
                                <input type="text" name="case_pack" value="{{ old('case_pack', $item->case_pack ?? '') }}" class="form-control">
                                @error('case_pack')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-2 mb-2">
                                <label>Dealer Rate</label>
                                <input type="text" name="dealer_rate" value="{{ old('dealer_rate', $item->dealer_rate ?? '') }}" class="form-control">
                                @error('dealer_rate')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 mb-2">
                                <label>Trader Rate</label>
                                <input type="text" name="trader_rate" value="{{ old('trader_rate', $item->trader_rate ?? '') }}" class="form-control">
                                @error('trader_rate')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 mb-2">
                                <label>MSP Rate</label>
                                <input type="text" name="msp_rate" value="{{ old('msp_rate', $item->msp_rate ?? '') }}" class="form-control">
                                @error('msp_rate')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 mt-4">
                                <button type="submit" class="btn btn-success">{{ 'Edit' }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection