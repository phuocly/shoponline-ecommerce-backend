<?php 
include('check_login.php');
$id = @$_GET['id'];
if(!empty($id)){
	$sql = "SELECT * FROM khachhang where MaKhachHang = '".$id."'";
	$query = mysql_query($sql);
	$detail = @mysql_fetch_assoc($query);
	if(empty($detail)){
		header('location:'.PATH_ADMIN."?controller=dskhachhang");
		exit;
	}
}
if(!empty($_POST['action_form'])){
	if(empty($_POST['TenKhachHang']) || empty($_POST['SDTKhachHang']) || empty($_POST['DiaChiKhachHang']))
	{
		echo "<script>alert('Bạn chưa nhập đầy đủ thông tin. Hãy nhập đầy đủ thông tin');window.location='".PATH_ADMIN."?controller=formdskhachhang&id=".$id."'</script>";exit;
	}
	else if(strlen($_POST["SDTKhachHang"]) <10 || strlen($_POST["SDTKhachHang"]) >11 || preg_match("/^[a-z]+$/", $_POST["SDTKhachHang"]))
	{
		echo "<script>alert('Bạn nhập số điện thoại chưa đúng. Hãy nhập lại số điện thoại');window.location='".PATH_ADMIN."?controller=formdskhachhang&id=".$id."'</script>";exit;
	}
	else
	{
	unset($_POST['action_form']);unset($_POST['check_inc']);
	$set_update = $value  = $colum = "";
	foreach($_POST as $key => $val)
	{
		if(empty($id)){
			$colum .= $key.",";
			$value .= "'".$val."',";
		}else{
			$set_update .= $key."='".$val."',";
		}
	}
		$makhachhang = "SELECT * FROM ";
		$query = "UPDATE khachhang SET  ".trim($set_update,",")." WHERE MaKhachHang = '".$id."'";
		mysql_query($query);
		echo "<script>alert('Sửa thành công');window.location='".PATH_ADMIN."?controller=dskhachhang'</script>";exit;
	}
}
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2> <?php echo (!empty($id))?"Sửa":""?> Thông Tin Khách Hàng </h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form action="" method="POST" enctype='multipart/form-data'>
					<div class="form-group">
						<label> Tên Khách Hàng </label>
						<input class="form-control" name="TenKhachHang" value="<?php echo @$detail['TenKhachHang']?>" >
					</div>
					<div class="form-group">
						<label> Số Điện Thoại Khách Hàng </label>
						<input class="form-control" name="SDTKhachHang" value="<?php echo @$detail['SDTKhachHang']?>" >
					</div>  
					<div class="form-group">
						<label> Địa Chỉ Khách Hàng </label>
						<input class="form-control" name="DiaChiKhachHang" value="<?php echo @$detail['DiaChiKhachHang']?>" >
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