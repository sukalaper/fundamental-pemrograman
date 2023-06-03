<?php
	include_once '../config/koneksi.php';
	include_once 'class.rujuk.php';
	$rujuk = new rujuk($pdo);
	$id = $_GET['id_rujuk'];
	$rujuk->delete($id);
	header('location:data_rujuk.php');
?>