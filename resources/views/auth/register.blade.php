@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
    <h1>Daftar Akun</h1>
    <div class="form-box">
        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf
            <div class="field">
                <label for="name">Nama</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                @error('name') <div class="err">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email">
                @error('email') <div class="err">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label for="password">Kata sandi</label>
                <input id="password" type="password" name="password" autocomplete="new-password">
                <div class="hint">Minimal 8 karakter.</div>
                @error('password') <div class="err">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label for="password_confirmation">Ulangi kata sandi</label>
                <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password">
            </div>
            <div class="actions" style="margin-top:0">
                <button type="submit" class="btn">Daftar</button>
                <a class="btn secondary" href="{{ route('books.index') }}">Batal</a>
            </div>
        </form>
        <p class="count">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
    </div>
@endsection
