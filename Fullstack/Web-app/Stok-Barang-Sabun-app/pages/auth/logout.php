<?php
session_start();
session_destroy();
header('location:../../pages/auth/logout.php');
?>
