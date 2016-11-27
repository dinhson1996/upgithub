<?php
require("includes/config.php");

$masp = $_GET['masp'];

if($masp != ''){
	mysql_query("delete from sanpham where MaSP='$masp'");
	header("location:san-pham.php");
	exit();
}
?>