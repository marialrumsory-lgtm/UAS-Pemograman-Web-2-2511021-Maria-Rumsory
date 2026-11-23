@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <div class="page-head">
        <h1>Koleksi Buku</h1>
        @auth
            <a class="btn" href="{{ route('books.create') }}">+ Tambah buku</a>
        @endauth
    </div>

    <form method="GET" action="{{ route('books.index') }}" class="controls">
        <div class="chips" role="group" aria-label="Filter kategori">
            <a class="chip {{ $category === '' ? 'active' : '' }}"
               href="{{ route('books.index', array_filter(['q' => $q, 'sort' => $sort])) }}">Semua</a>
            @foreach ($categories as $cat)
                <a class="chip {{ $category === $cat ? 'active' : '' }}"
                   href="{{ route('books.index', array_filter(['category' => $cat, 'q' => $q, 'sort' => $sort])) }}">{{ $cat }}</a>
            @endforeach
        </div>

        <input type="hidden" name="category" value="{{ $category }}">
        <div class="search-row">
            <input type="search" name="q" value="{{ $q }}" placeholder="Cari judul atau penulis…" aria-label="Cari judul atau penulis">
            <select name="sort" aria-label="Urutkan">
                @foreach ($sorts as $key => $s)
                    <option value="{{ $key }}" @selected($sort === $key)>{{ $s['label'] }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn">Cari</button>
        </div>
    </form>

    <p class="count">{{ $books->count() }} dari {{ $total }} buku</p>

    @if ($books->isEmpty())
        <div class="empty">Buku tidak ditemukan.</div>
    @else
        <div class="grid">
            @foreach ($books as $book)
                <a class="card" href="{{ route('books.show', $book) }}">
                    @include('books._cover', ['book' => $book])
                    <div class="card-body">
                        <h3>{{ $book->title }}</h3>
                        <p>{{ $book->author }}</p>
                        <p>{{ $book->category }} · {{ $book->year }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
@endsection
