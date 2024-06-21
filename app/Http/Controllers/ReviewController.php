<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Pembelian;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $produk_id)
    {
        $request->validate([
            'review' => 'required',
            'rating' => 'required|integer|between:1,5'
        ]);

        $user = Auth::user();

        // Cek apakah pengguna telah membeli produk ini
        $hasPurchased = Pembelian::where('user_id', $user->id)
                                  ->where('produk_id', $produk_id)
                                  ->exists();

        if (!$hasPurchased) {
            return redirect()->route('home.show', $produk_id)->with('error', 'You need to purchase the product to review it.');
        }

        Review::create([
            'user_id' => $user->id,
            'produk_id' => $produk_id,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return redirect()->route('home.show', $produk_id)->with('success', 'Review added successfully.');
    }
}
