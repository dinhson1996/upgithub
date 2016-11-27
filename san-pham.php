<?php
require("includes/config.php");
require("includes/head.php");

$tensptim = $_POST['tensptim'];
$tensp = $_POST['tensp'];
$giasp = $_POST['giasp'];
$soluongsp = $_POST['soluongsp'];
$mota = $_POST['mota'];
$malsp = $_POST['malsp'];

if(isset($_POST['ok'])){
	if($malsp == "0"){
		echo "<div class='loithe'><img src='images/error.png' width='20px' height='20px'/> Vui Lòng Chọn Loại Sản Phẩm</div>";
	}else{
		if($tensp != '' && $giasp != '' && $soluongsp != '' && $mota != '' && $malsp != ''){
			mysql_query("insert into sanpham(TenSP, GiaSP, SoLuongSP, MoTa, MaLSP) values('$tensp', '$giasp', '$soluongsp', '$mota', '$malsp')");
			echo "<div class='loithe'> Thêm Tên Sản Phẩm ".$tensp." Thành Công :)</div>";
		}
	}
}

?>

<form action="san-pham.php" method="post" enctype="multipart/form-data">
  <div class="wrap">
		<div class="avatar">
			Giày
		</div>
		<input type="text" name="tensp" placeholder="Tên Sản Phẩm" required value="<?php echo $_POST['tensp']; ?>">
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="giasp" placeholder="Giá Sản Phẩm" required value="<?php echo $_POST['giasp']; ?>">
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="soluongsp" placeholder="Số Lượng Sản Phẩm" required value="<?php echo $_POST['soluongsp']; ?>">
		<div class="bar">
			<i></i>
		</div>
		<input type="text" name="mota" placeholder="Mô Tả" required value="<?php echo $_POST['mota']; ?>">
		<div class="bar">
			<i></i>
		</div>
		<select name="malsp" >
			<option value="0">-- Loại Giày --</option>
			<?php
				$sql2="select * from loaisanpham;";
				$query2=mysql_query($sql2);
				while($data2=mysql_fetch_assoc($query2)){
					echo "<option value='$data2[MaLSP]'>$data2[TenLSP]</option>";	
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

<form action="san-pham.php" method="post" enctype="multipart/form-data">
	<div class="field" id="searchform">
	  <input type="text" name="tensptim" placeholder="Nhập Tên Sản Phẩm Cần Tìm?" />
	  <button type="submit" name="oktim">Tìm Kiếm</button>
	</div>
</form>

<script class="cssdeck" src="js/jquery.min.js"></script>

<table width="100%" align="center">
	<tr>
        <th>Mã Giày</th>
        <th>Tên Giày</th>
		<th>Giá Giày</th>
        <th>Số Lượng Giày</th>
		<th>Mô Tả</th>
		<th>Tên Loại Giày</th>
		<th>Sửa</th>
        <th>Xóa</th>
    </tr>
	
<?php
	if(isset($_POST['oktim'])){
		$sql="select * from sanpham inner join loaisanpham on sanpham.MaLSP=loaisanpham.MaLSP where sanpham.TenSP like '%$tensptim%' order by MaSP ASC";
		$query=mysql_query($sql);
	}else{
		$sql="select * from sanpham inner join loaisanpham on sanpham.MaLSP=loaisanpham.MaLSP order by MaSP ASC";
		$query=mysql_query($sql);
	}
	if(mysql_num_rows($query) == 0){
		echo "<tr>";
		echo "<td colspan='13'><b>Không Có Dữ Liệu!</b></td>";
		echo "</tr>";
	}else{
		while($data=mysql_fetch_assoc($query)){
			echo "<tr>";
				echo "<td>$data[MaSP]</td>";
				echo "<td>$data[TenSP]</td>";
				echo "<td>".number_format($data[GiaSP])." VNĐ</td>";
				echo "<td>$data[SoLuongSP]</td>";
				echo "<td>$data[MoTa]</td>";
				echo "<td>$data[TenLSP]</td>";
				echo "<td><a href='sua-san-pham.php?masp=$data[MaSP]'>Sửa</a></td>";
				echo "<td><a href='xoa-san-pham.php?masp=$data[MaSP]' onclick='return xacnhan();'>Xóa</a></td>";
			echo "</tr>";
		}
	}
?>
	
</table>



<script src="js/index.js"></script>

<?php
require("includes/end.php");
?>