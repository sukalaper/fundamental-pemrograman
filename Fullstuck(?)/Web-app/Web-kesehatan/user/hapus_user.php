<?php
	include_once '../config/koneksi.php';
	include_once 'class.user.php';
	$user = new user($pdo);
	$id = $_GET['username'];
	$user->delete($id);
	header('location:data_user.php');
	
?>