# Job on Campus (JoC) System

Job on Campus (JoC) adalah sebuah aplikasi web pengurusan kerjaya dalam kampus yang direka khusus untuk mempermudah proses pengambilan, pemantauan dan pembayaran elaun pelajar yang bekerja di dalam komuniti universiti. Sistem ini dibina berasaskan seni bina MVC yang dinamik dengan kawalan akses berasaskan peranan (Role-Based Access Control) yang ketat.

---

## 🚀 Ciri-Ciri Utama Sistem (Core Features)

Sistem ini membahagikan kawalan antaramuka (UI Switching) dan hak capaian secara dinamik kepada tiga kumpulan pengguna utama:

* **Mod Pelajar (Student):**
    * Menerokai iklan tawaran jawatan kosong aktif di dalam kampus.
    * Menerima dan menyemak surat tawaran pelantikan digital (Penjanaan PDF).
    * Merekodkan log jam bekerja harian melalui komponen Borang Timesheet.
    * Menguruskan penghantaran tuntutan elaun bulanan (Claim Form).
* **Mod Penyelia PTJ (Supervisor):**
    * Mencipta, mengemas kini, dan menguruskan iklan tawaran kerja jabatan.
    * Menapis profil kelayakan calon pelajar serta melakukan import data pukal melalui Excel.
    * Membuat pengesahan (*verify*), kelulusan atau penolakan log jam bekerja Timesheet pelajar.
* **Mod Urusetia Unit Kerjaya (Career Admin):**
    * Akses kuasa besar sistem (Superuser / Pentadbir).
    * Memantau agihan dan baki tabung peruntukan dana kewangan tahunan Kerjaya universiti.
    * Meluluskan permohonan iklan jawatan peringkat induk universiti.
    * Memproses kelulusan muktamad *payroll* bulanan pelajar dan mengeksport data tuntutan ke format CSV/Excel.

---

## 🛠️ Tech Stack & Spesifikasi Teknikal

Sistem JoC dibina menggunakan gabungan teknologi moden yang berprestasi tinggi:

* **Backend Framework:** CodeIgniter 4 (Version 4.7.0)
* **Programming Language:** PHP (Version 8.4)
* **Database:** MySQL (Relational Database Management System)
* **Frontend UI Template:** Metronic Admin Template (Bootstrap 5)
* **UI/UX enhancements:** Glassmorphism Layout, ApexCharts (Graf Analitik Dinamik), SweetAlert2, Dropzone
* **Autentikasi & Sesi:** CodeIgniter Shield (Custom Group Authorization)

---

## 📁 Struktur Pangkalan Data Penting

Sistem ini menggunakan struktur hubungan entiti (ERD) yang dipetakan secara silang (*cross-reference*) bagi menentukan tahap kuasa akaun kakitangan tanpa mengusik jadual autentikasi utama:

* `users`: Menyimpan maklumat pendaftaran asas akaun (Pelajar / Kakitangan).
* `pjoc011murusetia`: Jadual rujukan induk hak akses Urusetia. Jika ID kakitangan (`ukmper`) wujud di sini dan aktif, sistem akan auto-menaikkan pangkat mereka daripada Penyelia PTJ biasa kepada Urusetia Pentadbir.
    * `tahap_akses`: `1` = Pegawai, `2` = Penyelia Urusetia, `3` = Pentadbir Sistem.
* `pjoc007mperuntukanbajetcareer`: Menyimpan data rekod transaksi kewangan, peruntukan dana, dan pembayaran *payroll*.

---

## 💻 Panduan Pemasangan (Installation Guide)

Ikuti langkah ini untuk menjalankan projek di persekitaran lokal (*Localhost*):

1. **Klon Repositori:**
   ```bash
   git clone [https://github.com/username/joc-system.git](https://github.com/username/joc-system.git)
   cd joc-system

---

## 👥 Maklumat Pembangunan & Penyeliaan (Development Team)

Sistem ini dibangunkan sepenuhnya sebagai projek rasmi Latihan Industri (Industrial Training) di dalam organisasi universiti:

* **Organisasi Klien / Penempatan:** Pusat Teknologi Digital (DigitalUKM), Universiti Kebangsaan Malaysia (UKM).
* **Developer (Pembangun):** Nur Umairah Binti Mohd Sabri (Pelajar Diploma Teknologi Maklumat (Teknologi Digital) - SAD, Politeknik Balik Pulau).
* **Penyelia Industri (Supervisor):** Encik Noorulfaiz bin Ateman (Department PMO Aplikasi, DigitalUKM).

*Copyright © 2026 Pusat Teknologi Digital (DigitalUKM). All rights reserved.*
