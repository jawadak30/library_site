<?php
namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    // Display all books
    public function all_books()
    {
        $books = Livre::with('categorie')->get();
        return view('admin.livres.all_books', compact('books'));
    }

    // Show form to add a new book
    public function book_form_add()
    {
        $categories = Categorie::all();
        return view('admin.livres.add_book', compact('categories'));
    }

    // Store a new book
    public function add_book(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'editeur' => 'required|string|max:255',
            'date_edition' => 'required|date',
            'nbr_exemplaire' => 'required|integer|min:1',
            'categorie_id' => 'required|exists:categories,id',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Generate unique filenames for each image
        $image1Name = uniqid() . '.' . $request->file('image1')->getClientOriginalExtension();
        $image2Name = uniqid() . '.' . $request->file('image2')->getClientOriginalExtension();

        // Store the images with unique names
        $image1Path = $request->file('image1')->storeAs('livres', $image1Name, 'public');
        $image2Path = $request->file('image2')->storeAs('livres', $image2Name, 'public');

        // Create the book record, including the paths to the images
        Livre::create([
            'titre' => $request->titre,
            'auteur' => $request->auteur,
            'editeur' => $request->editeur,
            'date_edition' => $request->date_edition,
            'nbr_exemplaire' => $request->nbr_exemplaire,
            'categorie_id' => $request->categorie_id,
            'image1' => $image1Path,
            'image2' => $image2Path,
        ]);

        return redirect()->route('all_books')->with('success', 'Livre ajouté avec succès');
    }


    // Show form to edit a book
    public function book_form_update($id)
    {
        $book = Livre::findOrFail($id); // Fetch the book by ID
        $categories = Categorie::all(); // Fetch categories for dropdown (if needed)
        return view('admin.livres.update_book', compact('book', 'categories')); // Pass data to the view
    }

    // Update book details
    public function update(Request $request)
    {
        // Retrieve the ID from the request
        $id = $request->id;
        $book = Livre::findOrFail($id);

        // Validate the request
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'editeur' => 'required|string|max:255',
            'date_edition' => 'required|date',
            'nbr_exemplaire' => 'required|integer|min:1',
            'categorie_id' => 'required|exists:categories,id',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional image validation
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional image validation
        ]);

        // Check if image1 was provided and generate a unique name for it
        if ($request->hasFile('image1')) {
            $image1Name = uniqid() . '.' . $request->file('image1')->getClientOriginalExtension();
            $book->image1 = $request->file('image1')->storeAs('livres', $image1Name, 'public');
        }

        // Check if image2 was provided and generate a unique name for it
        if ($request->hasFile('image2')) {
            $image2Name = uniqid() . '.' . $request->file('image2')->getClientOriginalExtension();
            $book->image2 = $request->file('image2')->storeAs('livres', $image2Name, 'public');
        }

        // Update the rest of the book details, excluding images
        $book->update($request->except(['image1', 'image2']));

        // Redirect with success message
        return redirect()->route('all_books')->with('success', 'Livre mis à jour avec succès');
    }


    // Delete a book
    public function destroy(Request $request)
    {
        // Retrieve the ID from the request
        $id = $request->id;
        $book = Livre::findOrFail($id);

        // Delete the book
        $book->delete();

        // Redirect with success message
        return redirect()->route('all_books')->with('success', 'Livre supprimé avec succès');
    }
}
