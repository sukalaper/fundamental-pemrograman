## Dokumentasi Proyek Toko Sabun Berbasis Website


> **Note**: Proyek ini dibangun untuk keperluan pembelajaran dan bersifat sederhana. Pastikan untuk mengamankan aplikasi jika digunakan dalam lingkungan produksi dengan mempertimbangkan keamanan dan validasi data yang lebih ketat. Pembaruan mungkin akan terus dilakukan. Harap maklum jika ada beberapa perubahan dan saya mungkin lupa untuk menyertakannya.

Aplikasi ini bertujuan untuk mengelola produk-produk sabun yang dijual di toko saya pribadi. Seperti menambah, mengedit, menghapus, dan menampilkan daftar produk.


### Fitur Halaman

- Halaman Utama

Halaman utama adalah tampilan awal aplikasi yang menampilkan daftar produk sabun yang tersedia di toko. Setiap produk akan menampilkan informasi singkat tentang produk tersebut, seperti nama, harga, satuan berat dan jumlah stok.


- Menambah Produk Baru

Fitur ini memungkinkan pengguna untuk menambahkan produk sabun baru ke dalam database. Pengguna harus mengisi formulir dengan informasi produk seperti nama, harga, satuan berat dan jumlah stok.

 
- Melakukan Edit Produk

Pengguna dapat mengakses fitur ini dari halaman utama dengan mengklik tombol "Edit" pada produk yang ingin diubah. Formulir pre-populasi akan muncul dengan informasi produk yang telah ada sebelumnya, dan pengguna dapat memperbarui informasi tersebut.


- Menghapus Produk

Fitur ini memungkinkan pengguna untuk menghapus produk dari database. Pengguna dapat mengakses fitur ini melalui halaman utama dengan mengklik tombol "Hapus" pada produk yang ingin dihapus. Setelah konfirmasi, produk akan dihapus dari database.


### Fitur Tersedia
- Pada halaman `index.php`
  - Tambah Barang Baru
    - Nama barang yang di input Mis, "rinso cair" akan dikonversi menjadi "Rinso Cair" untuk menghindari duplikasi, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/8a113857352cbbac5723156122a765a6b7970044/Fullstack/Web-app/Stok-Barang-Sabun-app/function.php#L35)
    - Penggabungan pada satuan berat _(g)_ dan satuan volume _(mL)_ [lihat disini.](https://www.freedomsiana.id/1-gram-berapa-ml-mililiter-jawaban/)
    - Penambahan fitur harga modal dan harga jual.
    - Pada baris harga, jika harga jual < harga modal maka pengguna akan dialihkan ke halaman yang telah saya tentukan, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/8a113857352cbbac5723156122a765a6b7970044/Fullstack/Web-app/Stok-Barang-Sabun-app/function.php#L41)
    - Menjadikan baris harga modal dan harga jual menjadi RegEx agar dapat di klik secara manual, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/8a113857352cbbac5723156122a765a6b7970044/Fullstack/Web-app/Stok-Barang-Sabun-app/index.php#L226C63-L226C86)
  -  Edit Barang 
      - Penambahan fitur harga modal dan harga jual.
      - Pada baris harga, jika harga jual < harga modal maka pengguna akan dialihkan ke halaman yang telah saya tentukan, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/8a113857352cbbac5723156122a765a6b7970044/Fullstack/Web-app/Stok-Barang-Sabun-app/function.php#L41)
      - Menjadikan baris harga modal dan harga jual menjadi RegEx agar dapat di klik secara manual, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/8a113857352cbbac5723156122a765a6b7970044/Fullstack/Web-app/Stok-Barang-Sabun-app/index.php#L226C63-L226C86)
  - Hapus Barang

- Pada halaman `barang-masuk.php`
  - Tambah Barang Baru
    - Nama barang akan terdeteksi dengan satuan berat yang telah di input untuk menghindari duplikasi, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/8e6622261d38a9d843c9385cebfd8ad8180b9b2b/Fullstack/Web-app/Stok-Barang-Sabun-app/barang-masuk.php#L187)
  - Edit Barang Masuk
    - Nama barang keluar akan terdeteksi dengan satuan berat untuk menghindari duplikasi, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/2f899d90e9e5f7586ab2bf536eacee86e0310eba/Fullstack/Web-app/Stok-Barang-Sabun-app/barang-masuk.php#L190)
    - Nama barang dan satuan berat akan terdeteksi sebagai _readonly_ [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/2f899d90e9e5f7586ab2bf536eacee86e0310eba/Fullstack/Web-app/Stok-Barang-Sabun-app/barang-masuk.php#L220)
  - Hapus Barang Masuk
    - Nama barang dan satuan berat akan muncul untuk menghindari kesalahan penghapusan barang, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/2f899d90e9e5f7586ab2bf536eacee86e0310eba/Fullstack/Web-app/Stok-Barang-Sabun-app/barang-masuk.php#L241)
    - Penambahan fitur pada saat barang di hapus tidak akan mempengaruhi jumlah barang dari `index.php`, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/2f899d90e9e5f7586ab2bf536eacee86e0310eba/Fullstack/Web-app/Stok-Barang-Sabun-app/function.php#L139)

- Pada halaman `barang-keluar.php`
  > ~**Peringatan**: Tabel tidak dirender dengan baik pada halaman ini, perbaikan segera dilakukan~, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/commit/4ca1262e93c435bfbaa4f89354eb8bc5a3c809f4)
  - Tambah Barang Keluar
  - Edit Barang Keluar
    - Nama barang keluar akan terdeteksi dengan satuan berat untuk menghindari duplikasi, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/2f899d90e9e5f7586ab2bf536eacee86e0310eba/Fullstack/Web-app/Stok-Barang-Sabun-app/barang-keluar.php#L186)
  - Hapus Barang Keluar
    - Beberapa perbaikan sedang dalam pengerjaan.
    
### Fitur Tahap Pengerjaan

- [x] Refaktorisasi folder agar lebih terstruktur (dalam pengerjaan saat ini)
- [ ] Menghapus fitur login administrator, apakah saya perlu melakukannya?
- [x] Penambahan beberapa fitur pada barang keluar.
- [x] Penambahan notifikasi jika barang keluar melebihi stok barang yang ada.
- [x] Ekspor file rekapitulasi penjualan dan laba dalam format ```.pdf``` atau ```.xlsx``` agar proses manajemen lebih mudah.
- [x] Perubahan beberapa warna dan tampilan
- [x] Dll (Dalam pengerjaan dan sedikit refaktorisasi)
