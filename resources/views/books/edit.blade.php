@extends('layouts.app')

@section('title', 'Ubah Buku')

@section('content')
    <h1>Ubah Data Buku</h1>
    <div class="form-box">
        <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            @include('books._form')
            <div class="actions" style="margin-top:0">
                <button type="submit" class="btn">Simpan perubahan</button>
                <a class="btn secondary" href="{{ route('books.show', $book) }}">Batal</a>
            </div>
        </form>
    </div>
@endsection
