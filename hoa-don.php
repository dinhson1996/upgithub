<?php
require("includes/config.php");
require("includes/head.php");

$makh = $_POST['makh'];
$tenkhtim = $_POST['tenkhtim'];

date_default_timezone_set('Asia/Ho_Chi_Minh');
$time = time();

$result = mysql_query("SHOW TABLE STATUS WHERE `Name` = 'hoadon'");
$data = mysql_fetch_assoc($result);
$next_increment = $data['Auto_increment'];

if(isset($_POST['ok'])){
	if($makh == "0"){
		echo "<div class='loithe'><img src='images/error.png' width='20px' height='20px'/> Vui Lòng Chọn Khách Hàng</div>";
	}else{
		if($makh != ''){
			mysql_query("insert into hoadon(NgayTao, MaKH) values('$time', '$makh')");
			echo "<div class='loithe'> Thêm Hóa Đơn ".$next_increment." Thành Công :)</div>";
		}
	}
}

?>

<form action="hoa-don.php" method="post" enctype="multipart/form-data">
  <div class="wrap">
		<div class="avatar">
			Hóa Đơn
		</div>
		<select name="makh" >
			<option value="0">-- Khách Hàng --</option>
			<?php
				$sql2="select * from khachhang;";
				$query2=mysql_query($sql2);
				while($data2=mysql_fetch_assoc($query2)){
					echo "<option value='$data2[MaKH]'>$data2[TenKH]</option>";	
				}
			?>
		</select>
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

<form action="hoa-don.php" method="post" enctype="multipart/form-data">
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
		<th>Sửa</th>
        <th>Xóa</th>
    </tr>
	
<?php
	if(isset($_POST['oktim'])){
		$sql="select * from hoadon inner join khachhang on hoadon.MaKH=khachhang.MaKH where khachhang.TenKH like '%$tenkhtim%' order by MaHD ASC";
		$query=mysql_query($sql);
	}else{
		$sql="select * from hoadon inner join khachhang on hoadon.MaKH=khachhang.MaKH order by MaHD ASC";
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
				echo "<td><a href='sua-hoa-don.php?mahd=$data[MaHD]'>Sửa</a></td>";
				echo "<td><a href='xoa-hoa-don.php?mahd=$data[MaHD]' onclick='return xacnhan();'>Xóa</a></td>";
			echo "</tr>";
		}
	}
?>
	
</table>



<script src="js/index.js"></script>

<?php
require("includes/end.php");
?>