<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

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
    public function category_form_update(Request $request)
    {
        // Retrieve the ID from the request
        $id = $request->id;
        $category = Categorie::findOrFail($id);
        return view('admin.categories.update_categories', compact('category'));
    }

    // Update category details
    public function update(Request $request)
    {
        // Retrieve the ID from the request
        $id = $request->id;
        $category = Categorie::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

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
