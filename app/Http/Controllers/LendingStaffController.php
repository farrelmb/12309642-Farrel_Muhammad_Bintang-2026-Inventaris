<?php
namespace App\Http\Controllers;

use App\Exports\LendingExport;
use App\Models\Item;
use App\Models\Lending;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LendingStaffController extends Controller
{
    public function index(Request $request)
    {
        $query = Lending::with('item');

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date,
                $request->end_date,
            ]);
        }

        $lendings = $query->latest()->get();

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
            'name'            => 'required',
            'ket'             => 'required',
            'items'           => 'required|array',
            'items.*.item_id' => 'required',
            'items.*.total'   => 'required|integer|min:1',
        ]);

        foreach ($request->items as $data) {
            $item = Item::findOrFail($data['item_id']);

            if ($data['total'] > $item->available) {
                return back()->with('error', 'Stock not enough!');
            }

            Lending::create([
                'item_id' => $data['item_id'],
                'name'    => $request->name,
                'total'   => $data['total'],
                'ket'     => $request->ket,
            ]);
        }

        return redirect()->route('lendingstff.index')
            ->with('success', 'Lending berhasil ditambahkan');
    }

    public function returned(Request $request, $id)
    {
        $request->validate([
            'returned_total' => 'required|integer|min:0',
            'repair_total'   => 'required|integer|min:0',
        ]);

        $lending = Lending::findOrFail($id);
        $item    = $lending->item;

        $totalReturn = $request->returned_total + $request->repair_total;

        $sisa = $lending->total - ($lending->returned_total + $lending->repair_total);

        if ($totalReturn > $sisa) {
            return back()->with('error', 'Jumlah melebihi sisa!');
        }

        $lending->returned_total += $request->returned_total;
        $lending->repair_total   += $request->repair_total;

        if (($lending->returned_total + $lending->repair_total) >= $lending->total) {
            $lending->return_date = now();
        }

        $lending->save();

        // update barang rusak
        $item->repair += $request->repair_total;
        $item->save();

        return back()->with('success', 'Return berhasil diproses');
    }

    public function destroy($id)
    {
        $lending = Lending::findOrFail($id);

        // PROTEKSI: tidak boleh hapus jika belum dikembalikan
        if (! $lending->return_date) {
            return back()->with('error', 'Barang belum dikembalikan, tidak bisa dihapus!');
        }

        $lending->delete();

        return back()->with('success', 'Data lending berhasil dihapus');
    }
    public function export(Request $request)
    {
        return Excel::download(
            new LendingExport($request->start_date, $request->end_date),
            'lending.xlsx'
        );
    }
}
