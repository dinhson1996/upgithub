<?php
require("includes/config.php");
require("includes/head.php");

$tenkhtim = $_POST['tenkhtim'];
$mahd = $_POST['mahd'];
$masp = $_POST['masp'];
$soluongmua = $_POST['soluongmua'];

date_default_timezone_set('Asia/Ho_Chi_Minh');

$result = mysql_query("SHOW TABLE STATUS WHERE `Name` = 'hoadon'");
$data = mysql_fetch_assoc($result);
$next_increment = $data['Auto_increment'];


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
			mysql_query("insert into chitiethoadon(SoLuongMua, DonGia, MaHD, MaSP) values('$soluongmua', '$dongia', '$mahd', '$masp')");
			echo "<div class='loithe'> Thêm Chi Tiết Hóa Đơn ".$mahd." Thành Công :)</div>";
		}
	}
}

?>

<form action="chi-tiet-hoa-don.php" method="post" enctype="multipart/form-data">
  <div class="wrap">
		<div class="avatar">
			Chi Tiết Hóa Đơn
		</div>
		<select name="mahd" >
			<option value="0">-- Hóa Đơn --</option>
			<?php
				$sql2="select * from hoadon inner join khachhang on hoadon.MaKH=khachhang.MaKH";
				$query2=mysql_query($sql2);
				while($data2=mysql_fetch_assoc($query2)){
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
				$sql3="select * from sanpham;";
				$query3=mysql_query($sql3);
				while($data3=mysql_fetch_assoc($query3)){
					echo "<option value='$data3[MaSP]'>$data3[TenSP]</option>";	
				}
			?>
		</select> 
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="soluongmua" placeholder="Số Lượng Mua" required value="<?php echo $_POST['soluongmua']; ?>">
			<br/>
		<button type="submit" name="ok">Thêm</button>
	</div>
</form>

<br/>

<script>
function xacnhan(){
	if(!window.confirm("Bạn có muốn xóa không?")){
		return false;
	}else{
		return true;
	}	
}
</script>

<link rel="stylesheet" href="css/stylesearch.css" type="text/css" />

<form action="chi-tiet-hoa-don.php" method="post" enctype="multipart/form-data">
	<div class="field" id="searchform">
	  <input type="text" name="tenkhtim" placeholder="Nhập Tên Khách Hàng Cần Tìm?" />
	  <button type="submit" name="oktim">Tìm Kiếm</button>
	</div>
</form>

<script class="cssdeck" src="js/jquery.min.js"></script>

<table width="100%" align="center">
	<tr>
        <th>Mã Hóa Đơn</th>
		<th>Ngày Tạo</th>
        <th>Tên Khách Hàng</th>
        <th>Tên Giày</th>
		<th>Số Lượng</th>
		<th>Đơn Giá</th>
		<th>Sửa</th>
        <th>Xóa</th>
    </tr>
	
<?php
	if(isset($_POST['oktim'])){
		$sql="select * from hoadon inner join chitiethoadon on hoadon.MaHD=chitiethoadon.MaHD inner join khachhang on hoadon.MaKH=khachhang.MaKH inner join sanpham on sanpham.MaSP=chitiethoadon.MaSP inner join loaisanpham on loaisanpham.MaLSP=sanpham.MaLSP where TenKH like '%$tenkhtim%' order by ID ASC";
		$query=mysql_query($sql);
	}else{
		$sql="select * from hoadon inner join chitiethoadon on hoadon.MaHD=chitiethoadon.MaHD inner join khachhang on hoadon.MaKH=khachhang.MaKH inner join sanpham on sanpham.MaSP=chitiethoadon.MaSP inner join loaisanpham on loaisanpham.MaLSP=sanpham.MaLSP order by ID ASC";
		$query=mysql_query($sql);
	}
	if(mysql_num_rows($query) == 0){
		echo "<tr>";
		echo "<td colspan='13'><b>Không Có Dữ Liệu!</b></td>";
		echo "</tr>";
	}else{
		while($data=mysql_fetch_assoc($query)){
			echo "<tr>";
				echo "<td>$data[MaHD]</td>";
				echo "<td>".date('H:i:s', $data[NgayTao])."<br/>".date('d-m-Y', $data[NgayTao])."</td>";
				echo "<td>$data[TenKH]</td>";
				echo "<td>$data[TenSP]</td>";
				echo "<td>$data[SoLuongMua]</td>";
				echo "<td>".number_format($data[DonGia])." VNĐ</td>";
				echo "<td><a href='sua-chi-tiet-hoa-don.php?id=$data[ID]'>Sửa</a></td>";
				echo "<td><a href='xoa-chi-tiet-hoa-don.php?id=$data[ID]' onclick='return xacnhan();'>Xóa</a></td>";
			echo "</tr>";
		}
	}
?>
	
</table>



<script src="js/index.js"></script>

<?php
require("includes/end.php");
?>