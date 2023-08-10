<?php
/*
The MIT License (MIT)

Copyright (c) 2023 Anggiramadyansyah

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE
*/

// Untuk debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Sesi 
session_start();

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "stok-barang");

if(isset($_POST['addnewbarang'])){
  $namabarang = mysqli_real_escape_string($conn, $_POST['namabarang']);
  $namabarang = ucwords(strtolower($namabarang));
  $hargamodal = mysqli_real_escape_string($conn, $_POST['hargamodal']);
  $satuanberat = mysqli_real_escape_string($conn, $_POST['satuanberat']);
  $jumlahbarang = mysqli_real_escape_string($conn, $_POST['jumlahbarang']);
  $hargajual = mysqli_real_escape_string($conn, $_POST['hargajual']);
  $result_check_barang = mysqli_query($conn, "SELECT idbarang, jumlahbarang FROM stok WHERE LOWER(namabarang) = LOWER('$namabarang') AND LOWER(satuanberat) = LOWER('$satuanberat')");
  if($hargajual < $hargamodal){
    header('location:layouts/peringatan-harga-jual.php');
    exit; // Berhenti eksekusi skrip setelah mengalihkan ke halaman "peringatan-harga-jual.php"
  }

  if(mysqli_num_rows($result_check_barang) > 0){
    $data_barang = mysqli_fetch_assoc($result_check_barang);
    $idbarang = $data_barang['idbarang'];
    $new_quantity = $data_barang['jumlahbarang'] + $jumlahbarang;
    $result_update_quantity = mysqli_query($conn, "UPDATE stok SET jumlahbarang='$new_quantity' WHERE idbarang='$idbarang'");
    if($result_update_quantity){
      header('location:index.php?success=1');
    } else {
      header('location:index.php?error=1');
    }
  } else {
      $result = mysqli_query($conn, "INSERT INTO stok (namabarang, hargamodal, satuanberat, jumlahbarang, hargajual) VALUES ('$namabarang', '$hargamodal', '$satuanberat','$jumlahbarang', '$hargajual')");
      if($result){
        header('location:index.php?success=1');
      } else {
        header('location:index.php?error=1');
      }
    }
  }

// Menambah barang masuk
if(isset($_POST['barangmasuk'])){
  $barangnya = $_POST['barangnya'];
  $qty = $_POST['qty'];

  $result_cek_stok_sekarang = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang='$barangnya'");
  $result_ambil_data = mysqli_fetch_array($result_cek_stok_sekarang);
  $result_stok_sekarang = $result_ambil_data['jumlahbarang'];
  $result_tambah_stok_sekarang = $result_stok_sekarang + $qty;

  $result_masuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, qty) VALUES ('$barangnya','$qty')");
  $result_update_stok = mysqli_query($conn, "UPDATE stok SET jumlahbarang='$result_tambah_stok_sekarang' WHERE idbarang='$barangnya'");

  if($result_masuk && $result_update_stok){
    header('location:barang-masuk.php');
  } else {
    header('location:barang-masuk.php');
  }
}

// Menambah Barang Keluar
if(isset($_POST['barangkeluar'])){
  $barangnya = $_POST['barangnya'];
  $qty = $_POST['qty'];

  $result_cek_stok_sekarang = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang='$barangnya'");
  $result_ambil_data = mysqli_fetch_array($result_cek_stok_sekarang);
  $result_stok_sekarang = $result_ambil_data['jumlahbarang'];
  $result_tambah_stok_sekarang = $result_stok_sekarang - $qty;

  $result_keluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, qty) VALUES ('$barangnya','$qty')");
  $result_update_stok = mysqli_query($conn, "UPDATE stok SET jumlahbarang='$result_tambah_stok_sekarang' WHERE idbarang='$barangnya'");

  if($result_keluar && $result_update_stok){
    header('location:barang-keluar.php');
  } else {
    header('location:barang-keluar.php');
  }
}

// Update Info Barang
if(isset($_POST['updatebarang'])){
  $idbarang = $_POST['idbarang'];
  $namabarang = $_POST['namabarang'];
  $hargamodal = $_POST['hargamodal'];
  $satuanberat = $_POST['satuanberat'];
  $hargajual = $_POST['hargajual'];
  $jumlahbarang = $_POST['jumlahbarang'];

  $update = mysqli_query($conn, "UPDATE stok SET idbarang='$idbarang', namabarang='$namabarang', hargamodal='$hargamodal', satuanberat='$satuanberat', hargajual='$hargajual', jumlahbarang='$jumlahbarang' WHERE idbarang ='$idbarang'");

  if($hargajual < $hargamodal){
    header('location:peringatan-harga-jual.php');
    exit;
  }

  if($update){
    header('location:index.php');
  } else {
    header('location:index.php');
  }
}

