<?php
//kết nối với db
require("includes/config.php");
//sử dụng code của head.php
require("includes/head.php");

//lấy dữ liệu trong input text nhập
$tenlsptim = $_POST['tenlsptim'];
$tenlsp = $_POST['tenlsp'];

//kiểm tra khi người dùng ấn button thêm thì tiến hành thêm dữ liệu vào db
if(isset($_POST['ok'])){
	if($tenlsp != ''){
		mysql_query("insert into loaisanpham(TenLSP) values('$tenlsp')");
		echo "<div class='loithe'> Thêm Tên Loại Sản Phẩm ".$tenlsp." Thành Công :)</div>";
	}
}

?>

<!--Form nhập dữ liệu -->
<form action="index.php" method="post" enctype="multipart/form-data">
  <div class="wrap">
		<div class="avatar">
			Loại giày
		</div>
		<input type="text" name="tenlsp" placeholder="Tên Loại Sản Phẩm" required value="<?php echo $_POST['tenlsp']; ?>">
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

<!--form của tìm kiếm-->
<form action="index.php" method="post" enctype="multipart/form-data">
	<div class="field" id="searchform">
	  <input type="text" name="tenlsptim" placeholder="Nhập Tên Loại Sản Phẩm Cần Tìm?" />
	  <button type="submit" name="oktim">Tìm Kiếm</button>
	</div>
</form>

<script class="cssdeck" src="js/jquery.min.js"></script>

<!--hiển thị dữ liệu trong bảng-->
<table width="100%" align="center">
	<tr>
		<th>Mã Loại Giày</th>
        <th>Tên Loại Giày</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
	
<?php
//lấy dữ liệu theo dữ liệu mình nhập vào ô tìm kiếm khi mình ấn nút Tìm Kiếm
	if(isset($_POST['oktim'])){
		$sql="select * from loaisanpham where TenLSP like '%$tenlsptim%' order by MaLSP ASC";
		$query=mysql_query($sql);
	//lấy tất cả dữ liệu của bảng
	}else{
		$sql="select * from loaisanpham order by MaLSP ASC";
		$query=mysql_query($sql);
	}
	//khi ko có dữ liệu sẽ hiển thị không có dữ liệu
	if(mysql_num_rows($query) == 0){
		echo "<tr>";
		echo "<td colspan='13'><b>Không Có Dữ Liệu!</b></td>";
		echo "</tr>";
	}else{
		//vòng lặp để lấy toàn bộ dữ liệu và hiển thị
		while($data=mysql_fetch_assoc($query)){
			echo "<tr>";
				echo "<td>$data[MaLSP]</td>";
				echo "<td>$data[TenLSP]</td>";
				echo "<td><a href='sua-loai-san-pham.php?malsp=$data[MaLSP]'>Sửa</a></td>";
				echo "<td><a href='xoa-loai-san-pham.php?malsp=$data[MaLSP]' onclick='return xacnhan();'>Xóa</a></td>";
			echo "</tr>";
		}
	}
?>
	
</table>

<script src="js/index.js"></script>

<?php
//sử dụng code của end.php
require("includes/end.php");
?>