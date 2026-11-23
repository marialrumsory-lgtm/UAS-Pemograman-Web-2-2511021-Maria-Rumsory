<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    private const SORTS = [
        'title'  => ['label' => 'Judul (A-Z)',     'col' => 'title',  'dir' => 'asc'],
        'author' => ['label' => 'Penulis (A-Z)',   'col' => 'author', 'dir' => 'asc'],
        'newest' => ['label' => 'Tahun terbaru',   'col' => 'year',   'dir' => 'desc'],
        'oldest' => ['label' => 'Tahun terlama',   'col' => 'year',   'dir' => 'asc'],
    ];

    public function index(Request $request)
    {
        $q        = trim((string) $request->query('q', ''));
        $category = (string) $request->query('category', '');
        $sort     = (string) $request->query('sort', 'title');

        if (!isset(self::SORTS[$sort])) {
            $sort = 'title';
        }
        if (!array_key_exists($category, Book::CATEGORIES)) {
            $category = '';
        }

        $query = Book::query();

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('title', 'like', "%{$q}%")
                  ->orWhere('author', 'like', "%{$q}%");
            });
        }
        if ($category !== '') {
            $query->where('category', $category);
        }

        $books = $query->orderBy(self::SORTS[$sort]['col'], self::SORTS[$sort]['dir'])
                       ->orderBy('id')
                       ->get();

        return view('books.index', [
            'books'      => $books,
            'total'      => Book::count(),
            'q'          => $q,
            'category'   => $category,
            'sort'       => $sort,
            'sorts'      => self::SORTS,
            'categories' => array_keys(Book::CATEGORIES),
        ]);
    }

    public function create()
    {
        return view('books.create', ['categories' => array_keys(Book::CATEGORIES)]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules(), $this->messages(), $this->attributes());

        $data = collect($validated)->except(['cover', 'remove_cover'])->all();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', [
            'book'       => $book,
            'categories' => array_keys(Book::CATEGORIES),
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate($this->rules(), $this->messages(), $this->attributes());

        $data = collect($validated)->except(['cover', 'remove_cover'])->all();

        if ($request->hasFile('cover')) {
            $this->deleteCover($book);
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        } elseif ($request->boolean('remove_cover')) {
            $this->deleteCover($book);
            $data['cover'] = null;
        }

        $book->update($data);

        return redirect()->route('books.show', $book)->with('success', 'Data buku berhasil diubah.');
    }

    public function destroy(Book $book)
    {
        $this->deleteCover($book);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    private function deleteCover(Book $book): void
    {
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
    }

    private function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:80'],
            'author'       => ['required', 'string', 'max:60'],
            'category'     => ['required', Rule::in(array_keys(Book::CATEGORIES))],
            'year'         => ['required', 'integer', 'between:1000,2100'],
            'synopsis'     => ['nullable', 'string', 'max:240'],
            'cover'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_cover' => ['nullable', 'boolean'],
        ];
    }

    private function messages(): array
    {
        return [
            'required'     => ':attribute wajib diisi.',
            'max'          => ':attribute maksimal :max karakter.',
            'integer'      => ':attribute harus berupa bilangan bulat.',
            'year.between' => 'Tahun terbit harus antara 1000 dan 2100.',
            'category.in'  => 'Pilih salah satu kategori yang tersedia.',
            'cover.image'  => 'Sampul harus berupa gambar.',
            'cover.mimes'  => 'Sampul harus berformat JPG, PNG, atau WEBP.',
            'cover.max'    => 'Ukuran sampul maksimal 2 MB.',
            'cover.uploaded' => 'Sampul gagal diunggah. Coba gambar dengan ukuran lebih kecil.',
        ];
    }

    private function attributes(): array
    {
        return [
            'title'    => 'Judul',
            'author'   => 'Penulis',
            'category' => 'Kategori',
            'year'     => 'Tahun terbit',
            'synopsis' => 'Sinopsis',
            'cover'    => 'Sampul',
        ];
    }
}
