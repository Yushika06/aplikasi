@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Produk</h1>
        <div class="row">
            @if($produks && $produks->count() > 0)
                @foreach($produks as $produk)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img src="{{ asset('images/' . $produk->img) }}" alt="{{ $produk->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $produk->name }}</h5>
                                <p class="btn btn-warning btn-sm">Harga: Rp {{ number_format($produk->price, 2, ',', '.') }}</p><br>
                                <a href="{{ route('home.show', $produk->id) }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">Tidak ada produk yang tersedia.</p>
            @endif
        </div>
    </div>
    @endsection
</body>
</html>
