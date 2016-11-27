<?php
require("includes/config.php");
require("includes/head.php");

$masp = $_POST['masp'];
$masptim = $_POST['masptim'];
$tensp = $_POST['tensp'];
$giasp = $_POST['giasp'];
$soluongsp = $_POST['soluongsp'];
$mota = $_POST['mota'];
$malsp = $_POST['malsp'];

if(isset($_POST['ok'])){
	if($malsp == "0"){
		echo "<div class='loithe'><img src='images/error.png' width='20px' height='20px'/> Vui Lòng Chọn Loại Sản Phẩm</div>";
	}else{
		if($masp != '' && $giasp != '' && $tensp != '' && $soluongsp != '' && $mota != '' && $malsp != ''){
			mysql_query("update sanpham set TenSP='$tensp', GiaSP='$giasp', SoLuongSP='$soluongsp', MoTa='$mota', MaLSP='$malsp' where MaSP='$masp'");
			header("location:san-pham.php");
			exit();
		}
	}
}
$sql="select * from sanpham where MaSP='$_GET[masp]'";
$query=mysql_query($sql);
$data=mysql_fetch_assoc($query);
?>

<form action="sua-san-pham.php" method="post" enctype="multipart/form-data">
  <div class="wrap">
		<div class="avatar">
			Giày
		</div>
		<input type="text" name="masp" placeholder="Mã Sản Phẩm" required readonly="false" value="<?php echo $data['MaSP']." (Không Sửa)"; ?>" style="color:#888888;">
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="tensp" placeholder="Tên Sản Phẩm" required value="<?php echo $data['TenSP']; ?>">
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="giasp" placeholder="Giá Sản Phẩm" required value="<?php echo $data['GiaSP']; ?>">
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="soluongsp" placeholder="Số Lượng Sản Phẩm" required value="<?php echo $data['SoLuongSP']; ?>">
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="mota" placeholder="Mô Tả" required value="<?php echo $data['MoTa']; ?>">
		<div class="bar">
			<i></i>
		</div>
		<select name="malsp" >
			<option value="0">-- Loại Giày --</option>
			<?php
				$sql2="select * from loaisanpham;";
				$query2=mysql_query($sql2);
				while($data2=mysql_fetch_assoc($query2)){
					if($data['MaLSP'] == $data2[MaLSP])
						echo "<option value='$data2[MaLSP]' selected>$data2[TenLSP]</option>";
					else
						echo "<option value='$data2[MaLSP]'>$data2[TenLSP]</option>";
				}
			?>
		</select> 

			<br/>
		<button type="submit" name="ok">Sửa</button>
	</div>
</form>

<?php
require("includes/end.php");
?>