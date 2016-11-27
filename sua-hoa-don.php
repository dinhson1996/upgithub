<?php
require("includes/config.php");
require("includes/head.php");

$makh = $_POST['makh'];
$mahd = $_GET['mahd'];

date_default_timezone_set('Asia/Ho_Chi_Minh');
$time = time();

$result = mysql_query("SHOW TABLE STATUS WHERE `Name` = 'hoadon'");
$data = mysql_fetch_assoc($result);
$next_increment = $data['Auto_increment'];

if(isset($_POST['ok'])){
	if($makh == "0"){
		echo "<div class='loithe'><img src='images/error.png' width='20px' height='20px'/> Vui Lòng Chọn Khách Hàng</div>";
	}else{
		mysql_query("update hoadon set NgayTao='$time', MaKH='$makh' where MaHD='$mahd'");
		header("location:hoa-don.php");
		exit();
	}
}

?>

<form action="sua-hoa-don.php?mahd=<?php echo $_GET[mahd]; ?>" method="post" enctype="multipart/form-data">
  <div class="wrap">
		<div class="avatar">
			Hóa Đơn
		</div>
		<select name="makh" >
			<option value="0">-- Khách Hàng --</option>
			<?php
				$sql2="select * from khachhang";
				$query2=mysql_query($sql2);
				$sql3="select * from hoadon where MaHD='$_GET[mahd]'";
				$query3=mysql_query($sql3);
				$data3=mysql_fetch_assoc($query3);
				while($data2=mysql_fetch_assoc($query2)){
					if($data2['MaKH'] == $data3['MaKH'])
						echo "<option value='$data2[MaKH]' selected>$data2[TenKH]</option>";	
					else
						echo "<option value='$data2[MaKH]'>$data2[TenKH]</option>";	
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