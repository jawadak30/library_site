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
        $request->validate( [
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'editeur' => 'required|string|max:255',
            'date_edition' => 'required|date',
            'nbr_exemplaire' => 'required|integer|min:1',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        Livre::create($request->all());

        return redirect()->route('all_books')->with('success', 'Livre ajouté avec succès');
    }

    // Show form to edit a book
    public function book_form_update(Request $request)
    {
        // Retrieve the ID from the request
        $id = $request->id;
        $book = Livre::findOrFail($id);
        $categories = Categorie::all();

        // Return the update view with the book and categories data
        return view('admin.livres.update_book', compact('book', 'categories'));
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
        ]);

        // Update the book
        $book->update($request->all());

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
