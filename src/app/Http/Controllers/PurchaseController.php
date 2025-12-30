<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function show($id)
    {
        $item = Item::findOrFail($id);

        $address = Address::where('user_id', auth()->id())->first();

        if (!$address) {
            $address = auth()->user()->profile;
        }

        return view('products.purchase', compact('item', 'address'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        Purchase::create([
            'user_id' => Auth::id(),
            'item_id' => $id,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('mypage');
    }
}
