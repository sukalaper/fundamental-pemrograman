<?php
	include_once '../config/koneksi.php';
	include_once 'class.poskotis.php';
	$ben = new poskotis($pdo);
	$id = $_GET['id_poskotis'];
	$ben->delete($id);
	header('location:data_poskotis.php');
?>