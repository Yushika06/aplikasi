<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\User;
use App\Http\Controllers\UserController; // Import the UserController

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all()->map(function ($produk) {
            $produk->formatted_price = number_format($produk->price, 2, ',', '.');
            return $produk;
        });
        return view('home.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produks.create');
    }

    public function beli(Request $request, $id)
    {
        $produk = Produk::find($id);
        $quantity = $request->input('quantity');
        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Cek apakah sudah ada pembelian untuk produk ini oleh user
        $pembelian = Pembelian::where('produk_id', $produk->id)->where('user_id', $user->id)->first();

        if ($pembelian) {
            // Update pembelian yang sudah ada
            $pembelian->quantity += $quantity;
            $pembelian->save();
        } else {
            // Buat catatan pembelian baru
            Pembelian::create([
                'user_id' => $user->id,
                'produk_id' => $produk->id,
                'quantity' => $quantity,
            ]);
        }

        // Increment the purchases count for the user
        $userController = new UserController();
        $userController->incrementPurchases($user, $quantity);

        return redirect()->route('home.show', ['id' => $id])->with('success', 'Pembelian berhasil dilakukan!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);

        // Handle image upload
        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('images'), $imageName);

        Produk::create([
            'name' => $request->name,
            'price' => $request->price,
            'img' => $imageName,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dibuat.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('home.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        return view('produks.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
        ]);

        $produk->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('produks.index')->with('success', 'Produk updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        // Hapus semua pembelian yang terkait dengan produk ini
        $produk->pembelian()->delete();

        // Hapus produk
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
