<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'category', 'year', 'synopsis', 'cover'];

    /** Kategori beserta warna sampul cadangan (dipakai jika belum ada gambar). */
    public const CATEGORIES = [
        'Novel'             => '#7b1e3a', // merah marun
        'Pengembangan Diri' => '#2e7d4f', // hijau
        'Teknologi'         => '#1f3b73', // biru tua
        'Sejarah'           => '#7a4a21', // cokelat
    ];

    public function getCoverColorAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? '#555555';
    }

    /** URL gambar sampul, atau null jika belum diunggah. */
    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover ? Storage::disk('public')->url($this->cover) : null;
    }
}
