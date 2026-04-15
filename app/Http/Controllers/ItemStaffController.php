<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemStaffController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->get();
        return view('stff.itemsstff.index', compact('items'));
    }
}