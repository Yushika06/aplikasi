<!DOCTYPE html>
<html>
<head>
    <title>Admin - Daftar Produk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Admin - Daftar Produk</h1>
        <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
        <div class="row">
            @if($produks && $produks->count() > 0)
                @foreach($produks as $produk)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img src="{{ asset('images/' . $produk->img) }}" class="card-img-top" alt="{{ $produk->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $produk->name }}</h5>
                                <p class="card-text">Harga: {{ $produk->price }}</p>
                                <p class="card-text">{{ $produk->description }}</p>
                                <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">Tidak ada produk yang tersedia.</p>
            @endif
        </div>
    </div>
</body>
</html>
