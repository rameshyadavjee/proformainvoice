@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Client</div>

                <div class="card-body">
                    <form action="{{ route('clients.update', $client->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6 mb-2">
                                <label>Business Name</label>
                                <input type="text" name="business_name" value="{{ old('business_name', $client->business_name ?? '') }}" class="form-control">
                                @error('business_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <label>Contact Name</label>
                                <input type="text" name="contact_name" value="{{ old('contact_name', $client->contact_name ?? '') }}" class="form-control">
                                @error('contact_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <label>Address</label>
                                <textarea name="address" class="form-control">{{ old('address', $client->address ?? '') }}</textarea>
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <label>Payment Terms</label>
                                <textarea name="payment_terms" class="form-control">{{ old('payment_terms', $client->payment_terms ?? '') }}</textarea>
                                @error('payment_terms')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 mb-2">
                                <label>Contact Number</label>
                                <input type="text" name="contact_number" value="{{ old('contact_number', $client->contact_number ?? '') }}" class="form-control">
                                @error('contact_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-2 mb-2">
                                <label>GST Number</label>
                                <input type="text" name="gst_number" value="{{ old('gst_number', $client->gst_number ?? '') }}" class="form-control">
                                @error('gst_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-2 mb-2">
                                <label>Client Type</label>
                                <select name="client_type" class="form-select">
                                    <option value="Dealer" {{ old('client_type', $client->client_type ?? '') == 'Dealer' ? 'selected' : '' }}>Dealer</option>
                                    <option value="Trader" {{ old('client_type', $client->client_type ?? '') == 'Trader' ? 'selected' : '' }}>Trader</option>
                                    <option value="MSP" {{ old('client_type', $client->client_type ?? '') == 'MSP' ? 'selected' : '' }}>MSP</option>
                                </select>
                                @error('client_type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-2 ">
                                <label>Client Status</label>
                                <select name="status" class="form-select">
                                    <option value="Active" {{ old('status', $client->status ?? '') == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ old('status', $client->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('client_type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-2 offset-md-1 mt-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection