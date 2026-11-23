@if ($book->cover_url)
    <div class="cover" style="position:relative;padding:0;overflow:hidden;background:{{ $book->cover_color }}">
        <img src="{{ $book->cover_url }}" alt="Sampul buku {{ $book->title }}" loading="lazy"
             style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block">
    </div>
@else
    <div class="cover" style="background: {{ $book->cover_color }}">
        <span class="cover-cat">{{ $book->category }}</span>
        <span class="cover-title">{{ $book->title }}</span>
    </div>
@endif
