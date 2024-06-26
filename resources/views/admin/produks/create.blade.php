@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <title>Admin - Tambah Produk</title>

    <h1 class="text-center">Tambah Produk Baru</h1>
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="img" name="img" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Produk</button>
    </form>
@endsection
