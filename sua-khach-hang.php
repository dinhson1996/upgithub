<?php
require("includes/config.php");
require("includes/head.php");

$makh = $_POST['makh'];
$tenkhtim = $_POST['tenkhtim'];
$tenkh = $_POST['tenkh'];
$diachi = $_POST['diachi'];
$sdt = $_POST['sdt'];

if(isset($_POST['ok'])){
	if($tenkh != '' && $diachi != '' && $sdt != ''){
		mysql_query("update khachhang set TenKH='$tenkh', DiaChi='$diachi', SDT='$sdt' where MaKH='$makh'");
		header("location:khach-hang.php");
		exit();
	}
}
$sql="select * from khachhang where MaKH='$_GET[makh]'";
$query=mysql_query($sql);
$data=mysql_fetch_assoc($query);
?>

<form action="sua-khach-hang.php" method="post" enctype="multipart/form-data">
  <div class="wrap">
		<div class="avatar">
			Khách Hàng
		</div>
		<input type="text" name="makh" placeholder="Mã Khách Hàng" required value="<?php echo $data['MaKH']." (Không Sửa)"; ?>" style="color:#888888;">
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="tenkh" placeholder="Tên Khách Hàng" required value="<?php echo $data['TenKH']; ?>">
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="diachi" placeholder="Địa Chỉ" required value="<?php echo $data['DiaChi']; ?>">
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="sdt" placeholder="Số Điện Thoại" required value="<?php echo $data['SDT']; ?>">
			<br/>
		<button type="submit" name="ok">Sửa</button>
	</div>
</form>

<?php
require("includes/end.php");
?>