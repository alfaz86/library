<?php

namespace Modules\Book\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Book\Models\Book;

class BookDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'isbn' => '9789793062792',
                'publisher' => 'Bentang Pustaka',
                'published_year' => 2005,
                'category' => 'Fiksi',
                'language' => 'Indonesia',
                'pages' => 529,
                'shelf_location' => 'A1-01',
                'stock' => 10,
                'available' => 10,
                'description' => 'Kisah anak-anak di Belitung yang berjuang menempuh pendidikan.',
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'isbn' => '9780735211292',
                'publisher' => 'Avery',
                'published_year' => 2018,
                'category' => 'Pengembangan Diri',
                'language' => 'Inggris',
                'pages' => 320,
                'shelf_location' => 'B2-03',
                'stock' => 5,
                'available' => 5,
                'description' => 'Panduan mengubah kebiasaan buruk dan membentuk kebiasaan baik.',
            ],
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'isbn' => '9780743273565',
                'publisher' => 'Scribner',
                'published_year' => 1925,
                'category' => 'Fiksi',
                'language' => 'Inggris',
                'pages' => 180,
                'shelf_location' => 'C3-02',
                'stock' => 7,
                'available' => 7,
                'description' => 'Novel tentang kehidupan orang kaya di Amerika pada tahun 1920-an.',
            ],
            [
                'title' => 'Belajar PHP untuk Pemula',
                'author' => 'John Doe',
                'isbn' => '9781234567890',
                'publisher' => 'Tech Books',
                'published_year' => 2020,
                'category' => 'Teknologi',
                'language' => 'Indonesia',
                'pages' => 250,
                'shelf_location' => 'D4-05',
                'stock' => 15,
                'available' => 15,
                'description' => 'Buku ini adalah panduan lengkap untuk belajar PHP dari nol.',
            ],
            [
                'title' => 'JavaScript: The Good Parts',
                'author' => 'Douglas Crockford',
                'isbn' => '9780596805524',
                'publisher' => 'O\'Reilly Media',
                'published_year' => 2008,
                'category' => 'Teknologi',
                'language' => 'Inggris',
                'pages' => 176,
                'shelf_location' => 'E5-07',
                'stock' => 8,
                'available' => 8,
                'description' => 'Buku ini membahas fitur-fitur terbaik dari JavaScript.',
            ],
            [
                'title' => 'Pendidikan Karakter',
                'author' => 'Muhammad Ali',
                'isbn' => '9781234567891',
                'publisher' => 'Pustaka Pelajar',
                'published_year' => 2019,
                'category' => 'Pendidikan',
                'language' => 'Indonesia',
                'pages' => 300,
                'shelf_location' => 'F6-09',
                'stock' => 12,
                'available' => 12,
                'description' => 'Buku ini membahas pentingnya pendidikan karakter dalam pembelajaran.',
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '9780132350884',
                'publisher' => 'Prentice Hall',
                'published_year' => 2008,
                'category' => 'Teknologi',
                'language' => 'Inggris',
                'pages' => 464,
                'shelf_location' => 'G7-11',
                'stock' => 6,
                'available' => 6,
                'description' => 'Buku ini membahas prinsip-prinsip menulis kode yang bersih dan mudah dipahami.',
            ],
        ];

        foreach ($books as $bookData) {
            Book::createOrFirst(
                ['isbn' => $bookData['isbn']],
                $bookData
            );
        }
    }
}
