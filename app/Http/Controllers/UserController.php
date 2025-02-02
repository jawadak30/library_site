<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Livre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

// UserController.php
public function addToCart(Request $request)
{
    $bookId = $request->book_id;

    // Retrieve the current cart session or create an empty array
    $cart = session()->get('cart', []);

    // Only add the book ID if it’s not already in the cart
    if (!in_array($bookId, $cart)) {
        $cart[] = $bookId;
        session(['cart' => $cart]); // Update session
        session()->save(); // Ensure session is saved
    }

    // Redirect back with a success message
    return back()->with('success', 'Book added to cart!');
}

    public function checkout()
    {
        if (auth()->check()) {
            return redirect()->route('reserveBooks'); // Authenticated users go to reserve
        }

        return redirect()->route('login')->with('message', 'Please log in to complete your reservation.');
    }


    public function index()
    {
        $categories = Categorie::with('livres')->get();
        $livres = Livre::with('categorie')->latest()->paginate(8);
        return view('welcome', compact('categories','livres'));
    }
        // Display all users
        public function all_users()
        {
            // Exclude the currently authenticated user
            $users = User::where('id', '!=', Auth::id())->get();

            return view('admin.users.all_users', compact('users'));
        }

        // Show form to add a new user
        public function user_form_add()
        {
            return view('admin.users.add_user');
        }

        // Store a new user
        public function add_user(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|in:admin,user',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            return redirect()->route('all_users')->with('success', 'Utilisateur ajouté avec succès');
        }

        // Show form to edit a user
        public function user_form_update($id)
        {
            $user = User::findOrFail($id);
            return view('admin.users.update_user', compact('user'));
        }

        // Update user details
        public function update(Request $request, $id)
        {
            // Find the user
            $user = User::findOrFail($id);

            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
                'role' => 'required|in:admin,user',
            ]);

            // Update the user
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->role = $request->role;
            $user->save();

            // Redirect with a success message
            return redirect()->route('all_users')->with('success', 'User updated successfully.');
        }

        // Delete a user
        public function destroy(request $request)
        {
            $user = User::findOrFail($request->id);
            $user->delete();

            return redirect()->route('all_users')->with('success', 'Utilisateur supprimé avec succès');
        }
}
