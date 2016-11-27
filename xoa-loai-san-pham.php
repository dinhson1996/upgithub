<?php
require("includes/config.php");

//lấy malsp ở url
$malsp = $_GET['malsp'];

if($masp != ''){
	//xóa dữ liệu theo malsp
	mysql_query("delete from loaisanpham where MaLSP='$malsp'");
	header("location:index.php");
	exit();
}
?>