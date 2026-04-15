<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Lending;

class LendingStaffController extends Controller
{
    public function index()
    {
        $lendings = Lending::with('item')->latest()->get();
        return view('stff.lending.index', compact('lendings'));
    }

    public function create()
    {
        $items = Item::with('category')->get();
        return view('stff.lending.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'name' => 'required',
            'total' => 'required|integer|min:1',
        ]);

        $item = Item::findOrFail($request->item_id);

        if ($request->total > $item->available) {
            return back()->with('error', 'Total item more than available!');
        }

        Lending::create([
            'item_id' => $request->item_id,
            'name' => $request->name,
            'total' => $request->total,
            'ket' => $request->ket,
        ]);

        return redirect()
            ->route('lendingstff.index')
            ->with('success', 'Lending berhasil ditambahkan');
    }

    public function returned($id)
    {
        $lending = Lending::findOrFail($id);

        $lending->update([
            'return_date' => now(),
        ]);

        return back()->with('success', 'Barang berhasil dikembalikan');
    }

    public function destroy($id)
    {
        $lending = Lending::findOrFail($id);
        $lending->delete();

        return back()->with('success', 'Data lending berhasil dihapus');
    }
}