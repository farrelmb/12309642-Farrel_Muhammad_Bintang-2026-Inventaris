<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->get();
        return view('adm.item.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('adm.item.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'total' => 'required|integer'
        ]);

        Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'total' => $request->total,
            'repair' => 0
        ]);

        return redirect()->route('items.index')->with('success', 'Item berhasil ditambah');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();

        return view('adm.item.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'total' => 'required|integer',
            'new_broke' => 'nullable|integer|min:0'
        ]);

        $item = Item::findOrFail($id);

        // logic repair (sesuai UI kamu)
        $newBroken = $request->new_broke ?? 0;
        $item->repair = $item->repair + $newBroken;

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'total' => $request->total,
            'repair' => $item->repair
        ]);

        return redirect()->route('items.index')->with('success', 'Item berhasil diupdate');
    }

    public function destroy($id)
    {
        Item::findOrFail($id)->delete();
        return back()->with('success', 'Item berhasil dihapus');
    }
}
