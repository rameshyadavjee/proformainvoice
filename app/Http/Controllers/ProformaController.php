<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proforma;
use App\Models\Client;
use App\Models\Item;
use App\Models\InvoiceItemList;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ProformaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    // Update the user in the database
    public function searchproforma(Request $request)
    {
        $query = Proforma::query();

        // Search by name or email
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('invoice_id', 'like', '%' . $request->search . '%')
                    ->orWhere('business_name', 'like', '%' . $request->search . '%')
                    ->orWhere('address', 'like', '%' . $request->search . '%')
                    ->orWhere('contact_name', 'like', '%' . $request->search . '%')
                    ->orWhere('contact_number', 'like', '%' . $request->search . '%')
                    ->orWhere('gst_number', 'like', '%' . $request->search . '%');
            });
        }

        // Sort by column if specified
        if ($request->has('sort_by') && $request->has('order')) {
            $query->orderBy($request->sort_by, $request->order);
        }

        // Paginate with the search and sort parameters appended to the links
        $proformas = $query->paginate(10)->appends([
            'search' => $request->search,
            'sort_by' => $request->sort_by,
            'order' => $request->order,
        ]);

        //$items = Item::where('status','Active')->paginate(500);; // Pagination
        return view('proforma.index', compact('proformas'));
    }


    public function download($id)
    {
        $proforma = Proforma::findOrFail($id);
        $itemlist = InvoiceItemList::where('prinv_id', $id)->get();

        // Load the view for the PDF
        $pdf = Pdf::loadView('proforma.download', compact('proforma', 'itemlist'));

        // Download the PDF with a specific name
        return $pdf->download('proforma-invoice-' . $proforma->invoice_id . '.pdf');
    }

    
    public function getItemData(Request $request)
    {
        $businessId = $request->business_id;
        $clinetType = Client::where('id', $businessId)->first();
        $clinetType->client_type;

        $item = Item::where('nav_id', $request->id)->first();
        if ($clinetType->client_type == 'MSP') {
            if ($item) {
                return response()->json([
                    'navid_add' => $item->nav_id,
                    'sku_add' => $item->sku,
                    'itemnumber_add' => $item->item_number,
                    'itemname_add' => $item->item_name,
                    'dimension_add' => $item->dimension,
                    'casepack_add' => $item->case_pack,
                    'price_add' => $item->msp_rate,
                    'itemgst_add' => $item->item_gst,
                ]);
            }
        } elseif ($clinetType->client_type == 'Dealer') {
            if ($item) {
                return response()->json([
                    'navid_add' => $item->nav_id,
                    'sku_add' => $item->sku,
                    'itemnumber_add' => $item->item_number,
                    'itemname_add' => $item->item_name,
                    'dimension_add' => $item->dimension,
                    'casepack_add' => $item->case_pack,
                    'itemgst_add' => $item->item_gst,
                ]);
            }
        } elseif ($clinetType->client_type == 'Trader') {
            if ($item) {
                return response()->json([
                    'navid_add' => $item->nav_id,
                    'sku_add' => $item->sku,
                    'itemnumber_add' => $item->item_number,
                    'itemname_add' => $item->item_name,
                    'dimension_add' => $item->dimension,
                    'casepack_add' => $item->case_pack,
                    'itemgst_add' => $item->item_gst,
                ]);
            }
        }

        return response()->json(null);
    }

    public function getClientData(Request $request)
    {
        $client = Client::find($request->id);
        if ($client) {
            return response()->json([
                'client_id' => $client->id,
                'business_name' => $client->business_name,
                'address' => $client->address,
                'item_name' => $client->address,
                'payment_terms' => $client->payment_terms,
                'contact_name' => $client->contact_name,
                'contact_number' => $client->contact_number,
                'gst_number' => $client->gst_number,
            ]);
        }

        return response()->json(null);
    }

    public function index()
    {
        $userId = auth()->id();
        $proformas = Proforma::orderby('id', 'desc')->paginate(100); // Pagination
        return view('proforma.index', compact('proformas'));
    }

    public function create()
    {
        return view('proforma.create');
    }

    // Store a newly created item in storage
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|max:15',
            'business_name' => 'required|string|max:50',
            'address' => 'required|string|max:250',
            'ship_to' => 'required|string|max:250',
            'other_references' => 'nullable|string|max:250',
            'contact_name' => 'required|string|max:25',
            'contact_number' => 'required|string|max:15',
            'gst_number' => 'required|string|max:20',
            'payment_terms' => 'required|string|max:250',            
            'scheme' => 'required|numeric',
            'scheme_amount' => 'required|numeric',
            'total_case_order' => 'required|numeric',
            'total_qty_pcs' => 'required|numeric',
            'amount' => 'required|numeric',            
            'freight_charges' => 'nullable',            
            'grand_amount' => 'required|numeric',
        ]);

        // Insert data field by field
        $proforma = new Proforma();
        $proforma->created_by = Auth::user()->name;
        $proforma->user_id = Auth::user()->id;
        $proforma->client_id = $request->input('client_id');
        $proforma->business_name = $request->input('business_name');
        $proforma->address = $request->input('address');
        $proforma->ship_to = $request->input('ship_to');
        $proforma->other_references = $request->input('other_references');
        $proforma->contact_name = $request->input('contact_name');
        $proforma->contact_number = $request->input('contact_number');
        $proforma->gst_number = $request->input('gst_number');
        $proforma->payment_terms = $request->input('payment_terms');
        $proforma->total_box = $request->input('total_case_order');
        $proforma->total_qty = $request->input('total_qty_pcs');        
        $proforma->sub_total = $request->input('sub_total');
        $proforma->scheme = $request->input('scheme');
        $proforma->scheme_amount = $request->input('scheme_amount');               
        $proforma->amount = $request->input('amount');
        $proforma->freight_charges = $request->input('freight_charges');
        $proforma->fdc_gstamount = $request->input('fdc_gstamount');                
        $proforma->total_amount = $request->input('grand_amount');
        $proforma->save();
        $proforma_id = $proforma->id;

        // Fetch the second-to-last record based on the order of insertion (assuming 'id' is the primary key)
        $secondLastProforma = Proforma::orderBy('id', 'desc')->skip(1)->first();

        // Check if the second last proforma exists to avoid null reference errors
        if ($secondLastProforma) {
            // Get the invoice_id from the second-to-last record and increment it by 1
            $newInvoiceId = $secondLastProforma->invoice_id + 1;

            // Update the invoice_id of the last inserted record
            $lastProforma = Proforma::find($proforma_id); // Find the last inserted record
            $lastProforma->invoice_id = $newInvoiceId;
            $lastProforma->save(); // Save the updated record
        }

        // Insert each item into the InvoiceItemList table
        $totalitem = count($request->nav_id);

        for ($i = 0; $i < $totalitem; $i++) {
            if (isset($request->nav_id[$i])) { // Ensure the index exists
                $invoiceItem = new InvoiceItemList();
                $invoiceItem->prinv_id = $proforma_id; // Use the inserted Proforma ID
                $invoiceItem->nav_id = $request->nav_id[$i];
                $invoiceItem->sku = $request->sku[$i];
                $invoiceItem->item_name = $request->item_name[$i];
                $invoiceItem->item_number = $request->item_number[$i];
                $invoiceItem->dimension = $request->dimension[$i];
                $invoiceItem->case_pack = $request->case_pack[$i];
                $invoiceItem->case_order = $request->case_order[$i];
                $invoiceItem->qty_pcs = $request->qty_pcs[$i];
                $invoiceItem->rate_case = $request->rate_case[$i];
                $invoiceItem->basic_price = $request->basic_price[$i];
                $invoiceItem->item_gst = $request->item_gst[$i];
                $invoiceItem->itemgstamount = $request->itemgstamount[$i];
                $invoiceItem->amount = $request->total_amount[$i];
                $invoiceItem->save();
            }
        }

        return redirect()->route('proforma.index')->with('success', 'Proforma created successfully.');
    }

    public function show(string $id)
    {
        // Find the proforma by its ID
        $proforma = Proforma::findOrFail($id);

        // Find the related invoice items
        $itemlist = InvoiceItemList::where('prinv_id', $id)->get();

        // Pass both proforma and itemlist data to the view
        return view('proforma.show', compact('proforma', 'itemlist'));
    }

    // Show the form for editing the specified item
    public function edit($id)
    {
        $item = Proforma::findOrFail($id);
        return view('proforma.edit', compact('item'));
    }

    // Update the specified item in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'remarks' => 'required|string',
            'status' => 'required|string',
        ]);

        $item = Proforma::findOrFail($id);
        // Update only the 'remarks' and 'status' fields
        $item->update($request->only(['remarks', 'status']));

        return redirect()->route('proforma.index')->with('success', 'Proforma updated successfully.');
    }
}
