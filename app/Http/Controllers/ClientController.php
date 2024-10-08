<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;


class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    // Update the user in the database
    public function searchclient(Request $request)
    {
        $query = Client::query();
    
        // Search by name or email
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('business_name', 'like', '%' . $request->search . '%')
                  ->orWhere('contact_name', 'like', '%' . $request->search . '%')
                  ->orWhere('contact_number', 'like', '%' . $request->search . '%')
                  ->orWhere('address', 'like', '%' . $request->search . '%')
                  ->orWhere('client_type', 'like', '%' . $request->search . '%')
                  ->orWhere('gst_number', 'like', '%' . $request->search . '%');            
            });
        }
    
        // Sort by column if specified
        if ($request->has('sort_by') && $request->has('order')) {
            $query->orderBy($request->sort_by, $request->order);
        }
    
        // Paginate with the search and sort parameters appended to the links
        $clients = $query->paginate(500)->appends([
            'search' => $request->search,
            'sort_by' => $request->sort_by,
            'order' => $request->order,
        ]);        
        return view('clients.index', compact('clients'));
    }

    public function index()
    {
        $clients = Client::where('status', 'Active')
        ->orderBy('id', 'desc') // Correct position of orderBy
        ->paginate(500); // Paginate after the orderBy // Paginate with 10 clients per page
        return view('clients.index', compact('clients'));
    }
    
    public function create()
    {
        return view('clients.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:100',
            'contact_name' => 'required|string|max:255',
            'contact_number' => 'required|string|min:10|max:15',
            'address' => 'required|string|max:255',
            'gst_number' => 'required|string|max:20',
            'payment_terms' => 'required|string|max:150',
            'client_type' => 'required|string|max:15',
        ]);
    
        Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the client by its ID
        $client = Client::findOrFail($id);
    
        // Pass the client data to the view for display
        return view('clients.show', compact('client'));
    }
    

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }
    
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'business_name' => 'required|string|max:100',
            'contact_name' => 'required|string|max:255',
            'contact_number' => 'required|string|min:10|max:15',
            'address' => 'required|string|max:255',
            'gst_number' => 'required|string|max:20',
            'payment_terms' => 'required|string|max:150',
            'client_type' => 'required|string|max:15',
        ]);
    
        $client->update($request->all());
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }
    
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
