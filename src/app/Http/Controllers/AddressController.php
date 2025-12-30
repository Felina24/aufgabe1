<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function edit($item_id)
    {
        $user = Auth::user();

        $address = Address::firstOrNew([
            'user_id' => $user->id,
        ]);

        if (empty($address->zip) && $user->profile) {
            $address->zip      = $user->profile->zip;
            $address->address  = $user->profile->address;
            $address->building = $user->profile->building;
        }

        $item = Item::findOrFail($item_id);

        return view('address.edit', compact('address', 'item'));
    }

    public function update(Request $request, $item_id)
    {
        $validated = $request->validate([
            'zip' => 'required',
            'address' => 'required',
            'building' => 'nullable',
        ]);

        Address::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        return redirect()->route('purchase.show', ['id' => $item_id]);
    }
}
