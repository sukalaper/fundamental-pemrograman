<?php
session_start();
#echo "FILES =".json_encode($_FILES)."<br><br>";
#echo "POST =".json_encode($_POST)."<br>";
include_once '../config/koneksi.php';
include_once 'class.user.php';
$user = new user($pdo);
if(!empty($_POST['username'])){
	$username		= $_POST['username'];
	if ($_POST['password'] == ""){
		$password	= $_POST['password1'];
	}else{
		$password 	= md5($_POST['password']);
	}
	$nama_lengkap	= $_POST['nama_lengkap'];
	$email 			= $_POST['email'];
	$no_telp		= $_POST['no_telp'];
	$level 			= $_POST['level'];
	$blokir 		= $_POST['blokir'];
	$poskotis		= $_POST['poskotis'];
	if ($_FILES['file']['name'] == ""){
		$file_name 	= $_POST['file1'];
	}else{
		$file_name  = basename($_FILES['file']['name']);
	}
    $size_file      = $_FILES['file']['size'];
    $type_file      = $_FILES['file']['type'];
    $uploaddir 		= '../user/img_user/';
    $alamatfile 	= $uploaddir . $file_name;
    move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile);

	if($user->update($username,$password,$nama_lengkap,$email,$no_telp,$level,$blokir,$file_name,$poskotis)){
		$sg   = "ok";
		$msg1 = "Data Berhasil Di Update";
		$alert='alert-success';
	}else{
		$g = "err";
		$msg2 = "Data Gagal Di Update";
		$alert='alert-error';
	}
	if(isset($sg) and $sg=='ok'){
		echo "
		<div id='alert' class='alert $alert'>
		<button type='button' class='close' data-dismiss='alert'>&times;</button>
		$msg1
		</div>";
	}elseif(isset($sg) and $sg=='err'){
		echo "
		<div id='alert' class='alert $alert'>
		<button type='button' class='close' data-dismiss='alert'>&times;</button>
		$msg2
		</div>";}
}

?>