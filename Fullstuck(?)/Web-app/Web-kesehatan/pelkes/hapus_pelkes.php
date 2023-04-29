<?php
	include_once '../config/koneksi.php';
	include_once 'class.pelkes.php';
	$pelkes = new pelkes($pdo);
	$id = $_GET['id_pelkes'];
	$pelkes->delete($id);
	header('location:data_pelkes.php');
?>