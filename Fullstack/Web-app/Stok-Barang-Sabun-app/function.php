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
$conn = mysqli_connect("localhost","root","","stok-barang");
if (isset($_POST['addnewbarang'])) {
  $namabarang = mysqli_real_escape_string($conn, $_POST['namabarang']);
  $namabarang = ucwords(strtolower($namabarang));
  $hargamodal = mysqli_real_escape_string($conn, $_POST['hargamodal']);
  $satuanberat = mysqli_real_escape_string($conn, $_POST['satuanberat']);
  $jumlahbarang = mysqli_real_escape_string($conn, $_POST['jumlahbarang']);
  $hargajual = mysqli_real_escape_string($conn, $_POST['hargajual']);
  $result_check_barang = mysqli_query($conn, "SELECT idbarang, jumlahbarang FROM stok WHERE LOWER(namabarang) = LOWER('$namabarang') AND LOWER(satuanberat) = LOWER('$satuanberat')");
  if ($hargajual < $hargamodal) {
    header('location:peringatan-harga-jual.php');
    exit; // Berhenti eksekusi skrip setelah mengalihkan ke halaman "peringatan-harga-jual.php"
  }
  if (mysqli_num_rows($result_check_barang) > 0) {
    // Item with the same name and weight unit already exists, update the quantity instead of creating a new entry
    $data_barang = mysqli_fetch_assoc($result_check_barang);
    $idbarang = $data_barang['idbarang'];
    $new_quantity = $data_barang['jumlahbarang'] + $jumlahbarang;
    $result_update_quantity = mysqli_query($conn, "UPDATE stok SET jumlahbarang='$new_quantity' WHERE idbarang='$idbarang'");
    if ($result_update_quantity) {
      header('location:index.php?success=1');
    } else {
      header('location:index.php?error=1');
    }
    } else {
      // Item with the same name and weight unit doesn't exist, create a new entry
      $result = mysqli_query($conn, "INSERT INTO stok (namabarang, hargamodal, satuanberat, jumlahbarang, hargajual) VALUES ('$namabarang', '$hargamodal', '$satuanberat','$jumlahbarang', '$hargajual')");
      if ($result) {
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
    $result_cek_stok_sekarang = mysqli_query($conn,"SELECT * FROM stok WHERE idbarang='$barangnya'");
    $result_ambil_data = mysqli_fetch_array($result_cek_stok_sekarang);
    $result_stok_sekarang = $result_ambil_data['jumlahbarang'];
    $result_tambah_stok_sekarang = $result_stok_sekarang + $qty;
    $result_masuk = mysqli_query($conn,"INSERT INTO masuk (idbarang, qty) VALUES ('$barangnya','$qty')");
    $result_update_stok = mysqli_query($conn,"UPDATE stok SET jumlahbarang='$result_tambah_stok_sekarang' WHERE idbarang='$barangnya'");
    if($result_masuk&&$result_update_stok){
      header('location:barang-masuk.php');
    } else {
      header('location:barang-masuk.php');
    }
  }
// Menambah Barang Keluar
  if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $qty = $_POST['qty'];
    $result_cek_stok_sekarang = mysqli_query($conn,"SELECT * FROM stok WHERE idbarang='$barangnya'");
    $result_ambil_data = mysqli_fetch_array($result_cek_stok_sekarang);
    $result_stok_sekarang = $result_ambil_data['jumlahbarang'];
    $result_tambah_stok_sekarang = $result_stok_sekarang - $qty;
    $result_keluar = mysqli_query($conn,"INSERT INTO keluar (idbarang, qty) VALUES ('$barangnya','$qty')");
    $result_update_stok = mysqli_query($conn,"UPDATE stok SET jumlahbarang='$result_tambah_stok_sekarang' WHERE idbarang='$barangnya'");
    if($result_keluar&&$result_update_stok){
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
    $update = mysqli_query($conn,"UPDATE stok SET idbarang='$idbarang', namabarang='$namabarang', hargamodal='$hargamodal', satuanberat='$satuanberat', hargajual='$hargajual' WHERE idbarang ='$idbarang'");
    if($hargajual < $hargamodal){
      header('location:peringatan-harga-jual.php');
      exit;
      if($update){
        header('location:index.php');
      } else {
        header('location:index.php');
      } 
    } else { 
      header('location:index.php');
   }
  }
// Update Hapus Barang 
  if(isset($_POST['hapusbarang'])){
    $idbarang = $_POST['idbarang'];
    $hapus = mysqli_query($conn,"DELETE FROM stok WHERE idbarang='$idbarang'");
    if($hapus){
      header('location:index.php');
    } else {
      header('location:index.php');
    }
  }
  if(isset($_POST['hapusbarangmasuk'])){
    $idmasuk = $_POST['idbarang'];
    $idmasuk = $_POST['idmasuk'];
    $barangnya = $_POST['barangnya'];
    $hapus_masuk = mysqli_query($conn,"DELETE FROM masuk WHERE idmasuk='$idmasuk'");
  if ($hapus_masuk) {
    $result_ambil_data_stok = mysqli_query($conn, "SELECT jumlahbarang FROM stok WHERE idbarang='$barangnya'");
    $data_stok = mysqli_fetch_assoc($result_ambil_data_stok);
    $jumlah_barang_sekarang = $data_stok['jumlahbarang'];
    $result_tambah_stok_sekarang = $jumlah_barang_sekarang - $_POST['qty'];
    $result_update_stok = mysqli_query($conn, "UPDATE stok SET jumlahbarang='$result_tambah_stok_sekarang' WHERE idbarang='$barangnya'");
    if ($result_update_stok) {
      header('location: barang-masuk.php');
    } else {
      echo 'Gagal mengupdate stok!';
    }
  } else {
    echo 'Gagal menghapus data barang masuk!';
  }
}

// Mengubah Data Barang Masuk
/*
  if(isset($_POST['updatebarangmasuk'])){
    $idbarang = $_POST['idbarang'];
    $idmasuk = $_POST['idmasuk'];
    $namabarang = $_POST['namabarang'];
    $qty = $_POST['qty'];
    $lihatstok = mysqli_query($conn,"SELECT * FROM stok WHERE idbarang='$idbarang'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stoksekarang = $stoknya['stok'];
    $qtysekarang = mysqli_query($conn,"SELECT * FROM masuk WHERE idmasuk='$idmasuk'");
    $qtynya = mysqli_fetch_array($qtysekarang);
    $qtysekarang = $qtynya['qty'];
    if($qty>$qtysekarang){
      $selisih = $qty-$qtysekarang;
      $kurangi = $stoksekarang - $selisih;
      $kurangistok = mysqli_query($conn,"UPDATE stok SET stok='$kurangi' WHERE idbarang='$idbarang'");
      $updatenya = mysqli_query($conn,"UPDATE masuk SET qty='$qty' WHERE idmasuk='$idmasuk'");
      if($kurangistok&&updatenya){
        header('location:barangmasuk.php');
      } else {
        header('location:barangmasuk.php');
      }
    } else {
      $selisih = $qtysekarang-$qty;
      $kurangi = $stoksekarang + $selisih;
      $kurangistok = mysqli_query($conn,"UPDATE stok SET stok='$kurangi' WHERE idbarang='$idbarang'");
      $updatenya = mysqli_query($conn,"UPDATE masuk SET qty='$qty' WHERE idmasuk='$idmasuk'");
      if($kurangistok&&updatenya){
        header('location:barangmasuk.php');
      } else {
        header('location:barangmasuk.php');
      }
    }
  }
*/
if (isset($_POST['updatebarangmasuk'])) {
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
?>
