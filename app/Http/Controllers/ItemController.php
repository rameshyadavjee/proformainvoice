<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Update the user in the database
    public function searchitem(Request $request)
    {
        $query = Item::query();
    
        // Search by name or email
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nav_id', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%')
                  ->orWhere('item_name', 'like', '%' . $request->search . '%');            
            });
        }
    
        // Sort by column if specified
        if ($request->has('sort_by') && $request->has('order')) {
            $query->orderBy($request->sort_by, $request->order);
        }
    
        // Paginate with the search and sort parameters appended to the links
        $items = $query->paginate(10)->appends([
            'search' => $request->search,
            'sort_by' => $request->sort_by,
            'order' => $request->order,
        ]);
    
        //$items = Item::where('status','Active')->paginate(500);; // Pagination
        return view('items.index', compact('items'));

    }

    // Display a listing of the items
    public function index()
    {
        $items = Item::where('status','Active')->paginate(500);; // Pagination
        return view('items.index', compact('items'));
    }

    // Show the form for creating a new item
    public function create()
    {
        return view('items.create');
    }

    // Store a newly created item in storage
    public function store(Request $request)
    {
        $request->validate([
            'nav_id' => 'required|max:15',
            'sku' => 'nullable|string|max:15',
            'item_number' => 'nullable|string|max:25',
            'item_name' => 'required|string|max:150',
            'dimension' => 'nullable|string|max:50',
            'case_pack' => 'nullable|integer',
            'dealer_rate' => 'required|numeric',
            'trader_rate' => 'required|numeric',
            'msp_rate' => 'required|numeric',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    // Display the specified item
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));
    }

    // Show the form for editing the specified item
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    // Update the specified item in storage
    public function update(Request $request, $id)
    {       
       
        $request->validate([
            'nav_id' => 'required|max:15',
            'sku' => 'nullable|string|max:15',
            'item_number' => 'nullable|string|max:25',
            'item_name' => 'required|string|max:150',
            'dimension' => 'nullable|string|max:50',
            'case_pack' => 'nullable|integer',
            'dealer_rate' => 'required|numeric',
            'trader_rate' => 'required|numeric',
            'msp_rate' => 'required|numeric',
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    // Remove the specified item from storage
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
