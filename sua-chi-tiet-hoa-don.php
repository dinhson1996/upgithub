<?php
require("includes/config.php");
require("includes/head.php");

$id = $_GET['id'];
$mahd = $_POST['mahd'];
$masp = $_POST['masp'];
$soluongmua = $_POST['soluongmua'];
$dongia = $_POST['dongia'];

date_default_timezone_set('Asia/Ho_Chi_Minh');

if(isset($_POST['ok'])){
	
	$sql="select * from sanpham where sanpham.MaSP='$masp'";
	$query=mysql_query($sql);
	$data=mysql_fetch_assoc($query);
	$dongia = $soluongmua*$data['GiaSP'];
	
	if($mahd == "0"){
		echo "<div class='loithe'><img src='images/error.png' width='20px' height='20px'/> Vui Lòng Chọn Khách Hàng</div>";
	}else if($masp == "0"){
		echo "<div class='loithe'><img src='images/error.png' width='20px' height='20px'/> Vui Lòng Chọn Sản Phẩm</div>";
	}else{
		if($soluongmua != '' && $dongia != ''){
			mysql_query("update chitiethoadon set SoLuongMua='$soluongmua', DonGia='$dongia', MaHD='$mahd', MaSP='$masp' where id='$id'");
			header("location:chi-tiet-hoa-don.php");
			exit();
		}
	}
}
$sql="select * from chitiethoadon where ID='$id'";
$query=mysql_query($sql);
$data=mysql_fetch_assoc($query);
?>

<form action="sua-chi-tiet-hoa-don.php?id=<?php echo $_GET[id]; ?>" method="post" enctype="multipart/form-data">
  <div class="wrap">
		<div class="avatar">
			Chi Tiết Hóa Đơn
		</div>
		<select name="mahd" >
			<option value="0">-- Hóa Đơn --</option>
			<?php
				$sql2="select * from hoadon inner join khachhang on hoadon.MaKH=khachhang.MaKH";
				$query2=mysql_query($sql2);
				$sql3="select * from chitiethoadon where ID='$id'";
				$query3=mysql_query($sql3);
				$data3=mysql_fetch_assoc($query3);
				while($data2=mysql_fetch_assoc($query2)){
					if($data2['MaHD'] == $data3['MaHD'])
						echo "<option value='$data2[MaHD]' selected>(".date('H:i:s', $data2[NgayTao])." ".date('d-m', $data2[NgayTao]).") $data2[TenKH]</option>";	
					else
						echo "<option value='$data2[MaHD]'>(".date('H:i:s', $data2[NgayTao])." ".date('d-m', $data2[NgayTao]).") $data2[TenKH]</option>";
				}
			?>
		</select> 
		<div class="bar">
			<i></i>
		</div>
		<select name="masp" >
			<option value="0">-- Giày --</option>
			<?php
				$sql2="select * from sanpham";
				$query2=mysql_query($sql2);
				$sql3="select * from chitiethoadon inner join sanpham on sanpham.MaSP=chitiethoadon.MaSP where chitiethoadon.ID='$id'";
				$query3=mysql_query($sql3);
				$data3=mysql_fetch_assoc($query3);
				while($data2=mysql_fetch_assoc($query2)){
					if($data2['MaSP'] == $data3['MaSP'])
						echo "<option value='$data2[MaSP]' selected>$data2[TenSP]</option>";	
					else
						echo "<option value='$data2[MaSP]'>$data2[TenSP]</option>";
				}
			?>
		</select> 
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="soluongmua" placeholder="Số Lượng Mua" required value="<?php echo $data['SoLuongMua']; ?>">
			<br/>
		<button type="submit" name="ok">Sửa</button>
	</div>
</form>

<?php
require("includes/end.php");
?>