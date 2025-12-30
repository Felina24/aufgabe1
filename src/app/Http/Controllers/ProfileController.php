<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;
use App\Models\Item;
use App\Models\Category;
use App\Models\Purchase;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        return view('auth.profile', compact('user', 'profile'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();

        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);

        $data = $request->validated();

        if ($request->hasFile('profile_image')) {

            $originalName = $request->file('profile_image')->getClientOriginalName();
            $savePath = 'profile_images/' . $originalName;

            if (!empty($profile->icon_path) && Storage::disk('public')->exists($profile->icon_path)) {
                Storage::disk('public')->delete($profile->icon_path);
            }

            Storage::disk('public')->putFileAs(
                'profile_images',
                $request->file('profile_image'),
                $originalName
            );

            $profile->icon_path = $savePath;
        }

        $user->name = $data['username'];
        $user->save();

        $profile->username = $data['username'];
        $profile->zip      = $data['zip'];
        $profile->address  = $data['address'];
        $profile->building = $data['building_name'] ?? null;

        $profile->save();

        return redirect('/')->with('status', 'プロフィールを更新しました');
    }

    public function mypage()
    {
        $user = Auth::user();
        $profile = $user->profile;

        $sellingItems = $user->items()->get();

        $boughtItems = \App\Models\Purchase::where('user_id', $user->id)
                        ->with('item')
                        ->get()
                        ->pluck('item');

        return view('mypage.index', compact('profile', 'sellingItems', 'boughtItems'));
    }


    public function show()
    {
        $user = auth()->user();
        $profile = $user->profile ?? new Profile();

        $selling = Item::where('user_id', $user->id)->get();

        $bought = Item::whereHas('purchase', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->get();

        return view('mypage.profile', compact('user', 'profile', 'selling', 'bought'));
    }

    public function bought()
    {
        $userId = Auth::id();

        $boughtItems = Purchase::where('user_id', $userId)
            ->with('item')
            ->get()
            ->map(function ($purchase) {
                return $purchase->item;
            });

        $profile = Profile::where('user_id', $userId)->first();

        return view('mypage.bought', compact('boughtItems', 'profile'));
    }
}
