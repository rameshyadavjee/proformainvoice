@extends('layouts.app')
@section('css')
<link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet"></link>
<script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
<style>
    .form-control {
        font-size: 0.7rem !important;
    }
    label {
        font-size: 0.7rem !important;
    }
    table {
        font-size: 0.7rem !important;
    }
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
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label><strong> Name</strong></label>
                                <input type="hidden" name="client_id" id="client_id" value="{{ old('client_id', $item->client_id ?? '') }}" class="form-control">
                                <input type="hidden" name="business_name" id="business_name" value="{{ old('business_name', $item->business_name ?? '') }}" class="form-control">
                                <select name="business" id="business" required>
                                    <option>Select Client Name</option>
                                    @foreach (get_allclients() as $key => $data)
                                    <option value="{{ $data->id }}">{{ $data->business_name }}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            <div class="form-group col-md-3">
                                <label><strong>Address</strong></label>
                                <textarea name="address" id="address" class="form-control"></textarea>
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label><strong> Shipp To Address</strong></label>
                                <textarea name="ship_to" id="ship_to" class="form-control"></textarea>
                                @error('ship_to')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label><strong>Terms of Payment</strong></label>
                                <textarea name="payment_terms" id="payment_terms" class="form-control"></textarea>
                                @error('payment_terms')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label><strong>Contact Name</strong></label>
                                <input type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', $item->contact_name ?? '') }}" class="form-control">
                                @error('contact_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label><strong>Contact Number</strong></label>
                                <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $item->contact_number ?? '') }}" class="form-control">
                                @error('contact_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label><strong>GST Number</strong></label>
                                <input type="text" name="gst_number" id="gst_number" value="{{ old('gst_number', $item->gst_number ?? '') }}" class="form-control" required>
                                @error('gst_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label><strong>Other References</strong></label>
                                <textarea name="other_references" class="form-control"></textarea>
                                @error('other_references')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div>
                        <hr class="mt-2">
                        <div class="row mt-2">
                            <div class="form-group col-md-2">                                
                                <label>Nav ID</label>                                
                                <select name="navid_add" id="navid_add" disabled>
                                    <option>Select NAV Id</option>
                                    @foreach (get_allitems() as $key => $data)
                                    <option value="{{ $data->nav_id }}">{{ $data->nav_id }}</option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="form-group col-md-1">
                                <label>SKU</label>                                
                                <input type="text" name="sku_add" id="sku_add" value="{{ old('sku_add', $item->sku_add ?? '') }}" class="form-control text-center" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Item Name</label>
                                <input type="text" name="itemname_add" id="itemname_add" value="{{ old('itemname_add', $item->itemname_add ?? '') }}" class="form-control text-center" readonly>
                            </div>
                            <div class="form-group col-md-1">
                                <label>Number</label>
                                <input type="text" name="itemnumber_add" id="itemnumber_add" value="{{ old('itemnumber_add', $item->itemnumber_add ?? '') }}" class="form-control text-center" readonly>                                
                            </div>                            
                            <div class="form-group col-md-1">
                                <label>Dimension</label><br>
                                <input type="text" name="dimension_add" id="dimension_add" value="{{ old('dimension_add', $item->dimension_add ?? '') }}" class="form-control text-center" readonly>
                            </div>
                            <div class="form-group col-md-1">
                                <label>Case Pack</label>
                                <input type="text" name="casepack_add" id="casepack_add" value="{{ old('casepack_add', $item->casepack_add ?? '') }}" class="form-control text-center" readonly>                                
                            </div>                            
                            <div class="form-group col-md-1">
                                <label>Price</label>
                                <input type="text" name="price_add" id="price_add" value="{{ old('price_add', $item->price_add ?? '') }}" class="form-control text-center" readonly>
                            </div>
                            <div class="form-group col-md-1">
                                <label>Order Case</label>
                                <input type="text" name="ordercase_add" id="ordercase_add" value="{{ old('ordercase_add', $item->ordercase_add ?? '') }}" class="form-control text-center">                                
                            </div>                            
                            <div class="form-group col-md-1">
                                <label>Total</label>
                                <input type="text" name="amount_add" id="amount_add" size="9" class="text-center" style="font-size: 0.7rem !important;  border:1px solid;border-radius:5px; height:32px" readonly>                            
                            </div>
                            <div class="form-group col-md-1 mt-3">
                                <button type="button" class="btn btn-success mt-1" id="add-item-btn">+</button>
                            </div>
                            <table width="100%" class="mt-2 table table-bordered">
                                <tbody id="item-table-body">
                                    <td align="center" valign="middle"><strong>NAV Id</strong></td>
                                    <td align="center" valign="middle"><strong>SKU</strong></td>
                                    <td align="center" valign="middle"><strong>Item Name</strong></td>
                                    <td align="center" valign="middle"><strong>Number</strong></td>                                    
                                    <td align="center" valign="middle"><strong>Dimension</strong></td>
                                    <td align="center" valign="middle"><strong>Case <br> Pack</strong></td>
                                    <td align="center" valign="middle"><strong>Order <br> (Case)</strong></td>
                                    <td align="center" valign="middle"><strong>Total Qty <br> (In PCS)</strong></td>
                                    <td align="center" valign="middle"><strong>Rate/Case <br> In INR</strong></td>
                                    <td align="center" valign="middle"><strong>Total Amount <br>In INR</strong></td>
                                </tbody>                                 
                                <tr>                                    
                                    <td colspan="9" class="text-right" valign="middle"><strong>Sub Amount</strong></td>
                                    <td valign="middle"><input type="text" name="sub_total" id="sub_total" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px" readonly></td>                                    
                                </tr>
                                <tr>                                    
                                    <td colspan="9" class="text-right" valign="middle"><strong>+ Freight Charges</strong></td>
                                    <td valign="middle"><input type="text" name="freight_charges" id="freight_charges" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px" required></td>
                                </tr>                                
                                <tr>                                    
                                    <td colspan="9" class="text-right" valign="middle"><strong>Less 
                                    <input type="text" name="scheme" id="scheme" value="0" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px">
                                    %
                                </td>
                                    <td valign="middle"><input type="text" name="scheme_amount" id="scheme_amount" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px" readonly></td>                                 
                                </tr>
                                <tr>                                    
                                    <td colspan="9" class="text-right" valign="middle"><strong>Sub Amount - Scheme</strong></td>
                                    <td valign="middle"><input type="text" name="subminusscheme" id="subminusscheme" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px" readonly></td>                                    
                                </tr>
                                <tr>                                    
                                    <td colspan="9" class="text-right" valign="middle"><strong>Total Amount</strong></td>
                                    <td valign="middle"><input type="text" name="amount" id="amount" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px" readonly></td>                                    
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right"><strong>Total Box/Qty</strong></td>
                                    <td class="text-center"><strong><input type="text" name="total_case_order" id="total_case_order" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px" readonly></strong></td>
                                    <td class="text-center"><strong><input type="text" name="total_qty_pcs" id="total_qty_pcs" value="" size="15" class="text-center" style="font-size: 0.7rem !important;  border:1px solid;border-radius:5px; height:32px" readonly></strong></td>
                                    <td class="text-right"><strong>+ GST 
                                        <select name="gst" class="text-center p-1" required>                                            
                                        <option value="5">5 %</option>
                                        <option value="12">12 %</option>
                                        <option value="18" selected>18 %</option>
                                    </select></strong></td>
                                    <td><input type="text" name="gst_amount" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px"></td>                                    
                                </tr>
                                <tr><td colspan="8">&nbsp;</td>                                    
                                    <td  class="text-center"><strong>Total Amount in INR <br> (Including GST)</strong></td>
                                    <td><input type="text" name="grand_amount" value="" class="text-center" size="15" style="border:1px solid;border-radius:5px; height:32px" ></td>                                    
                                </tr>
                            </table>                            
                        </div>
                        <div class="col-md-11 mt-4 d-md-flex justify-content-md-end ">
                                <button type="submit" class="btn btn-success btn-lg">{{ 'Save' }}</button>
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
    <!-- SlimSelect -->
    <script>
        new SlimSelect({ select: '#business'  })         
        new SlimSelect({ select: '#navid_add' })
    </script>

    <!-- Get Amount total -->
    <script>
        // Get references to the input fields
        const casepackInput = document.getElementById('casepack_add');
        const priceInput = document.getElementById('price_add');
        const orderCaseInput = document.getElementById('ordercase_add');
        const totalAmountInput = document.getElementById('amount_add');

        // Add event listener for when the order case value changes
        orderCaseInput.addEventListener('input', function() {
            // Get the values of price and order case        
            let casepack = parseFloat(casepackInput.value) || 0; // Default to 0 if empty or invalid
            let price = parseFloat(priceInput.value) || 0; // Default to 0 if empty or invalid
            let orderCase = parseFloat(orderCaseInput.value) || 0; // Default to 0 if empty or invalid

            // Calculate total amount
            let totalAmount = (casepack * price * orderCase);

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
                    url: '{{ route('get.client.data') }}', // Define your route to fetch data
                    type: 'GET',
                    data: { id: clientId },
                    success: function(response) {
                        if(response) {
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
                    url: '{{ route('get.item.data') }}', // Define your route to fetch data
                    type: 'GET',
                    data: { 
                        id: itemId,
                        business_id: businessId  // Pass business ID as well
                    },
                    success: function(response) {
                        if(response) {
                            // Update the address and shipping address
                            $('#sku_add').val(response.sku_add);                        
                            $('#itemname_add').val(response.itemname_add);
                            $('#itemnumber_add').val(response.itemnumber_add);
                            $('#dimension_add').val(response.dimension_add);
                            $('#casepack_add').val(response.casepack_add);
                            $('#price_add').val(response.price_add);                        
                        }
                    }
                });
            } else {
                // Clear fields if no client is selected
                $('#sku_add').val('');
                $('#itemname_add').val('');
                $('#number_add').val('');
                $('#dimension_add').val('');
                $('#casepack_add').val('');
                $('#price_add').val('');  
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
                
                // Update the net amount field
                $('#sub_total').val(subTotal.toFixed(2)); // Set net amount value with 2 decimal places
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
                        <td>
                            <input type="text" name="total_amount[]" value="${totalAmount}" class="text-center" size="12" style="border:1px solid;border-radius:5px; height:32px" readonly>                            
                            <span class="badge bg-danger remove-item-btn">-</span>
                        </td>
                    </tr>`;
                // Append the new row to the table
                $('#item-table-body').append(newRow);
                // Optionally clear the input fields
                $('#sku_add, #navid_add, #itemname_add, #itemnumber_add, #dimension_add, #casepack_add, #ordercase_add, #price_add, #amount_add').val('');
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
                
                // Recalculate basic amount, scheme, and GST after row removal
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
            const freightChargesInput = document.getElementById('freight_charges');            
            const schemeSelect = document.getElementById('scheme');
            const schemeAmountInput = document.getElementById('scheme_amount');            
            const subminusschemeInput = document.getElementById('subminusscheme');
            const amountInput = document.getElementById('amount'); // Corrected: Referencing amount input element
            const gstSelect = document.querySelector('select[name="gst"]');
            const gstAmountInput = document.querySelector('input[name="gst_amount"]');
            const grandTotalInput = document.querySelector('input[name="grand_amount"]');        

            // Function to calculate and update scheme and GST amounts
            function calculateAmounts() {
                const subTotal = parseFloat(subTotalInput.value) || 0;                                
                const scheme = parseFloat(schemeSelect.value) || 0;                                
                const schemeAmount = subTotal * (scheme / 100);
                schemeAmountInput.value = schemeAmount.toFixed(2); // Update scheme amount input
                
                const freightCharges = parseFloat(freightChargesInput.value) || 0;  
                
                const subminusscheme = subTotal - schemeAmount;
                subminusschemeInput.value = subminusscheme.toFixed(2); // Update sub minus scheme input
                
                // Correct formula for amount
                const amount = (subTotal - schemeAmount) + freightCharges;
                amountInput.value = amount.toFixed(2); // Update the amount field
                
                const gstPercentage = parseFloat(gstSelect.value) || 0;        

                // Calculate GST amount                                
                const gstAmount = amount * (gstPercentage / 100);                                
                gstAmountInput.value = gstAmount.toFixed(2); // Update the GST amount field

                // Calculate grand total (amount + GST)
                const grandTotal = amount + gstAmount;
                grandTotalInput.value = grandTotal.toFixed(2); // Update the grand total field
            }

            // Event listeners for changes
            subTotalInput.addEventListener('input', calculateAmounts);            
            freightChargesInput.addEventListener('input', calculateAmounts);
            schemeSelect.addEventListener('input', calculateAmounts);
            gstSelect.addEventListener('change', calculateAmounts);

            calculateAmounts(); // Initial call to set the values on load
        });
    </script>


@endsection