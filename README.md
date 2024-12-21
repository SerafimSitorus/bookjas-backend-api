# Bookjas API

API ini dibuar untuk mendukung pengembangan aplikasi mobile untuk memanajemen fungsi fungsi yang ada di perpustakaan, seperti kelola peminjaman, kelola buku dan kelola user, untuk mendukung kinerja dari sebuah perpustakaan. secara lokal dengan database mysql.
## Key Features:
- Kelola Buku: Membuat, Mengedit dan Menghapus buku di perpustakaan.
- Kelola Peminjaman: Membuat peminjaman dan mengembalikan peminjaman sesuai dengan user dan buku yang dipinjam.
- Kelola Kategori: Membuat, Mengedit dan Menghapus Kategori yang ada di buku.
- Kelola User: Mengelola profile, password dan akun user secara keseluruhan.
API ini memastikan pengelolaan data dnegan token-based authentication dan mendukung integrasi yang lancar ke aplikasi mobile.
## URL Based
https://youripconfig/api/
## API Docs (Open API)
TBA
## Technologies Used
API ini dibuat menggunakan alat dan framework berikut:
- Laravel.
- MySQL

Additional Libraries:
- Carbon: A PHP library for date and time manipulation.

# Instalasi Dan Konfigurasi
 - ## Instalasi
   - #### Lakukan Clone pada Github Repositori ini
        - Klik tombol "Code" (berwarna hijau) untuk mendapatkan URL repository. Jika menggunakan HTTPS, salin URL tersebut. Jika menggunakan SSH, klik ikon SSH dan salin URL SSH.
        - Buka terminal, command prompt atau Git Bash(rekomendasi) di komputer Anda.
        - Pindah ke direktori di mana Anda ingin menyimpan salinan lokal repository. Gunakan perintah cd untuk berpindah ke direktori tersebut.
          #### Contoh:
              cd path/ke/direktori/tujuan
        - Gunakan perintah git clone dengan menyertakan URL repository yang telah Anda salin sebelumnya.
          #### Contoh untuk HTTPS:
              git clone https://github.com/nama-akun/nama-repo.git
          #### Atau untuk SSH:
              git clone git@github.com:nama-akun/nama-repo.git
   - #### Jalankan Di Code Editor
       - Buka Terminal di direktori penyimpanan project.
   - #### Install Dependensi
     #### - Jalankan perintah berikut:
         composer install
     #### - Selanjutnya, jalankan perintah berikut:
         npm install
   - #### Buat Salinan File Konfigurasi
     - Salin file `.env.example` dan beri nama baru menjadi `.env`
       #### Jalankan Perintah Berikut:
           cp .env.example .env
   - #### Konfigurasi file `.env`
     - Buka file `.env` dan konfigurasi pengaturan database, koneksi email, dan login google.
       ### Pengaturan database dan url
             APP_URL=http://{IP dari ipconfig kamu di device}:8000            

             DB_HOST=127.0.0.1
             DB_PORT=3306
             DB_DATABASE=bookjas
             DB_USERNAME=root
             DB_PASSWORD=   
         
   - #### Generate Application Key
     #### Jalankan perintah berikut di terminal:
         php artisan key:generate
   - #### Jalankan Migrasi dan Seeder
     Jalankan perintah migrasi untuk membuat struktur table
     #### jalankan perintah berikut:
         php artisan migrate
     Jalankan perintah seeder untuk mengisi data pada table dengan data dummy
     #### jalankan perintah berikut:
         php artisan db:seed
   - #### Jalankan Server Lokal
     #### jalankan perintah berikut:
         php artisan serve
     #### lalu
         php artisan storage:link
   - #### API dapat digunakan
      API sudah dapat digunakan dengan format endpoint `http://{IPconfig_kamu}:8000/api/`.

     #### NB:
         Atur ip di aplikasi mobile kamu sama dengan ip di sini
