@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
    <h1>Masuk</h1>
    <div class="form-box">
        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                @error('email') <div class="err">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label for="password">Kata sandi</label>
                <input id="password" type="password" name="password" autocomplete="current-password">
                @error('password') <div class="err">{{ $message }}</div> @enderror
            </div>
            <div class="field check">
                <input id="remember" type="checkbox" name="remember" value="1">
                <label for="remember" style="margin:0;font-weight:400">Ingat saya</label>
            </div>
            <div class="actions" style="margin-top:0">
                <button type="submit" class="btn">Masuk</button>
                <a class="btn secondary" href="{{ route('books.index') }}">Batal</a>
            </div>
        </form>
        <p class="count">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
    </div>
@endsection
