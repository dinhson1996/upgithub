<?php
require("includes/config.php");

$mahd = $_GET['mahd'];

if($mahd != ''){
	mysql_query("delete from chitiethoadon where MaHD='$mahd'");
	header("location:chi-tiet-hoa-don.php");
	exit();
}
?>