// Update Hapus Barang
if(isset($_POST['hapusbarang'])){
  $idbarang = $_POST['idbarang'];

  $hapus = mysqli_query($conn, "DELETE FROM stok WHERE idbarang='$idbarang'");

  if($hapus){
    header('location:index.php');
  } else {
    header('location:index.php');
  }
}

if(isset($_POST['hapusbarangmasuk'])){
  $idmasuk = $_POST['idmasuk'];
  $idbarang = $_POST['idbarang'];

  $get_qty = mysqli_query($conn, "SELECT qty FROM masuk WHERE idmasuk='$idmasuk'");
  if($get_qty && mysqli_num_rows($get_qty) > 0){
    $row = mysqli_fetch_assoc($get_qty);
    $qty = $row['qty'];
    $hapus_masuk = mysqli_query($conn, "DELETE FROM masuk WHERE idmasuk='$idmasuk'");
    $update_stok = mysqli_query($conn, "UPDATE stok SET jumlahbarang = jumlahbarang - $qty WHERE idbarang='$idbarang'");

    if($hapus_masuk && $update_stok){
      header('location: barang-masuk.php');
    } else {
      echo 'Gagal mengupdate stok!';
    }
  } else {
    echo 'Data masuk tidak ditemukan!';
  }
}

if(isset($_POST['updatebarangmasuk'])){
  $idbarang = $_POST['idbarang'];
  $idmasuk = $_POST['idmasuk'];
  $qty = $_POST['qty'];

  $result_cek_stok_sekarang = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang='$idbarang'");
  $result_ambil_data = mysqli_fetch_array($result_cek_stok_sekarang);
  $stoksekarang = $result_ambil_data['jumlahbarang'];

  $result_cek_qty_sekarang = mysqli_query($conn, "SELECT * FROM masuk WHERE idmasuk='$idmasuk'");
  $result_ambil_qty = mysqli_fetch_array($result_cek_qty_sekarang);
  $qtysekarang = $result_ambil_qty['qty'];

  $selisih = $qty - $qtysekarang;
  $stokbaru = $stoksekarang + $selisih;

  $result_update_stok = mysqli_query($conn, "UPDATE stok SET jumlahbarang='$stokbaru' WHERE idbarang='$idbarang'");
  $result_update_qty = mysqli_query($conn, "UPDATE masuk SET qty='$qty' WHERE idmasuk='$idmasuk'");

  if ($result_update_stok && $result_update_qty) {
    header('location:barang-masuk.php');
  } else {
    echo 'Gagal mengubah data barang masuk!';
    header('location:barang-masuk.php');
  }
}

if(isset($_POST['hapusbarangkeluar'])){
  $idkeluar = $_POST['idkeluar'];
  $idbarang = $_POST['idbarang'];

  $get_qty = mysqli_query($conn, "SELECT qty FROM keluar WHERE idkeluar='$idkeluar'");
  if($get_qty && mysqli_num_rows($get_qty) > 0){
    $row = mysqli_fetch_assoc($get_qty);
    $qty = $row['qty'];
    $hapus_keluar = mysqli_query($conn, "DELETE FROM keluar WHERE idkeluar='$idkeluar'");
    $update_stok = mysqli_query($conn, "UPDATE stok SET jumlahbarang = jumlahbarang - $qty WHERE idbarang='$idbarang'");

    if($hapus_keluar && $update_stok){
      header('location: barang-masuk.php');
    } else {
      echo 'Gagal mengupdate stok!';
    }
  } else {
    echo 'Data masuk tidak ditemukan!';
  }
}

if(isset($_POST['updatebarangkeluar'])){
  $idbarang = $_POST['idbarang'];
  $idkeluar = $_POST['idkeluar'];
  $qty = $_POST['qty'];

  $result_cek_stok_sekarang = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang='$idbarang'");
  $result_ambil_data = mysqli_fetch_array($result_cek_stok_sekarang);
  $stoksekarang = $result_ambil_data['jumlahbarang'];

  $result_cek_qty_sekarang = mysqli_query($conn, "SELECT * FROM keluar WHERE idkeluar='$idkeluar'");
  $result_ambil_qty = mysqli_fetch_array($result_cek_qty_sekarang);
  $qtysekarang = $result_ambil_qty['qty'];

  $selisih = $qty - $qtysekarang;
  $stokbaru = $stoksekarang + $selisih;

  $result_update_stok = mysqli_query($conn, "UPDATE stok SET jumlahbarang='$stokbaru' WHERE idbarang='$idbarang'");
  $result_update_qty = mysqli_query($conn, "UPDATE keluar SET qty='$qty' WHERE idkeluar='$idkeluar'");

  if ($result_update_stok && $result_update_qty) {
    header('location:barang-masuk.php');
  } else {
    echo 'Gagal mengubah data barang masuk!';
    header('location:barang-masuk.php');
  }
}
?>
