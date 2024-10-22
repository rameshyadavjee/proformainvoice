@extends('layouts.app')
@section('content')
<div class="container-fluid" style="font-size:10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header no-print">
                    <a href="{{ route('proforma.index') }}" class="btn btn-primary">Back to Proforma</a>
                    <a href="{{ route('proforma.download', $proforma->id) }}" class="btn btn-secondary">Download PDF</a>

                </div>
                <table class="table  table-bordered table-sm table-responsive-sm">
                    <tbody>
                        <tr>                    
                            <td colspan="2" align="left" style="font-size:medium;"><strong>Performa Invoice</strong>
                            <span style="float:right;"><img src="{{ asset('logo.png') }}" alt="logo" height="40" width="180px"></span>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">
                                <p><u><strong>SELLER</strong></u></p>
                                <p><strong>SWEETDISP PRIVATE LIMITED</strong></p>
                                <P>Tower B, 14th Floor, 1401-1403 & 1409-1420.</P>
                                <p>Navratna Corporate Park, Ambli</p>
                                <p>Ahmedabad-3800058</p>
                                <p>Navratna Corporate Park, Ambli</p>
                                <p>GSTIN - 24ABKCS5657D1Z7</p>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-8">PROFORMA INV. NO: <br>{{ getFinancialYear().$proforma->invoice_id}}</div>
                                    <div class="col-md-4">DATE: <br><?php echo date('d-m-Y'); ?></div>
                                    <div>
                                        <hr>
                                    </div>
                                    <div class="col-md-8">BUYER ORDER NO: <br>{{ getFinancialYear().$proforma->invoice_id}}</div>
                                    <div class="col-md-4">BUYER ORDER DATE: <br><?php echo date('d-m-Y'); ?></div>
                                    <div>
                                        <hr>
                                    </div>
                                    <p>OTHER REFERENCE(S):<BR>{{ $proforma->other_references }}</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><u><strong>BUYER</strong></u></p>
                                <p><strong>{{ $proforma->business_name }}</strong></p>
                                <P>{{ $proforma->address }}</P>
                                <p>GSTIN - {{ $proforma->gst_number }}</p>
                            </td>
                            <td>
                                <p><u><strong>SHIP TO</strong></u></p>
                                <p><strong>{{ $proforma->business_name }}</strong></p>
                                <p>{{ $proforma->ship_to }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>KIND ATTN: {{ $proforma->contact_name}} - {{ $proforma->contact_number }}</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>EXPECTED MATERIAL READY DATE: <br>
                                READY STOCK FOR IMMEDIATE DISPATCH
                            </td>
                            <td><strong>TERMS OF PAYMENT: <br>{{ $proforma->payment_terms}}</strong></td>
                        </tr>
                        <tr>
                            <table width="100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td align="center" valign="middle" width="5%"><strong>Sr. No</strong></td>
                                        <td align="center" valign="middle" width="7%"><strong>FG Code</strong></td>
                                        <td align="center" valign="middle" width="7%"><strong>SKU</strong></td>
                                        <td colspan="3" valign="bottom" width="15%">
                                            <table style="padding:0; width:100%">
                                                <tr>
                                                    <td align="center" colspan="3"><strong>DESCRIPTION OF GOODS</strong><br>
                                                        <hr>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="middle" width="50%"><strong>Item Name</strong></td>
                                                    <td align="center" valign="middle" width="5%"><strong>Number</strong></td>
                                                    <td align="center" valign="middle" width="40%"><strong>Dimension</strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td align="center" valign="middle" width="6%"><strong>Case <br> Pack</strong></td>
                                        <td align="center" valign="middle" width="8%"><strong>Order <br> (Case)</strong></td>
                                        <td align="center" valign="middle" width="8%"><strong>Total Qty <br> (In PCs)</strong></td>
                                        <td align="center" valign="middle" width="8%"><strong>Item<br> (GST)</strong></td>
                                        <td align="center" valign="middle" width="8%"><strong>Rate/PCs <br> In INR</strong></td>
                                        <td align="center" valign="middle"><strong>Basic Amount <br>In INR</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itemlist as $index => $item)
                                    <tr>
                                        <td align="center">{{ $index + 1 }}</td> <!-- Display row number -->
                                        <td align="center">{{ $item->nav_id }}</td>
                                        <td align="center">{{ $item->sku }}</td>
                                        <td align="left" width="20%">{{ $item->item_name }}</td>
                                        <td align="center">{{ $item->item_number }}</td>
                                        <td align="center">{{ $item->dimension }}</td>
                                        <td align="center">{{ $item->case_pack }}</td>
                                        <td align="center">{{ $item->case_order }}</td>
                                        <td align="center">{{ $item->qty_pcs }}</td>
                                        <td align="center">{{ $item->item_gst }}</td>
                                        <td align="center">{{ number_format($item->rate_case, 2) }}</td> <!-- Format to 2 decimal places -->
                                        <td align="center">{{ number_format($item->amount, 2) }}</td> <!-- Format to 2 decimal places -->
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="10"></td>
                                        <td align="center"><strong>Sub Total</strong></td>
                                        <td align="center"><strong>{{ $proforma->sub_total}}</strong></td>
                                    </tr>   
                                    <tr>
                                        <td align="right" colspan="11"><strong>Less {{ $proforma->scheme}}% Scheme</strong></td>
                                        <td align="center"><strong>{{ $proforma->scheme_amount}}</strong></td>
                                    </tr>                                    
                                    <tr>
                                        <td align="right" colspan="11"><strong>Total Amount</strong></td>
                                        <td align="center"><strong>{{ $proforma->amount}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td align="right" colspan="7"><strong>Total Box/Qty</strong></td>
                                        <td align="center"><strong>{{$proforma->total_box}}</strong></td>
                                        <td align="center"><strong>{{$proforma->total_qty}}</strong></td>
                                        <td></td>
                                        <td align="right"><strong>Freight/Courier</strong></td>
                                        <td align="center"><strong>{{$proforma->freight_charges}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td align="left" colspan="7" style="padding: 1;"><strong>AMOUNT CHARGEABLE: (IN WORDS)</strong>
                                            <hr><strong>{{AmountInWords($proforma->total_amount)}}</strong>
                                        </td>
                                        <td align="center" colspan="4"><strong>TOTAL IN INR <br> (INCLUDING GST)</strong></td>
                                        <td align="center" valign="middle"><strong>{{ $proforma->total_amount}}</strong> </td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="7" align="left" valign="middle" style="padding: 1;">
                                            <table class="table  table-bordered">
                                                <tr>
                                                    <td><strong>TOTAL BOX</strong></td>
                                                    <td><strong>{{$proforma->total_box}}</strong></td>
                                                    <td><strong>BANK NAME</strong></td>
                                                    <td><strong>ACCOUNT NO.</strong></td>
                                                    <td><strong>ISFC CODE</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>TOTAL QTY</strong></td>
                                                    <td><strong>{{$proforma->total_qty}}</strong></td>
                                                    <td><strong>HDFC BANK LTD.</strong></td>
                                                    <td><strong>50200076730552</strong></td>
                                                    <td><strong>HDFC0000901</strong></td>
                                                </tr>
                                            </table>
                                            <strong>BUYER CONFIRMATION NOTE:
                                                <hr>
                                                WE HEREBY ACCEPT YOUR PROFORMA INVOICE AND CONFIRM THE ORDER TO START PRODUCTION FOR THE SAME
                                            </strong>
                                        </td>
                                        <td colspan="5" align="center" valign="middle">MODE OF SHIPMENT: PART LOAD BASIS.<br>ESTIMATED DELIVERY TIME: 5-7 DAYS<br>
                                            (After realisation of the Advance Payment)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7"></td>
                                        <td colspan="5" align="center"><strong>E&amp;OE.</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" align="center"><strong>For, {{$proforma->business_name }}</strong></td>
                                        <td colspan="5" align="center"><strong>For, SWEETDISP PRIVATE LIMITED</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="height:50px !important;" valign="bottom" align="center"><strong>AUTHORISED SIGNATORY</strong></td>
                                        <td colspan="5" valign="bottom" align="center"><strong>AUTHORISED SIGNATORY</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="12">Order Acknowledgement with Signature &amp; Stamp of the Buyer</td>
                                    </tr>
                                </tbody>
                            </table>
                        </tr>
                    </tbody>
                </table>
                @if($proforma->status != 'Open')
                <div class="p-2">Remarks {{ $proforma->remarks }}</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection