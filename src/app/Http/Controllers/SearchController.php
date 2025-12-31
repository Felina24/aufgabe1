<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            return view('products.search', [
                'items' => [],
                'keyword' => ''
            ]);
        }

        $items = Item::with(['purchase', 'user'])
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->get();

        return view('products.search', compact('items', 'keyword'));
    }
}
