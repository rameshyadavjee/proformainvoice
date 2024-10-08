@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Client Details</div>
                
                <div class="card-body">
                    <p><strong>Business Name:</strong> {{ $client->business_name }}</p>
                    <p><strong>Contact Name:</strong> {{ $client->contact_name }}</p>
                    <p><strong>Contact Number:</strong> {{ $client->contact_number }}</p>
                    <p><strong>Address:</strong> {{ $client->address }}</p>
                    <p><strong>GST Number:</strong> {{ $client->gst_number }}</p>
                    <p><strong>Payment Terms:</strong> {{ $client->payment_terms }}</p>
                    <p><strong>Client Type:</strong> {{ $client->client_type }}</p>

                    <a href="{{ route('clients.index') }}" class="btn btn-primary">Back to Clients</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection