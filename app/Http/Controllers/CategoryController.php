<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('items')->get();
        return view('adm.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('adm.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'division' => 'required',
        ]);

        Category::create([
            'name'     => $request->name,
            'division' => $request->division,
        ]);

        return redirect()->route('categories.index')->with('success', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('adm.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required',
            'division' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $category = Category::with('items.lendings')->findOrFail($id);

        // cek apakah ada item yang masih dipinjam
        foreach ($category->items as $item) {
            $isLending = $item->lendings()->whereNull('return_date')->exists();

            if ($isLending) {
                return back()->with('error', 'Category tidak bisa dihapus karena masih ada item yang dipinjam!');
            }
        }

        $category->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
