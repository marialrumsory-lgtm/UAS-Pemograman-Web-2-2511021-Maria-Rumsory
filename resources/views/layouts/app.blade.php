<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Rak Buku Digital') — Rak Buku Digital</title>
    <style>
        :root {
            --bg: #f6f4ef; --surface: #ffffff; --text: #1f2430; --muted: #667085;
            --border: #dcd8cf; --primary: #1f3b73; --primary-text: #ffffff;
            --danger: #b42318; --ok-bg: #e6f4ea; --ok-text: #14532d;
            --err-bg: #fdecea; --err-text: #7a1b12;
        }
        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #14161b; --surface: #1d2027; --text: #eceef2; --muted: #9aa3b2;
                --border: #33383f; --primary: #7ea6ff; --primary-text: #0b1220;
                --danger: #ff8a7a; --ok-bg: #12331f; --ok-text: #a7e8bd;
                --err-bg: #3a1713; --err-text: #ffb4a8;
            }
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
               background: var(--bg); color: var(--text); line-height: 1.5; }
        a { color: var(--primary); }
        .container { max-width: 1040px; margin: 0 auto; padding: 0 16px 48px; }

        header.site { background: var(--surface); border-bottom: 1px solid var(--border); margin-bottom: 24px; }
        header.site .container { display: flex; align-items: center; justify-content: space-between;
                                 gap: 12px; flex-wrap: wrap; padding-top: 12px; padding-bottom: 12px; }
        .brand { font-size: 1.25rem; font-weight: 700; text-decoration: none; color: var(--text); }
        .nav { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .nav .who { color: var(--muted); font-size: .9rem; }

        .btn { display: inline-flex; align-items: center; justify-content: center; min-height: 44px;
               padding: 0 18px; border-radius: 8px; border: 1px solid var(--primary);
               background: var(--primary); color: var(--primary-text); font: inherit; font-weight: 600;
               text-decoration: none; cursor: pointer; }
        .btn.secondary { background: transparent; color: var(--primary); }
        .btn.danger { background: transparent; color: var(--danger); border-color: var(--danger); }
        .btn:focus-visible, .chip:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible {
            outline: 3px solid var(--primary); outline-offset: 2px; }

        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; }
        .alert.success { background: var(--ok-bg); color: var(--ok-text); }
        .alert.error { background: var(--err-bg); color: var(--err-text); }

        h1 { margin: 0 0 16px; font-size: 1.6rem; }
        .page-head { display: flex; align-items: center; justify-content: space-between;
                     gap: 12px; flex-wrap: wrap; margin-bottom: 16px; }
        .page-head h1 { margin: 0; }

        .controls { display: grid; gap: 12px; margin-bottom: 12px; }
        .chips { display: flex; gap: 8px; flex-wrap: wrap; }
        .chip { display: inline-flex; align-items: center; min-height: 44px; padding: 0 16px; border-radius: 999px;
                border: 1px solid var(--border); background: var(--surface); color: var(--text); text-decoration: none; }
        .chip.active { background: var(--primary); color: var(--primary-text); border-color: var(--primary); font-weight: 600; }
        .search-row { display: flex; gap: 8px; flex-wrap: wrap; }
        .search-row input[type=search] { flex: 1 1 220px; }
        input, select, textarea { font: inherit; min-height: 44px; padding: 8px 12px; border-radius: 8px;
                                  border: 1px solid var(--border); background: var(--surface); color: var(--text); width: 100%; }
        .search-row select { width: auto; flex: 0 0 auto; }
        textarea { min-height: 110px; resize: vertical; }
        .count { color: var(--muted); margin: 8px 0 16px; }

        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 16px; }
        .card { display: block; background: var(--surface); border: 1px solid var(--border); border-radius: 12px;
                overflow: hidden; text-decoration: none; color: var(--text); }
        .card:hover, .card:focus-visible { border-color: var(--primary); }
        .card-body { padding: 12px; }
        .card-body h3 { margin: 0 0 4px; font-size: 1rem; }
        .card-body p { margin: 0; color: var(--muted); font-size: .875rem; }

        .cover { display: flex; flex-direction: column; justify-content: space-between; aspect-ratio: 3 / 4;
                 padding: 14px; color: #fff; }
        .cover-cat { font-size: .7rem; letter-spacing: .08em; text-transform: uppercase; opacity: .85; }
        .cover-title { font-size: 1.15rem; font-weight: 700; line-height: 1.25; }

        .empty { text-align: center; padding: 48px 16px; background: var(--surface);
                 border: 1px dashed var(--border); border-radius: 12px; color: var(--muted); }

        .detail { display: grid; grid-template-columns: 240px 1fr; gap: 24px; background: var(--surface);
                  border: 1px solid var(--border); border-radius: 12px; padding: 20px; }
        .detail .cover { border-radius: 8px; }
        .detail h1 { margin-bottom: 4px; }
        .meta { margin: 0 0 16px; padding: 0; list-style: none; color: var(--muted); }
        .meta strong { color: var(--text); }
        .actions { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 24px; }

        .form-box { background: var(--surface); border: 1px solid var(--border); border-radius: 12px;
                    padding: 20px; max-width: 560px; }
        .field { margin-bottom: 16px; }
        .field label { display: block; font-weight: 600; margin-bottom: 4px; }
        .field .err { color: var(--danger); font-size: .875rem; margin-top: 4px; }
        .field .hint { color: var(--muted); font-size: .8rem; margin-top: 4px; }
        .check { display: flex; align-items: center; gap: 8px; }
        .check input { width: auto; min-height: 0; }

        @media (max-width: 600px) {
            .grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .detail { grid-template-columns: 1fr; }
            .detail .cover { max-width: 220px; }
        }
    </style>
</head>
<body>
<header class="site">
    <div class="container">
        <a class="brand" href="{{ route('books.index') }}">📚 Rak Buku Digital</a>
        <nav class="nav">
            @auth
                <span class="who">Halo, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn secondary">Keluar</button>
                </form>
            @else
                <a class="btn secondary" href="{{ route('login') }}">Masuk</a>
                <a class="btn" href="{{ route('register') }}">Daftar</a>
            @endauth
        </nav>
    </div>
</header>

<main class="container">
    @if (session('success'))
        <div class="alert success" role="status">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert error" role="alert">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>
</body>
</html>
