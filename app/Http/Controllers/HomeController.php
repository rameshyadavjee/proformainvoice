<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;

class HomeController extends Controller
{    
    public function __construct()
    {
        $this->middleware(['auth']);
    }
 
    public function index()
    {
        return view('home');
    }
    // Show the form to create a new user
    public function create()
    {            
        return view('users.create');
    }

    // Store the new user in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed', 
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); 
        $user->save();

        // Get the last inserted user ID
        $userId = $user->id;

        // Insert a record into the role_user table
        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => $userId,
            'user_type' => 'App\Models\User',
        ]);

        return redirect()->route('users.index')->with('status', 'User created successfully!');
    }

    // Update the user in the database
    public function users(Request $request)
    {  

        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function showChangePasswordForm()
    { 

        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:4'],
            'new_password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        // Check if the current password matches
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        // Update the password
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Log the user out
        Auth::logout();

        // Redirect to the login page with a status message
        return redirect()->route('login')->with('status', 'Password changed successfully!');
    }

    // Show the password reset form
    public function editPassword($id)
    {
         
        $user = User::findOrFail($id);
        return view('users.edit-password', compact('user'));
    }

    // Update the user's password
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->with('status', 'Password updated successfully!');
    }
// Show the form to edit an existing user
    public function edit($id)
    {
        
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Update the user in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'status' => 'required|in:Active,Inactive,Blocked',             
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;        
        $user->status = $request->status;
        
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:4|confirmed',
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('status', 'User updated successfully!');
    }

    // Update the user in the database
    public function searchuser(Request $request)
    {
        $query = User::query();
    
        // Search by name or email
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');                  
            });
        }
    
        // Sort by column if specified
        if ($request->has('sort_by') && $request->has('order')) {
            $query->orderBy($request->sort_by, $request->order);
        }
    
        // Paginate with the search and sort parameters appended to the links
        $users = $query->paginate(10)->appends([
            'search' => $request->search,
            'sort_by' => $request->sort_by,
            'order' => $request->order,
        ]);
    
        return view('users.index', compact('users'));
    }
    
}
