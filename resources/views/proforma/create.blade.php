@extends('layouts.app')
@section('css')
<link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet">
</link>
<script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
<style>
    .form-control { font-size: 0.7rem !important;}
    label { font-size: 0.7rem !important;}
    table { font-size: 0.7rem !important;}
    .ss-content .ss-list .ss-option { font-size: 0.7rem !important;}
    .ss-main .ss-values .ss-single { font-size: 0.7rem !important; font-weight: 400;color: var(--bs-body-color);}
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add New Proforma</div>
                <div class="card-body">
                    <form action="{{ route('proforma.store') }}" name="proforma" method="POST">
                        @csrf
                        <div class="row" style="background-color:lightgray ">
                            <div class="form-group col-md-3 g-2">
                                <label><strong> Name</strong></label>
                                <input type="hidden" name="client_id" id="client_id" value="{{ old('client_id', $item->client_id ?? '') }}" class="form-control">
                                <input type="hidden" name="business_name" id="business_name" value="{{ old('business_name', $item->business_name ?? '') }}" class="form-control">
                                <select name="business" id="business" required  style="font-size:smaller; font-weight: 400;color: var(--bs-body-color);"> 
                                    <option>Select Client Name</option>
                                    @foreach (get_allclients() as $key => $data)
                                    <option value="{{ $data->id }}">{{ $data->business_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 g-2">
                                <label><strong>Address</strong></label>
                                <textarea name="address" id="address" class="form-control"></textarea>
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 g-2">
                                <label><strong> Shipp To Address</strong></label>
                                <textarea name="ship_to" id="ship_to" class="form-control"></textarea>
                                @error('ship_to')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3  g-2">
                                <label><strong>Terms of Payment</strong></label>
                                <textarea name="payment_terms" id="payment_terms" class="form-control" ></textarea>
                                @error('payment_terms')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3  g-2">
                                <label><strong>Contact Name</strong></label>
                                <input type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', $item->contact_name ?? '') }}" class="form-control">
                                @error('contact_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3  g-2">
                                <label><strong>Contact Number</strong></label>
                                <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $item->contact_number ?? '') }}" class="form-control">
                                @error('contact_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3  g-2">
                                <label><strong>GST Number</strong></label>
                                <input type="text" name="gst_number" id="gst_number" value="{{ old('gst_number', $item->gst_number ?? '') }}" class="form-control" required>
                                @error('gst_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3  g-2 mb-2">
                                <label><strong>Other References</strong></label>
                                <textarea name="other_references" class="form-control" ></textarea>
                                @error('other_references')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <hr class="mt-2">
                        <div class="row mt-2" style="background-color: lightcyan;">
                            <div class="form-group col-md-2">
                                <label><strong>Nav ID</strong></label>
                                <select name="navid_add" id="navid_add" disabled>
                                    <option>Select NAV ID</option>
                                    @foreach (get_allitems() as $key => $data)
                                    <option value="{{ $data->nav_id }}">{{ $data->nav_id }} - {{ $data->sku }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label><strong>SKU</strong></label>
                                <input type="text" name="sku_add" id="sku_add" value="{{ old('sku_add', $item->sku_add ?? '') }}" class="form-control text-center" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label><strong>Item Name</strong></label>
                                <input type="text" name="itemname_add" id="itemname_add" value="{{ old('itemname_add', $item->itemname_add ?? '') }}" class="form-control text-center " readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label><strong>Number</strong></label>
                                <input type="text" name="itemnumber_add" id="itemnumber_add" value="{{ old('itemnumber_add', $item->itemnumber_add ?? '') }}" class="form-control text-center" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label><strong>Dimension</strong></label><br>
                                <input type="text" name="dimension_add" id="dimension_add" value="{{ old('dimension_add', $item->dimension_add ?? '') }}" class="form-control text-center" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label><strong>Case Pack</strong></label>
                                <input type="text" name="casepack_add" id="casepack_add" value="{{ old('casepack_add', $item->casepack_add ?? '') }}" class="form-control text-center" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label><strong>Price</strong></label>
                                <input type="text" name="price_add" id="price_add" value="{{ old('price_add', $item->price_add ?? '') }}" class="form-control text-center" readonly>
                            </div>                            
                            <div class="form-group col-md-2">
                                <label><strong>Order Case</strong></label>
                                <input type="text" name="ordercase_add" id="ordercase_add" value="{{ old('ordercase_add', $item->ordercase_add ?? '') }}" class="form-control text-center" onkeypress="allowNumbersOnly(event)" maxlength="10">
                            </div>
                            <div class="form-group col-md-2">
                                <label><strong>Basic Price</strong></label>
                                <input type="text" name="basicprice_add" id="basicprice_add" value="{{ old('basicprice_add', $item->basicprice_add ?? '') }}" class="form-control text-center" readonly>
                            </div>                                                        
                            <div class="form-group col-md-1">
                                <label><strong>Item GST</strong></label>
                                <input type="text" name="itemgst_add" id="itemgst_add" value="{{ old('itemgst_add', $item->itemgst_add ?? '') }}" class="form-control text-center" readonly>
                            </div>
                            <div class="form-group col-md-1">
                                <label><strong>GST Amount</strong></label>
                                <input type="text" name="itemgstamount_add" id="itemgstamount_add" value="{{ old('itemgstamount_add', $item->itemgstamount_add ?? '') }}" class="form-control text-center" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label><strong>Total</strong></label>
                                <input type="text" name="amount_add" id="amount_add" class="form-control text-center" readonly>
                            </div>
                            <div class="form-group col-md-2 mt-3 mb-2">
                                <button type="button" class="btn btn-success mt-1" id="add-item-btn">+ Add More</button>
                            </div>
                            </div>
                        <div class="row mt-2" style="background-color: lightgrey">
                            <table width="100%" class="mt-2 table table-bordered" >
                                <tbody id="item-table-body">
                                    <td align="center" valign="middle"><strong>NAV ID</strong></td>
                                    <td align="center" valign="middle"><strong>SKU</strong></td>
                                    <td align="center" valign="middle"><strong>Item Name</strong></td>
                                    <td align="center" valign="middle"><strong>Number</strong></td>
                                    <td align="center" valign="middle"><strong>Dimension</strong></td>
                                    <td align="center" valign="middle"><strong>Case <br> Pack</strong></td>
                                    <td align="center" valign="middle"><strong>Order <br> (Case)</strong></td>
                                    <td align="center" valign="middle"><strong>Total Qty <br> (In PCS)</strong></td>                                    
                                    <td align="center" valign="middle"><strong>Rate/Case <br> In INR</strong></td>  
                                    <td align="center" valign="middle"><strong>Basic Amount</strong></td>                                    
                                    <td align="center" valign="middle"><strong>Item <br> (GST)</strong></td>
                                    <td align="center" valign="middle"><strong>Item <br> (GST Amount)</strong></td>
                                    <td align="center" valign="middle"><strong>Amount <br>In INR</strong></td>
                                </tbody>
                                <tr>
                                    <td colspan="12" class="text-right" valign="middle"><strong>Sub Amount</strong></td>
                                    <td align="right" valign="middle" align="right"><input type="text" name="sub_total" id="sub_total" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px" readonly></td>
                                </tr> 
                                <tr>
                                    <td align="right" colspan="12" align="right" class="text-right" valign="middle"><strong>Less
                                            <input type="text" name="scheme" id="scheme" value="0" size="15" class="text-center" style="border:1px solid;border-radius:5px; height:32px" onkeypress="allowNumbersOnly(event)" maxlength="2"> %
                                    </td>
                                    <td align="right" valign="middle"><input type="text" name="scheme_amount" id="scheme_amount" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px" readonly></td>
                                </tr>                                 
                                <tr>
                                    <td colspan="12" align="right" class="text-right" valign="middle"><strong>Total Amount</strong></td>
                                    <td align="right" valign="middle"><input type="text" name="amount" id="amount" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px" readonly></td>
                                </tr>
                                <tr>                                                                        
                                    <td colspan="12" align="right" valign="middle" class="text-right"><strong>Freight/Courier/Development Charges</strong> 
                                        <input type="text" name="freight_charges" id="freight_charges" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px" maxlength="7" onkeypress="allowNumbersOnly(event)" ><strong> + 18% </strong>
                                    <td align="right" valign="middle" class="text-right">
                                        <input type="text" name="fdc_gstamount" id="fdc_gstamount" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px" readonly>
                                    </td>
                                </tr>                       
                                <tr>
                                    <td valign="middle" colspan="6" class="text-right"><strong>Total Box/Qty</strong></td>
                                    <td class="text-center"><strong><input type="text" name="total_case_order" id="total_case_order" value="" class="text-center" size="10" style="border:1px solid;border-radius:5px; height:32px" readonly></strong></td>
                                    <td class="text-center"><strong><input type="text" name="total_qty_pcs" id="total_qty_pcs" value="" size="10" class="text-center" style="font-size: 0.7rem !important;  border:1px solid;border-radius:5px; height:32px" readonly></strong></td>                                                                        
                                    <td class="text-center" colspan="4"><strong>Total Amount in INR <br> (Including GST)</strong></td>
                                    <td align="right"><input type="text" name="grand_amount" id="grand_amount" value="" class="text-center" size="15" readonly style="border:1px solid;border-radius:5px; height:32px"></td>
                                </tr>
                            </table>
                        <div class="col-md-13 mb-3 d-md-flex justify-content-md-end g-1">
                            <button type="submit" class="btn btn-primary btn-lg px-5">{{ 'Save' }}</button>
                        </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    function allowNumbersOnly(event) {
        // Get the key code of the pressed key
        const charCode = event.which ? event.which : event.keyCode;
        
        // Check if the pressed key is a number (0-9) or a control key (backspace, arrow keys)
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            event.preventDefault(); // Stop the character from being inputted
        }
    }
</script>
<!-- SlimSelect -->
<script>
    new SlimSelect({
        select: '#business'
    })
    new SlimSelect({
        select: '#navid_add'
    })
</script>

<!-- Get Amount total -->
<script>
    // Get references to the input fields
    const casepackInput = document.getElementById('casepack_add');
    const priceInput = document.getElementById('price_add');
    const orderCaseInput = document.getElementById('ordercase_add');
    const totalAmountInput = document.getElementById('amount_add');
    const itemGstInput = document.getElementById('itemgst_add');
    const basicpriceInput = document.getElementById('basicprice_add');    
    const itemgstamountInput = document.getElementById('itemgstamount_add');    
    
    // Add event listener for when the order case value changes
    orderCaseInput.addEventListener('input', function() {
        // Get the values of price and order case        
        let casepack = parseFloat(casepackInput.value) || 0; // Default to 0 if empty or invalid
        let price = parseFloat(priceInput.value) || 0; // Default to 0 if empty or invalid
        let orderCase = parseFloat(orderCaseInput.value) || 0; // Default to 0 if empty or invalid
        let itemGst = parseFloat(itemGstInput.value) || 0; // Default to 0 if empty or invalid
        // Calculate total amount
        let totalAmount1 = (casepack * price * orderCase);
        let totalAmount2 = ((totalAmount1 * itemGst) / 100);
        let totalAmount =   totalAmount1 + totalAmount2; 
        basicpriceInput.value = totalAmount1;
        itemgstamountInput.value = totalAmount2;
        // Set the total amount in the amount_add input field
        totalAmountInput.value = totalAmount.toFixed(2); // Format to 2 decimal places
    });

    // Get references to the dropdowns
    const businessSelect = document.getElementById('business');
    const navidSelect = document.getElementById('navid_add');

    // Add event listener for when the business dropdown changes
    businessSelect.addEventListener('change', function() {
        if (this.value) {
            // Enable the SKU dropdown if a business is selected
            navidSelect.disabled = false;
        } else {
            // Disable the SKU dropdown if no business is selected
            navidSelect.disabled = true;
        }
    });
</script>
<script>
    $('#business').on('change', function() {
        var clientId = $(this).val();

        if (clientId) {
            $.ajax({
                url: '{{ route('get.client.data')}}',
                type: 'GET',
                data: {
                    id: clientId
                },
                success: function(response) {
                    if (response) {
                        // Update the address and shipping address
                        $('#client_id').val(response.client_id);
                        $('#business_name').val(response.business_name);
                        $('#address').val(response.address);
                        $('#ship_to').val(response.address);
                        $('#payment_terms').val(response.payment_terms);
                        $('#contact_name').val(response.contact_name);
                        $('#contact_number').val(response.contact_number);
                        $('#gst_number').val(response.gst_number);
                    }
                }
            });
        } else {
            // Clear fields if no client is selected
            $('#client_id').val('');
            $('#business_name').val('');
            $('#address').val('');
            $('#ship_to').val('');
            $('#payment_terms').val('');
            $('#contact_name').val('');
            $('#contact_number').val('');
            $('#gst_number').val('');
        }
    });

    $('#navid_add').on('change', function() {
        var itemId = $(this).val();
        var businessId = $('#business').val();

        if (itemId && businessId) {
            $.ajax({
                url: '{{ route('get.item.data')}}', // Define your route to fetch data
                type: 'GET',
                data: {
                    id: itemId,
                    business_id: businessId // Pass business ID as well
                },
                success: function(response) {
                    if (response) {
                        // Update the address and shipping address
                        $('#sku_add').val(response.sku_add);
                        $('#itemname_add').val(response.itemname_add);
                        $('#itemnumber_add').val(response.itemnumber_add);
                        $('#dimension_add').val(response.dimension_add);
                        $('#casepack_add').val(response.casepack_add);
                        $('#price_add').val(response.price_add);
                        $('#itemgst_add').val(response.itemgst_add);
                        $('#ordercase_add').focus();
                    }
                }
            });
        } else {
            // Clear fields if no client is selected
            $('#sku_add').val('');
            $('#itemname_add').val('');
            $('#itemnumber_add').val('');
            $('#dimension_add').val('');
            $('#casepack_add').val('');
            $('#price_add').val('');
            $('#itemgst_add').val('');   
                   
        }
    });
</script>
<!-- Function to calculate and update the net amount -->
<script>
    $(document).ready(function() {

        // Function to calculate and update the net amount
        function calculateNetAmount() {
            var subTotal = 0;
            // Loop through each amount_add field and sum up the values
            $('input[name="total_amount[]"]').each(function() {
                var amount = parseFloat($(this).val()) || 0; // Convert value to float or default to 0 if empty
                subTotal += amount;
            });             
            $('#sub_total').val(subTotal.toFixed(2)); // Set net amount value with 2 decimal places
            $('#amount').val(subTotal.toFixed(2));
            $('#grand_amount').val(subTotal.toFixed(2));
        }
        // Function to calculate and update the total case order
        function calculateTotalCaseOrder() {
            var totalCaseOrder = 0;
            // Loop through each case_order field and sum up the values
            $('input[name="case_order[]"]').each(function() {
                var order = parseFloat($(this).val()) || 0; // Convert value to float or default to 0 if empty
                totalCaseOrder += order;
            });
            // Update the total case order field
            $('#total_case_order').val(totalCaseOrder); // Set total case order value
        }

        // Function to calculate and update the total quantity in pieces (qty_pcs)
        function calculateTotalQtyPcs() {
            var totalQtyPcs = 0;
            // Loop through each qty_pcs field and sum up the values
            $('input[name="qty_pcs[]"]').each(function() {
                var qty = parseFloat($(this).val()) || 0; // Convert value to float or default to 0 if empty
                totalQtyPcs += qty;
            });
            // Update the total qty_pcs field
            $('#total_qty_pcs').val(totalQtyPcs); // Set total qty_pcs value

        }


        $('#add-item-btn').click(function() {
            // Get values from the input fields
            var sku = $('#sku_add').val();
            var navId = $('#navid_add').val();
            var itemName = $('#itemname_add').val();
            var itemNumber = $('#itemnumber_add').val();
            var dimension = $('#dimension_add').val();
            var casePack = $('#casepack_add').val();
            var orderCase = $('#ordercase_add').val();            
            var qty_pcs = $('#casepack_add').val() * $('#ordercase_add').val();
            var price = $('#price_add').val();
            var item_gst = $('#itemgst_add').val();
            var basicprice = $('#basicprice_add').val();
            var itemgstamount = $('#itemgstamount_add').val();            
            var totalAmount = $('#amount_add').val();

            // Create a new row with the values and include a Remove button
            var newRow = `
                    <tr>
                        <td><input type="text" name="nav_id[]" value="${navId}" class="form-control text-center" readonly></td>
                        <td><input type="text" name="sku[]" value="${sku}" class="form-control text-center" readonly></td>
                        <td><input type="text" name="item_name[]" value="${itemName}" class="form-control text-center" readonly></td>
                        <td><input type="text" name="item_number[]" value="${itemNumber}" class="form-control text-center" readonly></td>
                        <td><input type="text" name="dimension[]" value="${dimension}" class="form-control text-center" readonly></td>
                        <td><input type="text" name="case_pack[]" value="${casePack}" class="form-control text-center" readonly></td>
                        <td><input type="text" name="case_order[]" value="${orderCase}" class="form-control text-center" readonly></td>
                        <td><input type="text" name="qty_pcs[]" value="${qty_pcs}" class="form-control text-center" readonly></td>
                        <td><input type="text" name="rate_case[]" value="${price}" class="form-control text-center" readonly></td>
                        <td><input type="text" name="basic_price[]" value="${basicprice}" class="form-control text-center" readonly></td>
                        <td><input type="text" name="item_gst[]" value="${item_gst}" class="form-control text-center" readonly></td>
                        <td><input type="text" name="itemgstamount[]" value="${itemgstamount}" class="form-control text-center" readonly></td>
                        <td><input type="text" name="total_amount[]" value="${totalAmount}" class="text-center" size="12" style="border:1px solid;border-radius:5px; height:32px" readonly>
                        <span class="badge bg-danger remove-item-btn">-</span>
                        </td>
                    </tr>`;
            // Append the new row to the table
            $('#item-table-body').append(newRow);
            // Optionally clear the input fields
            $('#sku_add, #navid_add, #itemname_add, #itemnumber_add, #dimension_add, #casepack_add, #ordercase_add, #price_add, #amount_add, #itemgst_add,#basicprice_add,#itemgstamount_add').val('');
            // Recalculate the net amount

            calculateNetAmount();
            calculateTotalCaseOrder();
            calculateTotalQtyPcs();

        });

        // Add event delegation for the Remove button to remove the row
        $('#item-table-body').on('click', '.remove-item-btn', function() {
            $(this).closest('tr').remove(); // Remove the row  

            // Recalculate the net amount, case order, and qty pcs after row removal                
            calculateNetAmount();
            calculateTotalCaseOrder();
            calculateTotalQtyPcs();  
            calculateAmounts();
        });

        // Optionally, you can also update the net amount when the total amount fields are edited
        $('#item-table-body').on('input', 'input[name="total_amount[]"]', function() {
            calculateNetAmount();
        });

        // Optionally, you can also update the total case order when the case order fields are edited
        $('#item-table-body').on('input', 'input[name="case_order[]"]', function() {
            calculateTotalCaseOrder();
        });

        // Optionally, you can also update the total qty pcs when the qty pcs fields are edited
        $('#item-table-body').on('input', 'input[name="qty_pcs[]"]', function() {
            calculateTotalQtyPcs();
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the necessary elements
        const subTotalInput = document.getElementById('sub_total'); 
        const schemeSelect = document.getElementById('scheme');
        const schemeAmountInput = document.getElementById('scheme_amount');         
        const amountInput = document.getElementById('amount');
        const freightchargesInput = document.getElementById('freight_charges'); 
        const fdc_gstamountInput = document.getElementById('fdc_gstamount');
        const grandTotalInput = document.getElementById('grand_amount');
        
        // Function to calculate and update scheme  and freight amounts
        function calculateAmounts() {
            const subTotal = parseFloat(subTotalInput.value) || 0;
            const scheme = parseFloat(schemeSelect.value) || 0;
            const schemeAmount = ((subTotal * scheme) / 100);             
            schemeAmountInput.value = schemeAmount.toFixed(2);
            fdc_gstamountInput.value = parseFloat(fdc_gstamountInput.value) || 0;

            // Correct formula for amount
            const amount = (subTotal - schemeAmount);
            amountInput.value = amount.toFixed(2); // Update the amount field
                              
            const freightCharges = parseFloat(freightchargesInput.value) || 0;
            const gstOnFreight = ((freightCharges * 18) / 100) // 18% GST on freight charges
            fdc_gstamountInput.value = freightCharges + gstOnFreight;
            const totalFreight = freightCharges + gstOnFreight;

            // Calculate grand total (amount + GST)
            const grandTotal = (amount + totalFreight);
            grandTotalInput.value = grandTotal.toFixed(2); // Update the grand total field
        }

        // Event listeners for changes
        subTotalInput.addEventListener('input', calculateAmounts);       
        schemeSelect.addEventListener('input', calculateAmounts);
        freightchargesInput.addEventListener('input', calculateAmounts);   
        freightchargesInput.addEventListener('change', calculateAmounts); // Make sure to update on change
        calculateAmounts(); // Initial call to set the values on load
    });
</script>


@endsection