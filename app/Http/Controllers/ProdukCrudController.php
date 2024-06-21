<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class ProdukCrudController extends Controller
{
    public function index()
    {
        // Mengambil semua produk dari database
        $produks = Produk::all();
        $users = User::all();

        // Melewatkan data produk ke tampilan
        return view('admin.produks.index', compact('produks', 'users'));
    }


    public function create()
    {
        return view('admin.produks.create');
    }

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

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produks.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $produk->name = $request->input('name');
        $produk->price = $request->input('price');
        $produk->description = $request->input('description');

        if ($request->hasFile('img')) {
            // Hapus gambar lama jika ada
            if ($produk->img && file_exists(public_path('images/' . $produk->img))) {
                unlink(public_path('images/' . $produk->img));
            }

            // Upload gambar baru
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
            $produk->img = $imageName;
        }

        $produk->save();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('admin.produk.index');
    }
}
