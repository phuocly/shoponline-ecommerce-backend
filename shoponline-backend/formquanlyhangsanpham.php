<?php 
include('check_login.php');
$id = @$_GET['id'];
if(!empty($id)){
	$sql = "SELECT * FROM hangsanpham where MaHangSanPham = '".$id."'";
	$query = mysql_query($sql);
	$detail = @mysql_fetch_assoc($query);
	if(empty($detail)){
		header('location:'.PATH_ADMIN."?controller=quanlyhangsanpham");
		exit;
	}
}
if(!empty($_POST['action_form'])){
	if(empty($_POST['TenHangSanPham']) )
	{
		echo "<script>alert('Bạn chưa nhập đầy đủ thông tin. Hãy nhập đầy đủ thông tin');window.location='".PATH_ADMIN."?controller=formquanlyhangsanpham&id=".$id."'</script>";exit;
	}
	else
	{
	unset($_POST['action_form']);unset($_POST['check_inc']);
	$set_update = $value  = $colum = "";
	foreach($_POST as $key => $val){
		if(empty($id)){
			$colum .= $key.",";
			$value .= "'".$val."',";
		}else{
			$set_update .= $key."='".$val."',";
		}
	}
	if(empty($id)){
			$mahangsanpham = "SELECT * FROM ";
			$query = "INSERT INTO hangsanpham (".trim($colum,",").") VALUES (".trim($value,",").")";
			mysql_query($query);
			echo "<script>alert('Tạo thành công');window.location='".PATH_ADMIN."?controller=quanlyhangsanpham'</script>";exit;		
	}
	else{
		$query = "UPDATE hangsanpham SET  ".trim($set_update,",")." WHERE MaHangSanPham = '".$id."'";
		mysql_query($query);
		echo "<script>alert('Sửa thành công');window.location='".PATH_ADMIN."?controller=quanlyhangsanpham'</script>";exit;		
	}
	}
}

?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2> <?php echo (!empty($id))?"Sửa":"Thêm"?> Hãng Sản Phẩm </h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form action="" method="POST" enctype='multipart/form-data'>
					<div class="form-group">
						<label> Tên Hãng Sản Phẩm </label>
						<input class="form-control" name="TenHangSanPham" value="<?php echo @$detail['TenHangSanPham']?>" >
					</div>
					<div class="form-group">
						<input type='hidden' name="action_form" value="1">
						<input class="btn btn-default" type="submit" value="Lưu dữ liệu">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	CKEDITOR.replace("noidung");
});
</script>