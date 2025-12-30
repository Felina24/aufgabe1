<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Item::query();

        if (Auth::check()) {
            $query->where('user_id', '!=', Auth::id());
        }

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        $items = $query->get();

        return view('products.index', compact('items', 'keyword'));
    }

    public function mypage()
    {
        $items = Item::where('user_id', Auth::id())->get();

        return view('mypage', compact('items'));
    }

    public function show(Item $item)
    {
        $likeCount = $item->likes()->count();

        $isLiked = auth()->check()
            ? auth()->user()->likedItems->contains($item->id)
            : false;

        return view('products.show', [
            'item' => $item,
            'likeCount' => $likeCount,
            'isLiked' => $isLiked
        ]);
    }

    public function mylist()
    {
        $items = auth()->user()->likedItems;
        return view('products.mylist', compact('items'));
    }

    public function toggleLike(Item $item)
    {
        $user = auth()->user();

        if ($user->likedItems()->where('item_id', $item->id)->exists()) {
            $user->likedItems()->detach($item->id);
        } else {
            $user->likedItems()->attach($item->id);
        }

        return back();
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.sell', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image'         => 'nullable|image|max:2048',
            'name'          => 'required|string|max:255',
            'brand_name'    => 'nullable|string|max:255',
            'price'         => 'required|integer|min:1',
            'description'   => 'nullable|string',
            'category_ids'  => 'nullable|array',
            'category_ids.*'=> 'exists:categories,id',
            'condition'     => 'nullable|string|max:255',
        ]);

        $item = new Item();
        $item->user_id     = Auth::id();
        $item->name        = $validated['name'];
        $item->brand_name  = $validated['brand_name'] ?? null;
        $item->price       = $validated['price'];
        $item->description = $validated['description'] ?? null;
        $item->status      = $validated['condition'] ?? '未設定';

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $originalName = $file->getClientOriginalName();

            $directory = 'products';

            if (Storage::disk('public')->exists("$directory/$originalName")) {
                Storage::disk('public')->delete("$directory/$originalName");
            }

            $path = $file->storeAs($directory, $originalName, 'public');

            $item->image_path = $path;
        }

        $item->save();

        if (!empty($validated['category_ids'])) {
            $item->categories()->sync($validated['category_ids']);
        }

        return redirect()->route('mypage');
    }
}
