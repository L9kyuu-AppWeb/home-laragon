# Laragon Hub

> Dashboard modern untuk mengelola workspace Laragon Anda.

![Hero Screenshot](assets/hero.png)
*Placeholder: Tampilan utama Laragon Hub dengan grid proyek dan toolbar*

[🔗 Demo Live](#) &nbsp;|&nbsp; [📖 Dokumentasi](#instalasi) &nbsp;|&nbsp; [✉️ Hubungi](#kontak) &nbsp;|&nbsp; [GitHub](#)

---

## Tentang Laragon Hub

Laragon Hub lahir dari satu kenyataan sederhana: halaman default Laragon hanya menampilkan daftar folder mentah yang tidak informatif. Setiap kali ingin membuka proyek, developer harus mengetik manual URL di browser, membuka folder satu per satu di Explorer, atau merepotkan diri dengan CMD untuk hal-hal sepele.

Laragon Hub hadir sebagai antarmuka dashboard modern yang menggantikan index Laragon bawaan. Cukup satu halaman — semua proyek terlihat, semua aksi tersedia dalam satu klik.

**Masalah yang diselesaikan:**
- Tidak ada tampilan visual workspace yang informatif
- Akses proyek memakan waktu karena harus mengetik URL manual
- Tidak ada cara cepat membuka proyek di code editor
- Berbagi proyek ke internet (tunneling) membutuhkan setup rumit

**Tujuan aplikasi:**
Menjadi pusat kendali (cockpit) utama untuk seluruh aktivitas development lokal — dari melihat daftar proyek, membukanya di browser/editor, hingga mengeksposnya ke internet.

**Target pengguna:**
- Developer PHP/Laravel yang menggunakan Laragon
- Freelancer yang sering switching antar proyek
- Developer yang butuh quick prototyping dan sharing

**Manfaat utama:**
- Semua proyek terlihat dalam satu layar
- Zero config — langsung jalan setelah clone
- Hemat waktu puluhan menit setiap hari

---

## Keunggulan Aplikasi

### ⚡ Cepat
Scan filesystem langsung tanpa database — halaman termuat dalam milidetik. Tanpa booting framework, tanpa query berat.

### 🔍 Filter Real-Time
Cukup ketik nama proyek, grid langsung menyaring hasil. Tidak ada tombol search, tidak ada reload halaman.

### 🖥️ Auto-Scan
Setiap proyek baru di `C:\laragon\www` otomatis muncul di grid. Tidak perlu registrasi atau konfigurasi.

### 🚀 One-Click Actions
Buka proyek via localhost, `.test` domain, atau langsung ke VS Code — semua dari satu kartu proyek.

### 🔒 IP Shield
Akses dibatasi otomatis ke IP lokal dan private network. Pengunjung dari IP publik langsung dialihkan ke halaman restricted.

### 📱 Responsive
Grid adaptif dari 1 kolom (mobile) hingga 3 kolom (desktop). Dioptimalkan untuk semua ukuran layar.

---

## Fitur Utama

### 🗂️ Project Grid
Tampilan semua proyek Laragon dalam bentuk kartu yang rapi. Setiap kartu menampilkan domain, path, dan status auto vhost.

*Manfaat: Lihat seluruh workspace dalam sekejap tanpa perlu membuka File Explorer.*

![Screenshot Grid](assets/screenshot-grid.png)

---

### 🔎 Live Search
Filter real-time berdasarkan nama proyek. Hasil berubah saat Anda mengetik — tanpa delay, tanpa tombol.

*Manfaat: Temukan proyek di antara puluhan folder dalam hitungan detik.*

![Screenshot Search](assets/screenshot-search.png)

---

### 🖥️ VS Code Launcher
Tombol untuk membuka folder proyek langsung di VS Code. Menggunakan `code` CLI melalui AJAX — halaman tidak reload.

*Manfaat: Buka code editor tanpa harus navigasi folder manual.*

![Screenshot VSCode](assets/screenshot-vscode.png)

---

### 🌐 Dual URL Access
Setiap proyek bisa diakses via dua cara: `localhost/nama-proyek` dan `nama-proyek.test` (virtual host Laragon).

*Manfaat: Fleksibel memilih akses sesuai kebutuhan development.*

![Screenshot URLs](assets/screenshot-urls.png)

---

### 🔗 Ngrok Tunnel
Bagikan proyek lokal ke klien atau tim dalam satu klik. Cukup masukkan URL Ngrok sekali di toolbar.

*Manfaat: Demo ke klien tanpa deploy — tunnel langsung dari lokal.*

![Screenshot Ngrok](assets/screenshot-ngrok.png)

---

### 📋 PHP Info Modal
Lihat konfigurasi PHP lengkap dalam modal overlay. Data diambil via AJAX, tidak perlu navigasi ke halaman terpisah.

*Manfaat: Debug environment PHP dengan cepat kapan saja.*

![Screenshot PHPInfo](assets/screenshot-phpinfo.png)

---

### 📎 Copy URL
Salin URL proyek ke clipboard dengan satu klik. Notifikasi toast mengonfirmasi aksi.

*Manfaat: Bagikan link proyek tanpa seleksi teks manual.*

![Screenshot Toast](assets/screenshot-toast.png)

---

## Screenshot Aplikasi

### Halaman Dashboard
Tampilan utama Laragon Hub — grid proyek, toolbar search + Ngrok, dan status bar.

![Dashboard](assets/ss-dashboard.png)

### Filter Pencarian
Search live saat mengetik — grid menyaring instan berdasarkan nama proyek.

![Search](assets/ss-search.png)

### Modal PHP Info
Informasi runtime PHP lengkap dalam pop-up modern tanpa pindah halaman.

![PHP Info](assets/ss-phpinfo.png)

### Ngrok Share
Terminal CMD terbuka otomatis dengan perintah Ngrok siap pakai untuk proyek yang dipilih.

![Ngrok](assets/ss-ngrok.png)

---

## Video Demo

[![Video Demo Laragon Hub](assets/video-thumbnail.png)](https://www.youtube.com/watch?v=YOUR_VIDEO_ID)

*Tonton video singkat ini untuk melihat bagaimana Laragon Hub mempercepat workflow development harian Anda.*

---

## Alur Penggunaan

```
Buka Browser → http://localhost
       ↓
   Lihat Grid Proyek
       ↓
 Cari Proyek (opsional)
       ↓
 Pilih Aksi:
       ↓
 ┌─────┼─────┬──────┬──────┐
 ↓     ↓     ↓      ↓      ↓
Open  Open  Buka   Copy   Share
Local  .test VS Code URL   Ngrok
```

---

## Role Pengguna

| Role | Hak Akses | Deskripsi |
|------|-----------|-----------|
| Developer | Full access | Melihat seluruh proyek, membuka di browser/VS Code, sharing via Ngrok, melihat PHP Info |

*Laragon Hub adalah single-user tool untuk lingkungan development lokal. Tidak ada sistem multi-role atau multi-user.*

---

## Modul Sistem

### Dashboard
Pusat kendali utama. Menampilkan seluruh proyek dalam grid responsive dengan informasi domain, path, dan status.

### Tools
Kumpulan aksi cepat: VS Code Launcher, Ngrok Tunnel, Copy URL, PHP Info Viewer — semuanya terintegrasi dalam satu antarmuka.

### Security Gateway
Lapisan keamanan berbasis IP yang membatasi akses hanya dari lingkungan lokal/private.

---

## Teknologi

| Frontend | Backend | Utility |
|----------|---------|---------|
| Tailwind CSS (CDN) | PHP 8+ (vanilla) | Font Awesome 6 |
| Vanilla JavaScript | No framework | Google Fonts |
| AJAX Fetch API | Filesystem scan | Space Grotesk, Inter, JetBrains Mono |

**Server:** Apache / Nginx (via Laragon)

**Deployment:** Clone ke `C:\laragon\www` — zero build step.

---

## Arsitektur Sistem

```
Browser (Client)
     ↓  HTTP Request
index.php (Gatekeeper)
     ↓  IP Validation
     ↓  Request Handler
  ┌──┴──┐
  │ GET │ POST (AJAX)
  └──┬──┘
     ↓
Filesystem (scandir)
     ↓
HTML + Tailwind CSS + JS
     ↓
   Response
```

**Penjelasan:**
Seuruh aplikasi berada dalam satu file (`index.php`). IP diverifikasi di awal, lalu request diproses: GET untuk menampilkan halaman, POST (AJAX) untuk aksi seperti buka VS Code atau share Ngrok. Data proyek berasal dari scan langsung filesystem — tanpa database, tanpa cache layer.

---

## Database

Laragon Hub **tidak menggunakan database**. Semua data berasal dari filesystem:
- Daftar proyek: hasil `scandir()` pada `C:\laragon\www`
- Status: tidak ada status persistent
- Konfigurasi: hardcoded di `index.php`

Ini berarti:
- **Zero setup database** — langsung jalan setelah clone
- **Zero migration** — tidak perlu migrate atau seed
- **Zero query** — tidak ada bottleneck koneksi database

> Untuk menyimpan preferensi atau history di versi mendatang, database SQLite ringan dapat ditambahkan.

---

## API

Laragon Hub memiliki endpoint API internal untuk komunikasi frontend-backend via AJAX.

### POST / — Buka VS Code

| Method | URL | Parameter | Tipe |
|--------|-----|-----------|------|
| POST | `/` | `open_code` | string (path folder) |

**Contoh Request:**
```javascript
fetch('/', {
  method: 'POST',
  body: new FormData().append('open_code', 'C:\\laragon\\www\\project-anda')
})
```

**Contoh Response:**
```json
{
  "success": true,
  "message": "VS Code berhasil dibuka"
}
```

---

### POST / — Share via Ngrok

| Method | URL | Parameter | Tipe |
|--------|-----|-----------|------|
| POST | `/` | `share_project` | string (nama folder) |
| | | `ngrok_url` | string (URL Ngrok) |

**Contoh Request:**
```javascript
const formData = new FormData();
formData.append('share_project', 'project-anda');
formData.append('ngrok_url', 'https://xxxx-xx-xxx.ngrok-free.app');
fetch('/', { method: 'POST', body: formData })
```

**Contoh Response:**
```json
{
  "success": true,
  "command": "start cmd /k ngrok http 443 ..."
}
```

---

## Instalasi

### 1. Clone Project
Clone repository ke direktori proyek Anda:
```bash
cd C:\laragon\www
git clone https://github.com/username/home-laragon.git
```

Atau cukup download dan ekstrak `index.php` langsung ke `C:\laragon\www` (timpa index default Laragon).

### 2. Konfigurasi Ngrok (Opsional)
Jika ingin menggunakan fitur share/tunnel:
1. Install Ngrok CLI dari https://ngrok.com
2. Pastikan `ngrok` tersedia di PATH Windows
3. Di file `index.php`, ganti variabel `$url` dengan URL Ngrok Anda

### 3. Akses Dashboard
Buka browser dan akses:
```
http://localhost/home-laragon
```

Atau jika Anda menimpa `index.php` default:
```
http://localhost
```

### 4. Verifikasi Instalasi
- Dashboard muncul dengan grid proyek
- Search filter berfungsi
- Tombol aksi (Open, VS Code, Copy) bekerja
- PHP Info modal dapat dibuka

### 5. Setup VS Code CLI (Opsional)
Pastikan VS Code CLI terdaftar di PATH:
```bash
code .
```
Jika VS Code terbuka, fitur launcher siap digunakan.

---

## Konfigurasi

Semua konfigurasi Laragon Hub berada di bagian atas file `index.php`:

| Variabel | Default | Deskripsi |
|----------|---------|-----------|
| `$url` | Ngrok URL | URL tunnel Ngrok default |
| `$directory` | `C:\laragon\www` | Direktori root proyek |
| `$allowed_ips` | `['127.0.0.1', '::1', 'localhost']` | Daftar IP yang diizinkan |

**Catatan:** Laragon Hub menggunakan konfigurasi hardcoded — tidak ada file `.env` atau panel admin. Edit langsung di `index.php` untuk perubahan.

> ⚠️ Jangan hapus atau ubah blok IP filtering jika server Anda terhubung ke internet publik.

---

## Requirement Server

### Minimum
| Komponen | Spesifikasi |
|----------|-------------|
| PHP | 7.4+ |
| Server | Apache / Nginx (via Laragon) |
| Storage | 1 MB free |
| OS | Windows (Laragon environment) |

### Recommended
| Komponen | Spesifikasi |
|----------|-------------|
| PHP | 8.0+ |
| VS Code CLI | Terdaftar di PATH |
| Ngrok CLI | Terinstall untuk fitur tunnel |

### Browser Support
| Browser | Status |
|---------|--------|
| Chrome 90+ | ✅ Full support |
| Firefox 88+ | ✅ Full support |
| Edge 90+ | ✅ Full support |
| Safari 14+ | ✅ Full support |

### Hosting Support
Laragon Hub dirancang untuk **lingkungan lokal**. Tidak disarankan di-deploy ke hosting publik karena:
- Menggunakan `popen()` untuk eksekusi sistem
- Bergantung pada filesystem Windows
- Tidak memiliki autentikasi multi-user

---

## Keamanan

| Fitur | Keterangan |
|-------|------------|
| 🔒 **IP Filtering** | Validasi IP pengguna — hanya local/private IP yang diizinkan |
| 🛡️ **Public IP Redirect** | IP publik otomatis dialihkan ke `restricted.php` |
| 🧹 **XSS Protection** | Output di-escape dengan `htmlspecialchars()` |
| 🔐 **No Session / Auth** | Tidak ada session — aman untuk lokal (tidak ada data sensitif) |
| 📁 **Read-Only Filesystem** | Aplikasi hanya membaca direktori, tidak menulis |
| ⚡ **Non-Blocking Exec** | Menggunakan `popen()` — tidak blocking script utama |

> Laragon Hub adalah tool local development. Tidak ada data user, tidak ada autentikasi, tidak ada input database — sehingga permukaan serangan sangat minim.

---

## Performa

| Optimasi | Implementasi |
|----------|--------------|
| 📄 **No Framework** | PHP vanilla — zero bootstrap overhead |
| 💾 **No Database** | Filesystem scan — tanpa koneksi/query DB |
| ⚡ **Lightweight** | Satu file ~12 KB — muat dalam 1 request |
| 🔍 **Client-Side Search** | Filter di JavaScript — tanpa request server |
| 🖼️ **CDN Assets** | Tailwind, Font Awesome via CDN — cache browser |
| 📱 **Responsive Grid** | CSS Grid native — tanpa library layout |

---

## Studi Kasus

### Sebelum Menggunakan Laragon Hub

**Problem:**
Anda memiliki 15+ proyek di Laragon. Setiap kali ingin mengakses proyek:
1. Buka File Explorer
2. Cari folder proyek di `C:\laragon\www`
3. Copy nama folder
4. Buka browser, ketik `localhost/nama-folder`
5. Kalau lupa path, harus bolak-balik Explorer → browser

**Waktu: ±30 detik per akses.**

---

### Sesudah Menggunakan Laragon Hub

**Solusi:**
1. Buka `localhost` — semua proyek terlihat dalam grid
2. Klik nama proyek → langsung terbuka

**Atau:**
- Ketik nama proyek di search → langsung terfilter
- Klik ikon VS Code → editor terbuka otomatis
- Klik Copy → URL siap di-paste ke chat

**Waktu: ±3 detik per akses.**

---

### Perbandingan

| Aktivitas | Tanpa Laragon Hub | Dengan Laragon Hub | Hemat |
|-----------|------------------|-------------------|-------|
| Buka proyek | 30 detik | 3 detik | 90% |
| Buka di VS Code | 20 detik | 1 detik | 95% |
| Cari proyek | 15 detik | 1 detik | 93% |
| Share ke klien | 5 menit | 10 detik | 97% |
| Cek PHP Info | 1 menit | 2 detik | 97% |

**Efisiensi: rata-rata 94% lebih cepat.**

---

## FAQ

**1. Apa itu Laragon Hub?**
Dashboard modern untuk Laragon yang menampilkan semua proyek dalam grid interaktif dengan aksi cepat seperti buka di browser, VS Code, dan share via Ngrok.

**2. Apakah perlu database?**
Tidak. Laragon Hub 100% berbasis filesystem — scan folder `www` langsung, tanpa database.

**3. Bagaimana cara install?**
Clone atau download `index.php` ke `C:\laragon\www`, lalu akses `http://localhost/home-laragon`.

**4. Apakah Laragon Hub mengganggu proyek yang sudah ada?**
Tidak. Aplikasi hanya membaca direktori — tidak memodifikasi file proyek Anda.

**5. Kenapa saya diarahkan ke restricted.php?**
Karena Anda mengakses dari IP publik. Laragon Hub hanya bisa diakses dari localhost atau jaringan lokal.

**6. Fitur apa saja yang tersedia?**
Project grid, live search, dual URL access (localhost + .test), VS Code launcher, copy URL, Ngrok tunnel, dan PHP info modal.

**7. Apakah bisa diakses dari HP/tablet?**
Bisa, selama perangkat terhubung ke jaringan lokal yang sama. Grid responsif menyesuaikan layar.

**8. Bagaimana cara setup Ngrok?**
Install Ngrok CLI, pastikan di PATH, lalu ganti `$url` di `index.php` dengan URL tunnel Anda.

**9. Apakah butuh koneksi internet?**
Untuk fitur dasar (grid, search, VS Code) — tidak. Untuk styling via CDN (Tailwind, Font Awesome) — iya. Untuk fitur Ngrok — iya.

**10. Apakah Laragon Hub aman?**
Iya. Akses dibatasi ke IP lokal, output di-escape, dan tidak ada penyimpanan data pengguna.

**11. Bisa ditambahkan fitur baru?**
Bisa. Laragon Hub adalah file PHP tunggal — edit langsung, pull request, atau fork repository.

**12. Ada versi untuk Mac atau Linux?**
Saat ini khusus Windows + Laragon. Namun, karena menggunakan PHP murni, adaptasi ke environment lain sangat mungkin.

---

## Roadmap

### v1.0 — Rilis Awal (Saat Ini)
- Project grid dengan auto-scan
- Dual URL access (localhost + .test)
- VS Code launcher (AJAX)
- Copy URL to clipboard
- Ngrok tunnel integration
- Live search filter
- PHP info modal
- IP-based security

### v1.5 — Planned
- Sort by name / last modified
- Project search dengan tags
- Bookmark/favorit proyek
- Dark/Light theme toggle
- Multi-language support (EN/ID)
- Custom background/cover per proyek

### v2.0 — Planned
- Panel terminal built-in
- Database manager quick access (Adminer/phpMyAdmin)
- Quick command runner (artisan, composer, npm)
- Recent activity log
- One-click project backup

### Future Plan
- Plugin system untuk tools tambahan
- Remote workspace (akses proyek dari perangkat lain)
- Integration dengan GitHub/GitLab (clone + open)
- Statistik penggunaan (waktu, frekuensi akses)

---

## Lisensi

**MIT License**

Copyright (c) 2024 Laragon Hub

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

---

## Kontak

| Media | Detail |
|-------|--------|
| 📧 Email | email@anda.com |
| 🌐 Website | https://anda.com |
| 💬 GitHub | [github.com/username/home-laragon](https://github.com/username/home-laragon) |
| 🐦 Twitter | @username |
| 📞 WhatsApp | +62 8xx-xxxx-xxxx |

---

## Footer

**© 2024 Laragon Hub.** All rights reserved.

**Versi:** v1.0.0

[📖 Dokumentasi](#) &nbsp;•&nbsp; [🔒 Privacy Policy](#) &nbsp;•&nbsp; [📋 Terms of Service](#)

---

*Dibuat dengan ❤️ untuk developer Laragon di seluruh Indonesia.*
