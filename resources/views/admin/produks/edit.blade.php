@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

    <title>Admin - Edit Produk</title>

    <h1 class="text-center">Edit Produk</h1>
    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $produk->name }}" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $produk->price }}" required>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="img" name="img">
            <img src="{{ asset('images/' . $produk->img) }}" alt="{{ $produk->name }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $produk->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Produk</button>
    </form>
@endsection
