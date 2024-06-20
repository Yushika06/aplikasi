<!-- resources/views/home/show.blade.php -->
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

                <!-- Form Pembelian -->
                <h3>Form Pembelian</h3>
                <form action="{{ route('produk.beli', $produk->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Beli Sekarang</button>
                </form>

                <a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Produk</a>

                @if(auth()->check())
                    <p><strong>Total Pembelian Anda:</strong> {{ auth()->user()->purchases }}</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
