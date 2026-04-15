<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('adm.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('adm.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'division' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
            'division' => $request->division
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
            'name' => 'required',
            'division' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}