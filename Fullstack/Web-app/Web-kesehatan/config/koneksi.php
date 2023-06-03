<?php
	$DB_host = "localhost"; // SERVER
	$DB_user = "root"; // USER DATA BASE SERVER
	$DB_pass = ""; // PASWORD SERVER
	$DB_name = "simpb"; // NAMA DATA BASE

	// KONEKSI PDO MYSQL
	try
	{
		$pdo= new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	// Mengambil class CRUD 	
?>
