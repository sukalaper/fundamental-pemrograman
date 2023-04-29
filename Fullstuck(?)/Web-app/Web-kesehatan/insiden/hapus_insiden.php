<?php
	include_once '../config/koneksi.php';
	include_once 'class.insiden.php';
	$insiden = new insiden($pdo);
	$id = $_GET['id_insiden'];
	$insiden->delete($id);
	header('location:data_insiden.php');
?>