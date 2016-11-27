<?php
require("includes/config.php");

$makh = $_GET['makh'];

if($makh != ''){
	mysql_query("delete from khachhang where MaKH='$makh'");
	header("location:khach-hang.php");
	exit();
}
?>