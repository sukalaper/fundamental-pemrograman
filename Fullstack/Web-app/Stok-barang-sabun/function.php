<?php
// Untuk debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Sesi 
session_start();
// Koneksi ke database
$conn = mysqli_connect("localhost","root","","stok-barang");
// Menambah barang baru
  if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $satuanberat = $_POST['satuanberat'];
    $jumlahbarang = $_POST['jumlahbarang'];
    $result = mysqli_query($conn, "INSERT INTO stok (namabarang, satuanberat, jumlahbarang) VALUES ('$namabarang','$satuanberat','$jumlahbarang')");
    if($result){
      header('location:index.php');
    } else {
      header('location:index.php');
    }
  };    
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
    $satuanberat = $_POST['satuanberat'];
    $update = mysqli_query($conn,"UPDATE stok SET idbarang='$idbarang', namabarang='$namabarang', satuanberat='$satuanberat' WHERE idbarang ='$idbarang'");
    if($update){
      header('location:index.php');
    } else {
      echo 'Gagal!';
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
?>
