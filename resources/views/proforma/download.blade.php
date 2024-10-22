<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Download</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        body {
            font-size: 0.6rem;
        }

        p {
            height: 0.4rem;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            /* Ensures borders don't double up */
            padding-left: 5px;
        }

        hr {
            border: none;
            border-top: 1px solid black;

        }
    </style>

</head>

<body>
    <table width="100%" style="border:1px solid black; border-collapse:collapse; ">
        <tbody>
            <tr>
                <td colspan="2" align="left" style="font-size:medium; border: 1px solid; height:40px !important;">
                    <strong>Performa Invoice</strong>
                    <span style="float:right;"><img src="../public/logo.png" alt="logo" height="40" width="180px"></span>
                </td>
            </tr>
            <tr>
                <td width="50%" valign="top">
                    <div class="row">
                        <p><u><strong>SELLER</strong></u></p>
                        <p><strong>SWEETDISP PRIVATE LIMITED</strong></p>
                        <P>Tower B, 14th Floor, 1401-1403 & 1409-1420.</P>
                        <p>Navratna Corporate Park, Ambli</p>
                        <p>Ahmedabad-3800058</p>
                        <p>Navratna Corporate Park, Ambli</p>
                        <p>GSTIN - 24ABKCS5657D1Z7</p>
                    </div>
                </td>
                <td width="50%" valign="top" style="padding: 0px !important;">
                    <table width="100%" style="padding: 0px !important; border:0px !important;">
                        <tr>
                            <td class="col-md-8" style="border-top:0px;border-left:0px;">PROFORMA INV. NO: <br>{{ getFinancialYear().$proforma->invoice_id}}</td>
                            <td class="col-md-4" style="border-top:0px;border-right:0px;">DATE: <br><?php echo date('d-m-Y'); ?></td>
                        </tr>
                        <tr>                        
                            <td class="col-md-8" style="border-left:0px;">BUYER ORDER NO: <br>{{ getFinancialYear().$proforma->invoice_id}}</td>
                            <td class="col-md-4" style="border-right:0px;">BUYER ORDER DATE: <br><?php echo date('d-m-Y'); ?></td>
                        </tr>                        
                    </table>    
                    <p style="padding-left:5px !important;">OTHER REFERENCE(S):<BR>{{ $proforma->other_references }}</p>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <p><u><strong>BUYER</strong></u></p>
                    <p><strong>{{ $proforma->business_name }}</strong></p>
                    <P>{{ $proforma->address }}</P>
                    <p>GSTIN - {{ $proforma->gst_number }}</p>
                </td>
                <td valign="top">
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
                <td>EXPECTED MATERIAL READY DATE: <br>READY STOCK FOR IMMEDIATE DISPATCH</td>
                <td><strong>TERMS OF PAYMENT: <br>{{ $proforma->payment_terms}}</strong></td>
            </tr>
        </tbody>
    </table>
    <table width="100%" padding="0" >
        <tbody>
            <tr>
                <td align="center" valign="middle"><strong>Sr. No</strong></td>
                <td align="center" valign="middle"><strong>FG Code</strong></td>
                <td align="center" valign="middle"><strong>SKU</strong></td>
                <td align="center" valign="middle"><strong>Item Name</strong></td>
                <td align="center" valign="middle"><strong>Number</strong></td>
                <td align="center" valign="middle"><strong>Dimension</strong></td>
                <td align="center" valign="middle"><strong>Case <br> Pack</strong></td>
                <td align="center" valign="middle"><strong>Order <br> (Case)</strong></td>
                <td align="center" valign="middle"><strong>Total Qty <br> (In PCs)</strong></td>
                <td align="center" valign="middle"><strong>Item<br> (GST)</strong></td>
                <td align="center" valign="middle"><strong>Rate/PCs <br> In INR</strong></td>
                <td align="center" valign="middle"><strong>Total Amount <br>In INR</strong></td>
            </tr>

            @foreach($itemlist as $index => $item)
            <tr>
                <td align="center">{{ $index + 1 }}</td> <!-- Display row number -->
                <td align="center">{{ $item->nav_id }}</td>
                <td align="center">{{ $item->sku }}</td>
                <td align="left">{{ $item->item_name }}</td>
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
                <td align="right"  colspan="11"><strong>Less {{ $proforma->scheme}}% Scheme</strong></td>
                <td align="center"><strong>{{ $proforma->scheme_amount}}</strong></td>
            </tr>            
            <tr>  
                <td align="right"  colspan="11"><strong>Total Amount</strong></td>
                <td align="center"><strong>{{ $proforma->amount}}</strong></td>
            </tr>                
            </tr>
                <td align="right" colspan="7"><strong>Total Box/Qty</strong></td>
                <td align="center"><strong>{{$proforma->total_box}}</strong></td>
                <td align="center"><strong>{{$proforma->total_qty}}</strong></td>
                <td></td>
                <td align="right"><strong>Freight/Courier</strong></td>
                <td align="center"><strong>{{$proforma->freight_charges}}</strong></td>
            </tr>           
            <tr>
                <td align="left" colspan="8" style="padding: 1;"><strong>AMOUNT CHARGEABLE: (IN WORDS)</strong>
                    <hr><strong>{{AmountInWords($proforma->total_amount)}}</strong>
                </td>
                <td align="center" colspan="3"><strong>TOTAL IN INR <br> (INCLUDING GST)</strong></td>
                <td align="center" valign="middle"><strong>{{ $proforma->total_amount}}</strong> </td>
            </tr>
            <tr>
                <td colspan="8" align="left" valign="middle" style="padding: 0px !important;">
                    <table width="100%" style="padding: 0px !important; border:0px !important">
                        <tr>
                            <td><strong>TOTAL BOX</strong></td>
                            <td width=" 5%"><strong>{{$proforma->total_box}}</strong></td>
                            <td><strong>BANK NAME</strong></td>
                            <td><strong>ACCOUNT NO.</strong></td>
                            <td><strong>ISFC CODE</strong></td>
                        </tr>
                        <tr>
                        <td class="col-md-2"><strong>TOTAL QTY</strong></td>
                        <td class="col-md-2"><strong>{{$proforma->total_qty}}</strong></td>
                        <td class="col-md-2"><strong>HDFC BANK LTD.</strong></td>
                        <td class="col-md-2"><strong>50200076730552</strong></td>
                        <td class="col-md-2"><strong>HDFC0000901</strong></td>
                        </tr>
                        <tr>
                            <td colspan="5"><strong>BUYER CONFIRMATION NOTE:<br><hr>
                                WE HEREBY ACCEPT YOUR PROFORMA INVOICE AND CONFIRM THE ORDER TO START PRODUCTION FOR THE SAME
                            </strong>
                            </td>                            
                        </tr>
                        
                    </table>
                </td>
                <td colspan="4" align="center" valign="middle">MODE OF SHIPMENT: PART LOAD BASIS.<br>ESTIMATED DELIVERY TIME: 5-7 DAYS<br>
                    (After realisation of the Advance Payment)
                </td>
            </tr>

            <tr>
                <td colspan="8"></td>
                <td colspan="4" align="center"><strong>E&amp;OE.</strong></td>
            </tr>
            <tr>
                <td colspan="8" align="center"><strong>For, {{$proforma->business_name }}</strong></td>
                <td colspan="4" align="center"><strong>For, SWEETDISP PRIVATE LIMITED</strong></td>
            </tr>
            <tr>
                <td colspan="8" style="height:50px !important;" valign="bottom" align="center"><strong>AUTHORISED SIGNATORY</strong></td>
                <td colspan="4" valign="bottom" align="center"><strong>AUTHORISED SIGNATORY</strong></td>
            </tr>
            <tr>
                <td colspan="12">Order Acknowledgement with Signature &amp; Stamp of the Buyer</td>
            </tr>
        </tbody>
    </table>
     
</body>

</html>