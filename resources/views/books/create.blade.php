@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <h1>Tambah Buku</h1>
    <div class="form-box">
        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" novalidate>
            @csrf
            @include('books._form')
            <div class="actions" style="margin-top:0">
                <button type="submit" class="btn">Simpan buku</button>
                <a class="btn secondary" href="{{ route('books.index') }}">Batal</a>
            </div>
        </form>
    </div>
@endsection
