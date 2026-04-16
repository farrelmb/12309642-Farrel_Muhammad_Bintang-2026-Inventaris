<?php
namespace App\Http\Controllers;

use App\Exports\ItemsExport;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            'name'        => 'required',
            'category_id' => 'required',
            'total'       => 'required|integer',
        ]);

        Item::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'total'       => $request->total,
            'repair'      => 0,
        ]);

        return redirect()->route('items.index')->with('success', 'Item berhasil ditambah');
    }

    public function edit($id)
    {
        $item       = Item::findOrFail($id);
        $categories = Category::all();

        return view('adm.item.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required',
            'category_id' => 'required',
            'total'       => 'required|integer|min:0',
            'new_broke'   => 'nullable|integer|min:0',
            'fixed_item'  => 'nullable|integer|min:0',
        ]);

        $item = Item::findOrFail($id);

        $newBroken = $request->new_broke ?? 0;
        $fixedItem = $request->fixed_item ?? 0;

        // ❗ VALIDASI: tidak boleh lebih besar dari repair
        if ($fixedItem > $item->repair) {
            return back()->with('error', 'Jumlah perbaikan melebihi barang rusak!');
        }

        // 🔥 UPDATE REPAIR
        $item->repair = $item->repair + $newBroken - $fixedItem;

        // 🔥 UPDATE DATA
        $item->update([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'total'       => $request->total,
            'repair'      => $item->repair,
        ]);

        return redirect()->route('items.index')
            ->with('success', 'Item berhasil diupdate');
    }

    public function destroy($id)
    {
        Item::findOrFail($id)->delete();
        return back()->with('success', 'Item berhasil dihapus');
    }
    public function lendings($id)
    {
        $item = Item::findOrFail($id);

        $lendings = $item->lendings()
            ->whereNull('return_date')
            ->latest()
            ->get();

        return view('adm.item.lendings', compact('item', 'lendings'));
    }
    public function export()
    {
        return Excel::download(new ItemsExport, 'items.xlsx');
    }
}
