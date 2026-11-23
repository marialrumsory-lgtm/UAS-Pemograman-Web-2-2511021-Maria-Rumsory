@extends('layouts.app')

@section('title', $book->title)

@section('content')
    <div class="detail">
        @include('books._cover', ['book' => $book])

        <div>
            <h1>{{ $book->title }}</h1>
            <ul class="meta">
                <li><strong>Penulis:</strong> {{ $book->author }}</li>
                <li><strong>Tahun terbit:</strong> {{ $book->year }}</li>
                <li><strong>Kategori:</strong> {{ $book->category }}</li>
            </ul>

            <h2 style="font-size:1.1rem;margin:0 0 4px">Sinopsis</h2>
            <p style="margin:0">{{ $book->synopsis ?: 'Belum ada sinopsis.' }}</p>

            <div class="actions">
                <a class="btn secondary" href="{{ route('books.index') }}">Kembali</a>
                @auth
                    <a class="btn" href="{{ route('books.edit', $book) }}">Ubah data</a>
                    <form method="POST" action="{{ route('books.destroy', $book) }}"
                          onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn danger">Hapus buku</button>
                    </form>
                @endauth
            </div>

            @guest
                <p class="count" style="margin-top:16px">
                    <a href="{{ route('login') }}">Masuk</a> untuk mengubah atau menghapus buku.
                </p>
            @endguest
        </div>
    </div>
@endsection
