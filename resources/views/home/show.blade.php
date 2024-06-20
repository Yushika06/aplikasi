@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>{{ $produk->name }}</h1>
            </div>
            <div class="card-body">
                <img src="{{ asset('images/' . $produk->img) }}" class="img-fluid mb-3" alt="{{ $produk->name }}">
                <h3 class="card-text btn btn-warning">Harga: Rp {{ number_format($produk->price, 2, ',', '.') }}</h3>
<br>
                <p><strong>Deskripsi:</strong> {{ $produk->description }}</p>

                <!-- Form Pembelian -->
                <h4>Form Pembelian</h4>
                <form action="{{ route('produk.beli', $produk->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                    </div>
                    <div style="display:flex;flex-direction:row;justify-content:space-between;">
                    <button type="submit" class="btn btn-primary">Beli Sekarang</button>
                </form>

                <a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Produk</a>
            </div>
<br>
                @if(auth()->check())
                    <p><strong>Total Pembelian Anda:</strong> {{ auth()->user()->purchases }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
</body>
</html>
