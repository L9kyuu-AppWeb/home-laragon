# Laragon Hub &mdash; Modern Development Cockpit

Laragon Hub adalah antarmuka dashboard kustom modern berbasis web yang dirancang untuk mengelola, membuka, dan membagikan proyek-proyek lokal yang berada di dalam lingkungan server **Laragon** (`C:\laragon\www`). 

Dashboard ini merombak tampilan bawaan Laragon menjadi lebih intuitif dengan arsitektur **asynchronous (AJAX)**, sehingga eksekusi perkakas pengembangan tidak memicu pemuatan ulang halaman (*page refresh*).

---

## ✨ Fitur Utama

*   **Workspace Grid System:** Mengotomatisasi pemindaian direktori proyek dan menampilkannya dalam bentuk sistem kartu grid yang bersih dan responsif menggunakan Tailwind CSS.
*   **Asynchronous VS Code Launcher:** Membuka folder proyek pilihan langsung ke VS Code (`code`) via latar belakang menggunakan AJAX `fetch()`. Tidak mereset status pencarian atau posisi halaman.
*   **Dynamic Virtual Host Shortcut:** Menyediakan akses instan dua arah melalui alamat `localhost` standar maupun format *Dynamic Virtual Host* khas Laragon (`http://nama-project.test`).
*   **Live Search Filter:** Menyaring daftar proyek secara *real-time* berdasarkan input teks tanpa *delay* server.
*   **Tunneling Ngrok Integration:** Berbagi proyek lokal ke internet secara instan menggunakan integrasi Ngrok terotomatisasi. Cukup masukkan URL Ngrok aktif sekali, dan buka jalur *tunnel* untuk proyek apa pun dari dashboard.
*   **Embedded PHP Info Modal:** Memeriksa detail runtime ekosistem PHP (`phpinfo()`) langsung di dalam jendela pop-up/modal asinkron tanpa berpindah halaman.
*   **IP Shield Security Guard:** Keamanan terintegrasi yang membatasi akses dashboard hanya untuk lingkup mesin lokal (`127.0.0.1`, `::1`) dan jaringan privat (LAN). Akses luar akan otomatis dialihkan.

---

## 🚀 Prasyarat Sistem

Sebelum memasang, pastikan komponen berikut telah terkonfigurasi di sistem operasi Windows Anda:

1.  **Laragon Server** terpasang aktif di direktori default (`C:\laragon`).
2.  **VS Code CLI (`code`)** sudah terdaftar di dalam Environment PATH Windows Anda.
    *   *Cara tes:* Buka CMD, ketik `code .`. Jika VS Code terbuka, fitur launcher dipastikan bekerja.
3.  **Ngrok CLI** terpasang jika Anda ingin menggunakan fitur *Tunneling/Share*.

---

## 📦 Cara Pemasangan

1.  Masuk ke direktori web root Laragon Anda di:
```bash
    C:\laragon\www
    ```
2.  Cadangkan atau ubah nama file `index.php` bawaan Laragon Anda jika diperlukan (misal: `index.old.php`).
3.  Buat file `index.php` baru di dalam folder tersebut dan tempelkan (*paste*) seluruh kode dashboard Laragon Hub yang baru.
4.  Buka browser Anda dan akses halaman seperti biasa melalui:
```text
    http://localhost
    ```

---

## 🛠️ Struktur Logika Kode

*   **Proteksi Jaringan (`getRealUserIP`)**: Memvalidasi IP klien melalui kecocokan bendera internal PHP `FILTER_FLAG_NO_PRIV_RANGE`.
*   **API Endpoint Lokal**: Menangani request POST dari JavaScript untuk parameter `open_code` (Buka VS Code) dan `share_project` (Eksekusi Terminal Ngrok).
*   **Asynchronous Process (`pclose(popen(...))`)**: Mengeksekusi instruksi CMD Windows secara *background asynchronous*, mencegah PHP mengalami *hang* atau *timeout* saat aplikasi eksternal sedang berjalan.

---

## 📝 Catatan Keamanan

> [!WARNING]
> Dashboard ini menggunakan fungsi eksekusi sistem `popen()` untuk mengontrol sistem operasi lokal Anda demi fungsionalitas *shortcut*. Jangan pernah mematikan atau memodifikasi blok kode pembatasan `$allowed_ips` di bagian awal script apabila server lokal Anda terhubung langsung dengan alamat IP publik internet terbuka.