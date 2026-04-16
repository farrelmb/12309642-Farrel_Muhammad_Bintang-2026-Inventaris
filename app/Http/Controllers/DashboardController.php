<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Lending;

class DashboardController extends Controller
{
    public function admin()
    {
        // total kategori
        $totalCategory = Category::count();

        // total barang rusak
        $totalRepair = Item::sum('repair');

        // total barang yang masih dipinjam (belum selesai)
        $totalLending = Lending::whereNull('return_date')->sum('total');

        return view('adm.dashboardadm', compact(
            'totalCategory',
            'totalRepair',
            'totalLending'
        ));
    }
}