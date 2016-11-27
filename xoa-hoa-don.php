<?php
require("includes/config.php");

$mahd = $_GET['mahd'];

if($mahd != ''){
	mysql_query("delete from hoadon where MaHD='$mahd'");
	header("location:hoa-don.php");
	exit();
}
?>