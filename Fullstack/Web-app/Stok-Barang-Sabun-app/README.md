## Dokumentasi Proyek Toko Sabun dengan Teknik CRUD


> **Note**: Pembangunan pada proyek ini akan terus dilakukan.


### Deskripsi Proyek

Proyek toko sabun adalah aplikasi web sederhana yang dibangun atas usaha rumahan pribadi yang menggunakan beberapa teknologi sebagai berikut.
- `Vim` sebagai teks editor.
- `PHP 8` untuk logika _backend_.
- `HTML`, `CSS` untuk tampilan _frontend_.
- `JavaScript` untuk interaksi antarmuka pengguna.

Aplikasi ini bertujuan untuk mengelola produk-produk sabun yang dijual di toko saya pribadi. Seperti menambah, mengedit, menghapus, dan menampilkan daftar produk.


### Fitur Halaman

- Halaman Utama
  ![index edited](https://github.com/sukalaper/fundamental-pemrograman/assets/65320033/61262a0c-140b-426e-821a-87eabfbbcc92)

Halaman utama adalah tampilan awal aplikasi yang menampilkan daftar produk sabun yang tersedia di toko. Setiap produk akan menampilkan informasi singkat tentang produk tersebut, seperti nama, harga, satuan berat dan jumlah stok.


- Menambah Produk Baru
![tambah-barang edited](https://github.com/sukalaper/fundamental-pemrograman/assets/65320033/af0306c6-e909-4e30-9edf-7c742057aaf3)

Fitur ini memungkinkan pengguna untuk menambahkan produk sabun baru ke dalam database. Pengguna harus mengisi formulir dengan informasi produk seperti nama, harga, satuan berat dan jumlah stok.

 
- Melakukan Edit Produk
![edit-barang edited](https://github.com/sukalaper/fundamental-pemrograman/assets/65320033/96107ec1-d20a-4e2d-b92a-144889bee961)

Pengguna dapat mengakses fitur ini dari halaman utama dengan mengklik tombol "Edit" pada produk yang ingin diubah. Formulir pre-populasi akan muncul dengan informasi produk yang telah ada sebelumnya, dan pengguna dapat memperbarui informasi tersebut.


- Menghapus Produk
  ![hapus-barang edited](https://github.com/sukalaper/fundamental-pemrograman/assets/65320033/3fd6c42f-001c-4802-a56a-ee732a17be69)

Fitur ini memungkinkan pengguna untuk menghapus produk dari database. Pengguna dapat mengakses fitur ini melalui halaman utama dengan mengklik tombol "Hapus" pada produk yang ingin dihapus. Setelah konfirmasi, produk akan dihapus dari database.


### Fitur Pada Sisi Backend
- Tambah Barang
  - Nama barang yang di input Mis, "rinso cair" akan dikonversi menjadi "Rinso Cair" untuk menghindari duplikasi [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/8a113857352cbbac5723156122a765a6b7970044/Fullstack/Web-app/Stok-Barang-Sabun-app/function.php#L35)
  - Penggabungan pada satuan berat _(g)_ dan satuan volume _(mL)_ [lihat disini.](https://www.freedomsiana.id/1-gram-berapa-ml-mililiter-jawaban/)
  - Penambahan fitur harga modal dan harga jual.
    - Pada baris harga, jika harga jual < harga modal maka pengguna akan dialihkan ke halaman yang telah saya tentukan, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/8a113857352cbbac5723156122a765a6b7970044/Fullstack/Web-app/Stok-Barang-Sabun-app/function.php#L41)
    - Menjadikan baris harga modal dan harga jual menjadi RegEx agar dapat di klik secara manual, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/8a113857352cbbac5723156122a765a6b7970044/Fullstack/Web-app/Stok-Barang-Sabun-app/index.php#L226C63-L226C86)
-  Edit Barang
    - Penambahan fitur harga modal dan harga jual.
    - Pada baris harga, jika harga jual < harga modal maka pengguna akan dialihkan ke halaman yang telah saya tentukan, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/8a113857352cbbac5723156122a765a6b7970044/Fullstack/Web-app/Stok-Barang-Sabun-app/function.php#L41)
    - Menjadikan baris harga modal dan harga jual menjadi RegEx agar dapat di klik secara manual, [lihat disini.](https://github.com/sukalaper/fundamental-pemrograman/blob/8a113857352cbbac5723156122a765a6b7970044/Fullstack/Web-app/Stok-Barang-Sabun-app/index.php#L226C63-L226C86)
- Hapus Barang


## TODO

- [ ] Menghapus fitur login administrator, apakah saya perlu melakukannya? 
- [ ] Penambahan beberapa fitur pada barang masuk.
- [ ] Penambahan beberapa fitur pada barang keluar.
- [ ] Penambahan notifikasi jika stok menipis.
- [ ] Penambahan notifikasi jika barang keluar melebihi stok barang yang ada.
- [ ] Ekspor file rekapitulasi penjualan dan laba dalam format ```.pdf``` atau ```.xlsx``` agar proses manajemen lebih mudah.
- [ ] Perubahan beberapa warna dan tampilan
- [ ] Dll


## Catatan Kecil
Proyek ini dibangun untuk keperluan pembelajaran dan bersifat sederhana. Pastikan untuk mengamankan aplikasi jika digunakan dalam lingkungan produksi dengan mempertimbangkan keamanan dan validasi data yang lebih ketat.
