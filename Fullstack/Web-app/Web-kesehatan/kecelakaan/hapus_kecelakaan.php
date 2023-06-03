<?php
	include_once '../config/koneksi.php';
	include_once 'class.kecelakaan.php';
	$kecelakaan = new kecelakaan($pdo);
	$id = $_GET['id_kecelakaan'];
	$kecelakaan->delete($id);
	header('location:data_kecelakaan.php');
?>