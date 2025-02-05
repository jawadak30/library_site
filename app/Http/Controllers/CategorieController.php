<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesRequest;
use App\Models\Categorie;
use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    // Display all categories
    public function all_categories()
    {

        $categories = Categorie::with('livres')->get();
        return view('admin.categories.all_categories', compact('categories'));
    }

    // Show form to add a new category
    public function category_form_add()
    {
        return view('admin.categories.add_categories');
    }
    public function showLivres($id)
    {
        // Fetch the category
        $categorie = Categorie::find($id);

        // Check if category exists
        if (!$categorie) {
            return redirect()->back()->with('error', 'Category not found');
        }

        // Get all categories (for the header)
        $categories = Categorie::all();

        // Get books for the selected category with pagination (e.g., 10 per page)
        $livres = Livre::where('categorie_id', $id)->paginate(10);

        return view('components.books_category', compact('categories', 'livres'));
    }

    // Store a new category
    public function add_category(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        Categorie::create($request->all());

        return redirect()->route('all_categories')->with('success', 'Catégorie ajoutée avec succès');
    }

    // Show form to update a category
    public function category_form_update($request)
    {
        // Retrieve the ID from the request
        $id = $request;
        $category = Categorie::findOrFail($id);
        return view('admin.categories.update_categories', compact('category'));
    }

    public function update(CategoriesRequest $request, $id)
    {
        // Find the category by the ID passed in the route
        $category = Categorie::findOrFail($id);

        // Get the validated data
        $validatedData = $request->validated();

        // Update the category with the validated data
        $category->update($validatedData);

        // Redirect after successful update
        return redirect()->route('all_categories')->with('success', 'Catégorie mise à jour avec succès');
    }








    // Delete a category
    public function destroy(Request $request)
    {
        // Retrieve the ID from the request
        $id = $request->id;
        $category = Categorie::findOrFail($id);

        // Check if the category has books before deleting
        if ($category->livres()->count() > 0) {
            return redirect()->route('all_categories')->with('error', 'Impossible de supprimer cette catégorie car elle contient des livres.');
        }

        // Delete the category
        $category->delete();

        return redirect()->route('all_categories')->with('success', 'Catégorie supprimée avec succès');
    }
}
