<?php
require("includes/config.php");
require("includes/head.php");

$tenkhtim = $_POST['tenkhtim'];
$tenkh = $_POST['tenkh'];
$diachi = $_POST['diachi'];
$sdt = $_POST['sdt'];

if(isset($_POST['ok'])){
	if($tenkh != '' && $diachi != '' && $sdt != ''){
		mysql_query("insert into khachhang(tenkh, diachi, sdt) values('$tenkh', '$diachi', '$sdt')");
		echo "<div class='loithe'> Thêm Khách Hàng ".$tenkh." Thành Công :)</div>";
	}
}

?>

<form action="khach-hang.php" method="post" enctype="multipart/form-data">
  <div class="wrap">
		<div class="avatar">
			Khách Hàng
		</div>
		<input type="text" name="tenkh" placeholder="Tên Khách Hàng" required value="<?php echo $_POST['tenkh']; ?>">
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="diachi" placeholder="Địa Chỉ" required value="<?php echo $_POST['diachi']; ?>">
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="sdt" placeholder="Số Điện Thoại" required value="<?php echo $_POST['sdt']; ?>">
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

<form action="khach-hang.php" method="post" enctype="multipart/form-data">
	<div class="field" id="searchform">
	  <input type="text" name="tenkhtim" placeholder="Nhập Tên Khách Hàng Cần Tìm?" />
	  <button type="submit" name="oktim">Tìm Kiếm</button>
	</div>
</form>

<script class="cssdeck" src="js/jquery.min.js"></script>

<table width="100%" align="center">
	<tr>
		<th>Mã Khách Hàng</th>
        <th>Tên Khách Hàng</th>
        <th>Địa Chỉ</th>
        <th>Số Điện Thoại</th>
		<th>Sửa</th>
        <th>Xóa</th>
    </tr>
	
<?php
	if(isset($_POST['oktim'])){
		$sql="select * from khachhang where TenKH like '%$tenkhtim%' order by MaKH ASC";
		$query=mysql_query($sql);
	}else{
		$sql="select * from khachhang order by MaKH ASC";
		$query=mysql_query($sql);
	}
	if(mysql_num_rows($query) == 0){
		echo "<tr>";
		echo "<td colspan='13'><b>Không Có Dữ Liệu!</b></td>";
		echo "</tr>";
	}else{
		while($data=mysql_fetch_assoc($query)){
			echo "<tr>";
				echo "<td>$data[MaKH]</td>";
				echo "<td>$data[TenKH]</td>";
				echo "<td>$data[DiaChi]</td>";
				echo "<td>$data[SDT]</td>";
				echo "<td><a href='sua-khach-hang.php?makh=$data[MaKH]'>Sửa</a></td>";
				echo "<td><a href='xoa-khach-hang.php?makh=$data[MaKH]' onclick='return xacnhan();'>Xóa</a></td>";
			echo "</tr>";
		}
	}
?>
	
</table>



<script src="js/index.js"></script>

<?php
require("includes/end.php");
?>