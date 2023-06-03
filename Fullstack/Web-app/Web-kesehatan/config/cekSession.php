<?php
	session_start();
	if($_SESSION['s_nama']=='' && $_SESSION['s_pass']=='' && 
        $_SESSION['s_level']=='' && $_SESSION['s_user']=='') {
		header("location:login.php");
	}
?>
