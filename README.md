#  Peminjaman Ruang Sidang Informatika UNTAN - Kelompok 4 Kelas A 


**Peminjaman Ruang Sidang Informatika UNTAN** adalah sebuah sistem peminjaman berbasis website yang dirancang untuk mengelola dan memfasilitasi peminjaman ruangan di Prodi Informatika Universitas Tanjungpura. Proyek ini dikembangkan oleh Kelompok 4 Kelas A.

##  Daftar Isi 📜

-   [Ringkasan Proyek](#ringkasan-proyek)
-   [Fitur Unggulan](#fitur-unggulan-✨)
-   [Teknologi yang Digunakan](#teknologi-yang-digunakan-💻)
-   [Instalasi](#instalasi-⚙️)
-   [Cara Penggunaan](#cara-penggunaan-🚀)
-   [Tangkapan Layar](#tangkapan-layar-📸) 
-   [Kontributor](#kontributor-👥)


## Ringkasan Proyek 📝

Aplikasi Peminjaman Ruang Sidang Informatika UNTAN adalah sistem berbasis web yang memudahkan mahasiswa dan admin dalam mengelola peminjaman ruang sidang. Proyek ini dikembangkan menggunakan framework Laravel dan menyediakan fitur pemesanan ruangan, manajemen status ruangan, serta pelaporan statistik peminjaman.

## Fitur Unggulan ✨

(Perkakas AI seringkali dapat menyimpulkan beberapa fitur dengan menganalisis struktur kode, misal: mengidentifikasi modul untuk 'autentikasi pengguna', 'manajemen ruangan', 'pembuatan pemesanan'. Anda perlu menyempurnakan daftar ini.)

-   **Autentikasi Pengguna:** Mendukung login, registrasi, dan manajemen profil untuk mahasiswa dan admin.
-   **Peminjaman Ruangan:** Mahasiswa dapat melakukan pemesanan ruangan berdasarkan sesi waktu (pagi, siang, sore).
-   **Manajemen Ruangan:** Admin dapat menambah, mengedit, dan menghapus data ruangan serta mengatur status ketersediaan ruangan.
-   **Riwayat & Detail Peminjaman:** Pengguna dapat melihat riwayat peminjaman dan detail setiap peminjaman yang telah diajukan.
-   **Statistik & Dashboard:** Menampilkan statistik peminjaman, ruangan paling sering dipinjam, dan grafik laporan.


## Teknologi yang Digunakan 💻

-   **Backend:** Laravel (PHP)
-   **Frontend:** Bootstrap
-   **Database:** MySQL


## Instalasi ⚙️

(Perkakas AI dapat membantu menghasilkan langkah-langkah ini, terutama jika proyek Anda mengikuti konvensi standar untuk kerangka kerjanya. Anda perlu memverifikasi dan melengkapinya.)

1.  **Gandakan (Clone) repositori:**
    ```bash
    git clone [https://github.com/haikalashari/PeminjamanRuangan-Kelompok4-KelasA.git](https://github.com/haikalashari/PeminjamanRuangan-Kelompok4-KelasA.git)
    cd PeminjamanRuangan-Kelompok4-KelasA
    cd code
    ```
2.  **Instal dependensi PHP:**
    ```bash
    composer install
    ```
3.  **Instal dependensi frontend JavaScript:**
    ```bash
    npm install
    # atau
    yarn install
    ```
4.  **Atur variabel lingkungan (environment variables):**
    Salin file contoh lingkungan (misal: `.env.example` menjadi `.env`) dan perbarui dengan kredensial basis data Anda serta konfigurasi lain yang diperlukan.
    ```bash
    cp .env.example .env
    ```
    Kemudian, edit file `.env` dengan detail Anda.
5.  **Buat kunci aplikasi:**
    ```bash
    php artisan key:generate
    ```
6.  **Jalankan migrasi basis data dan seeder:**
    ```bash
    php artisan migrate --seed
    ```
7.  **Jalankan aplikasi:**
    ```bash
    php artisan serve
    ```
    Kemudian, akses aplikasi di `http://localhost:PORT` (misal: `http://localhost:8000` atau `http://localhost:3000`).

## Cara Penggunaan 🚀

-   **Mengakses aplikasi:** Buka peramban web Anda dan kunjungi `http://localhost:[PORT]`.
-   **Login Admin:** Login sebagai admin, kelola data ruangan, pantau status ruangan, dan lihat statistik peminjaman di dashboard. untuk login admin default maka [admin1@gmail.com/password]
-   **Login Mahasiswa:** Login, pilih sesi dan tanggal, pilih ruangan yang tersedia, isi tujuan, dan lakukan peminjaman. untuk login mahasiswa default maka [budi@gmail.com/password]

* *Halaman Login*
    ![image](https://github.com/user-attachments/assets/3fc6bf99-fb5c-4abf-993e-1c8a4f275bb3)

* *Halaman Awal Mahasiswa*
    ![image](https://github.com/user-attachments/assets/20587b2f-f2e8-4566-8ff5-2f97ee1f7d6e)

* *Formulir Pemesanan*
    ![image](https://github.com/user-attachments/assets/7ac2075c-09dc-4b2a-901f-affb2751e0e3)
    ![image](https://github.com/user-attachments/assets/c788ced1-bedc-4c2e-b3a4-0e66191bd754)
    
* *Tampilan Riwayat Pemesanan dari User yang Digunakan*
    ![image](https://github.com/user-attachments/assets/31efe1ea-f47d-4dcb-b0cf-70057d9d6351)

* *Halaman Dashboard Admin*
    ![image](https://github.com/user-attachments/assets/6a0cae3f-b856-445e-b842-3cc2f8018cd1)

## Kontributor 👥

-   [Fikri Al Jauzi](https://github.com/Vendot)
-   [Muhammad Haikal Ashari](https://github.com/haikalashari)
-   [Khairul Fadhil](https://github.com/khairull12)
-   [Muhammad Fadhil](https://github.com/muhammadfadhil16)
-   [Muhammad Nazwan Fadhila](https://github.com/nazwan74)

