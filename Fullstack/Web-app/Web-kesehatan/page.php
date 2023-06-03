<?php
$page=$_GET['page'];
$path=$page.".php";
if(file_exists($path)){
include $path;
}else{
echo "
	<div class='alert'>
	<button type='button' class='close' data-dismiss='alert'>&times;</button>
	<strong>Warning!</strong> Page $page not found
	</div>";
}
?>