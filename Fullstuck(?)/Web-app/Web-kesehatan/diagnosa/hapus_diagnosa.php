<?php
	include_once '../config/koneksi.php';
	include_once 'class.diagnosa.php';
	$diag = new diagnosa($pdo);
	$id = $_GET['id_diagnosa'];
	$diag->delete($id);
	header('location:data_diagnosa.php');
?>