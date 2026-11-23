@php($book = $book ?? null)

<div class="field">
    <label for="title">Judul</label>
    <input id="title" type="text" name="title" value="{{ old('title', $book->title ?? '') }}" maxlength="80">
    @error('title') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="author">Penulis</label>
    <input id="author" type="text" name="author" value="{{ old('author', $book->author ?? '') }}" maxlength="60">
    @error('author') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="category">Kategori</label>
    <select id="category" name="category">
        <option value="">— Pilih kategori —</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat }}" @selected(old('category', $book->category ?? '') === $cat)>{{ $cat }}</option>
        @endforeach
    </select>
    @error('category') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="year">Tahun terbit</label>
    <input id="year" type="number" name="year" value="{{ old('year', $book->year ?? '') }}" min="1000" max="2100">
    @error('year') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="synopsis">Sinopsis (opsional)</label>
    <textarea id="synopsis" name="synopsis" maxlength="240">{{ old('synopsis', $book->synopsis ?? '') }}</textarea>
    <div class="hint">Maksimal 240 karakter.</div>
    @error('synopsis') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="cover">Gambar sampul (opsional)</label>

    @if ($book && $book->cover_url)
        <div style="max-width:140px;margin-bottom:8px">
            @include('books._cover', ['book' => $book])
        </div>
        <div class="check" style="margin-bottom:8px">
            <input id="remove_cover" type="checkbox" name="remove_cover" value="1" @checked(old('remove_cover'))>
            <label for="remove_cover" style="margin:0;font-weight:400">Hapus sampul saat ini</label>
        </div>
    @endif

    <input id="cover" type="file" name="cover" accept="image/png,image/jpeg,image/webp">
    <div class="hint">Format JPG, PNG, atau WEBP, maksimal 2 MB. Jika kosong, sampul memakai warna kategori.</div>
    @error('cover') <div class="err">{{ $message }}</div> @enderror

    <img id="cover-preview" alt="Pratinjau sampul baru" hidden
         style="max-width:140px;margin-top:8px;border-radius:8px;border:1px solid var(--border)">
</div>

<script>
    document.getElementById('cover').addEventListener('change', function () {
        var preview = document.getElementById('cover-preview');
        var file = this.files && this.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.hidden = false;
        } else {
            preview.hidden = true;
        }
    });
</script>
