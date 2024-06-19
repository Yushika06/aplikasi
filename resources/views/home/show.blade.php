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
                <p><strong>Harga:</strong> {{ $produk->price }}</p>
                <p><strong>Deskripsi:</strong> {{ $produk->description }}</p>
                <h3>Reviews</h3>
                <ul class="list-group">
                    @foreach($produk->reviews as $review)
                        <li class="list-group-item">{{ $review->content }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Produk</a>
            </div>
        </div>
    </div>
</body>
</html>
