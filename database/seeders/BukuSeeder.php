<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BukuSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        /* Buku::create([
            'isbn' => '1234567890123',
            'sampul' => 'https://example.com/sampul.jpg',
            'judul' => 'tes',    
            'kategori' => 'horror10',    
            'penulis' => 'tes',
            'penerbit' => 'tes',
            'deskripsi' => 'tes',
            'tahun_terbit' => '2023',
            'jumlah_tersedia' => 10
        ]);
        Buku::create([
            'isbn' => '1234567890124',
            'sampul' => 'https://example.com/sampul.jpg',
            'judul' => 'tes',    
            'kategori' => 'horror10',    
            'penulis' => 'tes',
            'penerbit' => 'tes',
            'deskripsi' => 'tes',
            'tahun_terbit' => '2023',
            'jumlah_tersedia' => 10
        ]);
        Buku::create([
            'isbn' => '1234567890125',
            'sampul' => 'https://example.com/sampul.jpg',
            'judul' => 'tes',    
            'kategori' => 'horror10',    
            'penulis' => 'tes',
            'penerbit' => 'tes',
            'deskripsi' => 'tes',
            'tahun_terbit' => '2023',
            'jumlah_tersedia' => 10
        ]); */

        Buku::create([
            'isbn' => '1234567891322',
            'sampul' => 'image/100dongeng.png',
            'judul' => '100 Dongeng Anak Lengkap',
            'kategori' => 'Bebas',
            'penulis' => 'Raihan Abdillah',
            'penerbit' => 'Folklore Inc',
            'deskripsi' => 'Kumpulan dongeng dongeng anak indonesia dengan gambar yang menarik.',
            'tahun_terbit' => '2020',
            'jumlah_tersedia' => '5'
        ]);

        Buku::create([
            'isbn' => '123456321124',
            'sampul' => 'image/biologi-ketut.png',
            'judul' => 'Biologi Kelas XI MA',
            'kategori' => 'Buku Pelajaran',
            'penulis' => 'Ketutu Susilo',
            'penerbit' => 'Gramedia',
            'deskripsi' => 'Buku pembelajaran biologi untuk kelas XI tingkat Madrasah Aliyah.',
            'tahun_terbit' => '2021',
            'jumlah_tersedia' => '15'
        ]);

        Buku::create([
            'isbn' => '9793062797',
            'sampul' => 'image/cara_membangu_umkm.png',
            'judul' => 'Cara Membangun UMKM',
            'kategori' => 'Buku Pelajaran',
            'penulis' => 'Alfredo Torres',
            'penerbit' => 'Alfredo Inc',
            'deskripsi' => 'Buku pembelajaran ekonomi untuk Usaha UMKM di indonesia, ditulis oleh pengusaha top dari indonesia .',
            'tahun_terbit' => '2019',
            'jumlah_tersedia' => '3'
        ]);

        Buku::create([
            'isbn' => '97930312568',
            'sampul' => 'image/fisika.png',
            'judul' => 'Fisika Kelas IX MTs',
            'kategori' => 'Buku Pelajaran',
            'penulis' => 'Aiman Fathur',
            'penerbit' => 'Gramedia',
            'deskripsi' => 'Buku pembelajaran biologi untuk kelas XI tingkat Madrasah Tsanawiyah.',
            'tahun_terbit' => '2021',
            'jumlah_tersedia' => '15'
        ]);

        Buku::create([
            'isbn' => '6327632538',
            'sampul' => 'image/funicula.png',
            'judul' => 'Funiculi Funicula',
            'kategori' => 'Novel',
            'penulis' => 'Toshikazu Kawaguchi',
            'penerbit' => 'Gramedia',
            'deskripsi' => 'Funiculi Funicula adalah sebuah novel karangan Toshikazu Kawaguchi yang terbit pada tahun 2015. Novel ini menceritakan sebuah kafe di Tokyo yang memungkinkan pelanggannya melakukan perjalanan kembali ke masa lalu, selama mereka kembali sebelum kopi mereka menjadi dingin.',
            'tahun_terbit' => '2015',
            'jumlah_tersedia' => '1'
        ]);

        Buku::create([
            'isbn' => '793256238',
            'sampul' => 'image/gadis_kretek.png',
            'judul' => 'Gadis Kretek',
            'kategori' => 'Novel',
            'penulis' => 'Ratih Kumala',
            'penerbit' => 'Gramedia',
            'deskripsi' => 'Gadis Kretek adalah sebuah novel karangan Ratih Kumala yang diterbitkan pada tahun 2012 oleh Gramedia Pustaka Utama. Novel ini masuk dalam sepuluh besar penerima penghargaan Kusala Sastra Khatulistiwa tahun 2012.',
            'tahun_terbit' => '2012',
            'jumlah_tersedia' => '3'
        ]);

        Buku::create([
            'isbn' => '924617123',
            'sampul' => 'image/hello.png',
            'judul' => 'Hello',
            'kategori' => 'Novel',
            'penulis' => 'Tere Liye',
            'penerbit' => 'Gramedia',
            'deskripsi' => 'Hello.Apakah kamu di sana?Aku tahu kamu di sana.Aku tahu kamu mendengarkan suaraku.Hello.Aku tahu kita belum bisa bicara. Tapi aku tidak bisa menahan diriku untuk meneleponmu. Aku hanya hendak bilang, aku tidak akan menyerah. Aku akan selalu menyayangimu.',
            'tahun_terbit' => '2023',
            'jumlah_tersedia' => '2'
        ]);

        Buku::create([
            'isbn' => '5412148124',
            'sampul' => 'image/laskar_pelangi.png',
            'judul' => 'Laskar Pelangi',
            'kategori' => 'Novel',
            'penulis' => 'Andrea Hirata',
            'penerbit' => 'Bentang Pustaka',
            'deskripsi' => 'Laskar Pelangi adalah novel pertama karya Andrea Hirata yang diterbitkan oleh Bentang Pustaka pada tahun 2005. Novel ini bercerita tentang kehidupan 10 anak dari keluarga miskin yang bersekolah di sebuah sekolah Muhammadiyah di Pulau Belitung yang penuh dengan keterbatasan.',
            'tahun_terbit' => '2005',
            'jumlah_tersedia' => '5'
        ]);

        Buku::create([
            'isbn' => '9786024246945',
            'sampul' => 'image/laut_bercerita.png',
            'judul' => 'Laut Bercerita',
            'kategori' => 'Novel',
            'penulis' => 'Leila Salikha Chudori',
            'penerbit' => 'Gramedia',
            'deskripsi' => 'Laut Bercerita adalah novel karya Leila S. Chudori yang diterbitkan oleh Kepustakaan Populer Gramedia Jakarta pada tahun 2017. Novel ini berkisah tentang persahabatan, cinta, keluarga, dan kehilangan para tokoh-tokohnya.',
            'tahun_terbit' => '2017',
            'jumlah_tersedia' => '3'
        ]);

        Buku::create([
            'isbn' => '10002223456',
            'sampul' => 'image/matematika-cahaya_dewi.png',
            'judul' => 'Matematika Kelas IX MA',
            'kategori' => 'Buku Pelajaran',
            'penulis' => 'Cahaya Dewi',
            'penerbit' => 'Rimbero',
            'deskripsi' => 'Modul pembelajaran matematika untuk kelas IX MA',
            'tahun_terbit' => '2020',
            'jumlah_tersedia' => '30'
        ]);

        Buku::create([
            'isbn' => '200000223456',
            'sampul' => 'image/matematika-dewi.png',
            'judul' => 'Matematika Kelas VII MTs',
            'kategori' => 'Buku Pelajaran',
            'penulis' => 'Cahaya Dewi',
            'penerbit' => 'Rimbero',
            'deskripsi' => 'Modul pembelajaran matematika untuk kelas VII MTs',
            'tahun_terbit' => '2020',
            'jumlah_tersedia' => '30'
        ]);

        Buku::create([
            'isbn' => '30002223456',
            'sampul' => 'image/matematika-rimbero.png',
            'judul' => 'Matematika Kelas V SD',
            'kategori' => 'Buku Pelajaran',
            'penulis' => 'Cahaya Dewi',
            'penerbit' => 'Rimbero',
            'deskripsi' => 'Modul pembelajaran matematika untuk kelas V SD',
            'tahun_terbit' => '2020',
            'jumlah_tersedia' => '30'
        ]);
        
        Buku::create([
            'isbn' => '6121421812',
            'sampul' => 'image/menjadi_pengusaha_muda.png',
            'judul' => 'Menjadi Pengusaha Muda',
            'kategori' => 'Motivasi',
            'penulis' => 'Tim',
            'penerbit' => 'Timmerman Industries',
            'deskripsi' => 'Mengubah impian menjadi kenyataan panduan bagi para pengusaha muda untuk menjadi pengusaha sukses.',
            'tahun_terbit' => '2017',
            'jumlah_tersedia' => '5'
        ]);

        Buku::create([
            'isbn' => '78149122',
            'sampul' => 'image/pancasila.png',
            'judul' => 'Pendidikan Pancasila',
            'kategori' => 'Buku Pelajaran',
            'penulis' => 'Kemendikbud',
            'penerbit' => 'Kurikulum merdeka',
            'deskripsi' => 'Modul ajar untuk kelas Pendidikan Pancasila.',
            'tahun_terbit' => '2022',
            'jumlah_tersedia' => '10'
        ]);

        Buku::create([
            'isbn' => '781246912',
            'sampul' => 'image/pjok-ketut_susilo.png',
            'judul' => 'Pendidikan Jasmani Olahraga Kesehatan',
            'kategori' => 'Buku Pelajaran',
            'penulis' => 'Ketut Susilo',
            'penerbit' => 'Kurikulum merdeka',
            'deskripsi' => 'Modul ajar untuk kelas Pendidikan Jasmani Olahraga Kesehatan tingkat SD.',
            'tahun_terbit' => '2022',
            'jumlah_tersedia' => '10'
        ]);

        Buku::create([
            'isbn' => '781246917',
            'sampul' => 'image/pjok-ketut-mts.png',
            'judul' => 'Pendidikan Jasmani Olahraga Kesehatan',
            'kategori' => 'Buku Pelajaran',
            'penulis' => 'Ketut Susilo',
            'penerbit' => 'Kurikulum merdeka',
            'deskripsi' => 'Modul ajar untuk kelas Pendidikan Jasmani Olahraga Kesehatan tingkat MTs.',
            'tahun_terbit' => '2022',
            'jumlah_tersedia' => '10'
        ]);

        Buku::create([
            'isbn' => '69143012',
            'sampul' => 'image/pulang_pergi.png',
            'judul' => 'Pulang Pergi',
            'kategori' => 'Novel',
            'penulis' => 'Tere Liye',
            'penerbit' => 'Gramedia',
            'deskripsi' => 'Ada jodoh yang ditemukan lewat tatapan pertama. Ada persahabatan yang diawali lewat sapa hangat. Bagaimana jika takdir bersama ternyata, diawali dengan pertarungan mematikan? Lantas semua cerita berkelindan dengan, pengejaran demi pengejaran mencari jawaban? Pulang-Pergi.',
            'tahun_terbit' => '2024',
            'jumlah_tersedia' => '3'
        ]);

        Buku::create([
            'isbn' => '798134712',
            'sampul' => 'image/SBK-Fauget.png',
            'judul' => 'Seni Budaya dan Keterampilan',
            'kategori' => 'Buku Pelajaran',
            'penulis' => 'Septiawan',
            'penerbit' => 'Fauget',
            'deskripsi' => 'Bahan ajar untuk kelas Seni Budaya dan Keterampilan kelas X MA.',
            'tahun_terbit' => '2021',
            'jumlah_tersedia' => '15'
        ]);

        Buku::create([
            'isbn' => '68123322',
            'sampul' => 'image/Seni_tari-cahaya_dewi.png',
            'judul' => 'Pendidikan Seni Tari Tradisional',
            'kategori' => 'Buku Pelajaran',
            'penulis' => 'Cahaya Dewi',
            'penerbit' => 'Kurikulum merdeka',
            'deskripsi' => 'Bahan ajar untuk kelas Pendidikan Seni Tari Tradisional kelas XI MA.',
            'tahun_terbit' => '2021',
            'jumlah_tersedia' => '13'
        ]);
    }
}