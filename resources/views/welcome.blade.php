@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Proforma Invoice') }}</div>

                <div class="card-body">

                    <p>{{ __('Welcome to Proforma Invoice System.') }}</p><br>
                    <p>A streamlined solution designed to simplify your invoicing process. This system allows businesses to create professional, detailed proforma invoices that serve as a preliminary bill of sale, ensuring clarity and accuracy in transactions. With features like customizable fields for item descriptions, pricing, and terms, the Proforma Invoice System enhances efficiency while maintaining a user-friendly interface. Whether you're managing bulk orders or individual sales, our system provides an organized and reliable way to manage your invoicing needs, improving the flow of communication between suppliers and customers.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
