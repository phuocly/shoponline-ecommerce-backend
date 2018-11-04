<?php 
include('check_login.php');
$id = @$_GET['id'];
if(!empty($id)){
	$sql = "SELECT khuyenmai.*, chitietkhuyenmai.* FROM khuyenmai, chitietkhuyenmai WHERE MaChiTietKhuyenMai = '".$id."' AND khuyenmai.MaKhuyenMai = chitietkhuyenmai.MaKhuyenMai ";
	$query = mysql_query($sql);
	$detail = @mysql_fetch_assoc($query);
	if(empty($detail)){
		header('location:'.PATH_ADMIN."?controller=quanlykhuyenmai");
		exit;
	}
}
if(!empty($_POST['action_form'])){
	if(empty($_POST['TenKhuyenMai']) || empty($_POST['GiaGiam']) || empty($_POST['NgayBatDau']) || empty($_POST['NgayKetThuc']))
	{
		echo "<script>alert('Bạn chưa nhập đầy đủ thông tin. Hãy nhập đầy đủ thông tin');window.location='".PATH_ADMIN."?controller=formquanlykhuyenmai&id=".$id."'</script>";exit;
	}
	else
	{
	unset($_POST['action_form']);unset($_POST['check_inc']);
	$set_update = $value  = $colum = "";
	
	if(empty($id)){
			$mahangsanpham = "SELECT * FROM ";
			$query1 = "INSERT INTO khuyenmai(TenKhuyenMai) VALUES ('".$_POST['TenKhuyenMai']."')";
			mysql_query($query1);			
			$query2 = "INSERT INTO chitietkhuyenmai (MaKhuyenMai,MaSanpham,GiaGiam,NgayBatDau,NgayKetThuc) VALUES (".mysql_insert_id().",'".$_POST['MaSanPham']."','".$_POST['GiaGiam']."','".$_POST['NgayBatDau']."','".$_POST['NgayKetThuc']."')";		
			mysql_query($query2);
			echo "<script>alert('Tạo thành công');window.location='".PATH_ADMIN."?controller=quanlykhuyenmai'</script>";exit;		
	}
	else{
		$query1 = "UPDATE khuyenmai SET TenKhuyenMai='".$_POST['TenKhuyenMai']."' WHERE MaKhuyenMai = '".@$detail['MaKhuyenMai']."'";
		mysql_query($query1);
		$query2 = "UPDATE chitietkhuyenmai SET MaSanPham='".$_POST['MaSanPham']."', GiaGiam='".$_POST['GiaGiam']."', NgayBatDau='".$_POST['NgayBatDau']."', NgayKetThuc='".$_POST['NgayKetThuc']."' WHERE MaChiTietKhuyenMai = '".$id."'";
		mysql_query($query2);
		echo "<script>alert('Sửa thành công');window.location='".PATH_ADMIN."?controller=quanlykhuyenmai'</script>";exit;		
	}
	}
}

?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2> <?php echo (!empty($id))?"Sửa":"Thêm"?> Chương Trình Khuyến Mãi </h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form action="" method="POST" enctype='multipart/form-data'>
					<div class="form-group">
						<label> Tên Chương Trình Khuyến Mãi </label>
						<input class="form-control" name="TenKhuyenMai" value="<?php echo @$detail['TenKhuyenMai']?>" >
					</div>
                    <div class="form-group">
						<label> Sản Phẩm Được Khuyến Mãi </label>
						<select  class="form-control"  name="MaSanPham">
							<?php 
								$sql_sp = "SELECT * FROM sanpham";
								$danhsachtensanpham = mysql_query($sql_sp);
								if(!empty($danhsachtensanpham)) while($tensanpham = mysql_fetch_assoc($danhsachtensanpham)){?>
								<option <?php echo (!empty($detail) && $detail['MaSanPham'] == $tensanpham['MaSanPham'])?"selected":""?> value="<?php echo $tensanpham['MaSanPham']?>"> <?php echo $tensanpham['TenSanPham']?> (Mã SP: <?php echo $tensanpham['MaSanPham']?>) </option>
							<?php }?>
						</select>
					</div>
                    <div class="form-group">
						<label> Giá Giảm </label>
						<input class="form-control" name="GiaGiam" value="<?php echo @$detail['GiaGiam']?>" >
					</div>
                    <div class="form-group">
						<label> Ngày Bắt Đầu </label>
						<input class="form-control" name="NgayBatDau" type="date" value="<?php echo @$detail['NgayBatDau']?>" >
					</div>
                    <div class="form-group">
						<label> Ngày Kết Thúc </label>
						<input class="form-control" name="NgayKetThuc" type="date" value="<?php echo @$detail['NgayKetThuc']?>" >
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