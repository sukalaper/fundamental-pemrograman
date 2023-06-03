<?php
	include_once '../config/koneksi.php';
	include_once 'class.insiden.php';
	$insiden = new insiden($pdo);
	$id = $_GET['id_detail_insiden'];
	$insiden->deleteDetail($id);
	header('location:data_insiden.php');
?>