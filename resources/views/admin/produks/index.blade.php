@extends('layouts.app')

@section('title', 'Daftar Produk dan User')

@section('content')
    <title>Admin - Daftar Produk dan User</title>
    <h1 class="text-center">Admin - Daftar Produk dan User</h1>
    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a><br>

    <h2 class="mt-5">Daftar Produk</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><i class="fa-solid fa-list"></i> </th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produks as $produk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $produk->name }}</td>
                    <td>{{ number_format($produk->price, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Anda yakin menghapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="mt-5">Daftar User</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><i class="fa-solid fa-list"></i></th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if ($user->role != 2)
                            @if ($user->role == 1)
                                <form action="{{ route('user.block', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Anda yakin memblokir user ini?')">Blokir</button>
                                </form>
                            @elseif($user->role == 3)
                                <form action="{{ route('user.unblock', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm"
                                        onclick="return confirm('Anda yakin membuka blokir user ini?')">Batal
                                        Blokir</button>
                                </form>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
