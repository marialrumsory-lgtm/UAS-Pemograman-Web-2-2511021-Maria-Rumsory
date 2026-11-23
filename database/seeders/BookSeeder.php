<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['Laskar Pelangi', 'Andrea Hirata', 'Novel', 2005, 'Kisah sepuluh anak di Belitung yang belajar dengan segala keterbatasan di sekolah sederhana mereka.'],
            ['Bumi Manusia', 'Pramoedya Ananta Toer', 'Novel', 1980, 'Perjalanan Minke pada masa kolonial yang bersinggungan dengan cinta, keadilan, dan kebangkitan bangsa.'],
            ['Dunia Sophie', 'Jostein Gaarder', 'Novel', 1991, 'Novel yang memperkenalkan sejarah filsafat melalui surat-surat misterius yang diterima seorang remaja.'],
            ['Atomic Habits', 'James Clear', 'Pengembangan Diri', 2018, 'Cara membangun kebiasaan baik dan meninggalkan kebiasaan buruk lewat perubahan kecil yang konsisten.'],
            ['Filosofi Teras', 'Henry Manampiring', 'Pengembangan Diri', 2018, 'Pengantar Stoisisme untuk menghadapi emosi negatif dan hidup lebih tenang.'],
            ['Clean Code', 'Robert C. Martin', 'Teknologi', 2008, 'Prinsip dan praktik menulis kode yang bersih, mudah dibaca, dan mudah dirawat.'],
            ['The Pragmatic Programmer', 'Andrew Hunt, David Thomas', 'Teknologi', 1999, 'Kumpulan kiat praktis untuk menjadi pemrogram yang efektif dan adaptif.'],
            ['Sapiens', 'Yuval Noah Harari', 'Sejarah', 2011, 'Ringkasan sejarah umat manusia dari masa berburu dan meramu hingga era modern.'],
        ];

        foreach ($books as [$title, $author, $category, $year, $synopsis]) {
            Book::updateOrCreate(
                ['title' => $title, 'author' => $author],
                ['category' => $category, 'year' => $year, 'synopsis' => $synopsis]
            );
        }
    }
}
