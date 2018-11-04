<?php 
include('check_login.php');
$id = @$_GET['id'];
if(!empty($id)){	
	$sql = "SELECT * FROM sanpham where MaSanPham = '".$id."'";
	$query = mysql_query($sql);
	$detail = @mysql_fetch_assoc($query);
	if(empty($detail)){
		header('location:'.PATH_ADMIN."?controller=".$controller);
		exit;
	}
}

/*kiem tra rong*/
function validation()
{
	if(empty($_POST['TenSanPham']) ){
		return array(
			'error'=>1,
			'mess'=>'Bạn chưa nhập đầy đủ thông tin. Hãy nhập đầy đủ thông tin ...'
			
		);
	}
	return array 
	(
	'error'=>0,
	'mess'=>''
	);
}
$error = "";
if(!empty($_POST['action_form'])){
	
	if(empty($_POST['TenSanPham']) || empty($_POST['ChiTietSanPham']) || empty($_POST['GiaSanPham']))
	{
		$_SESSION['post'] = $_POST;
		echo "<script>alert('Bạn chưa nhập đầy đủ thông tin. Hãy nhập đầy đủ thông tin');window.location='".PATH_ADMIN."?controller=formquanlysanpham&id=".$id."'</script>";exit;
		
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
	if(!empty($_FILES['HinhSanPham']['name'])){
		$type_img  = array('image/jpeg','image/png','image/jpg');
		$files_type = $_FILES['HinhSanPham']['type'];
		if(in_array($files_type,$type_img)){
			move_uploaded_file($_FILES['HinhSanPham']['tmp_name'],"../images/products_list/".$_FILES['HinhSanPham']['name']);
			if(empty($id)){
				$colum .= ",HinhSanPham";
				$value .= ",'".$_FILES['HinhSanPham']['name']."'";
			}else{
				$set_update = trim($set_update,",").",HinhSanPham='".$_FILES['HinhSanPham']['name']."'";
			}
		}
	}
	
	$checktensp = validation();
	if(empty($id) && $checktensp['error'] == 0){
		$query = "INSERT INTO sanpham (".str_replace(",,",",",trim($colum,",")).") VALUES (".str_replace(",,",",",trim($value,",")).")";
		mysql_query($query);
		echo "<script>alert('Tạo thành công');window.location='".PATH_ADMIN."?controller=quanlysanpham'</script>";exit;
	}
	else if($checktensp['error'] == 0){
		$query = "UPDATE sanpham SET  ".trim($set_update,",")." WHERE MaSanPham = '".$id."'";
		mysql_query($query);
		echo "<script>alert('Sửa thành công');window.location='".PATH_ADMIN."?controller=quanlysanpham'</script>";exit;		
	}
	else
	{
		$error = $checktensp['mess'];
		$detail = $_POST;
	}
	}
}
$danhsachhangsanpham = mysql_query("SELECT * FROM hangsanpham");
if(!empty($_SESSION['post'])) {
	$detail = $_SESSION['post'];
	unset($_SESSION['post']);	
}
?>

<div id="page-wrapper">
	<div class="container-fluid">
    <?php if(!empty($error)){?><div class="error"><?php echo $error ?></div><?php }?>
		<div class="row">
			<div class="col-lg-12">
				<h2> <?php echo (!empty($id))?"Sửa":"Thêm"?> Sản Phẩm </h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form action="" method="POST" enctype='multipart/form-data'>
					<div class="form-group">
						<label> Tên Sản Phẩm </label>
						<input class="form-control" name="TenSanPham" value="<?php echo @$detail['TenSanPham']?>" >
					</div>
                    
                    <div class="form-group">
						<label> Hình Sản Phẩm </label>
						<input id="HinhSanPham" type="file" name="HinhSanPham" class="form-control"> 
						<?php if(!empty($detail['HinhSanPham'])) {?>
							<img width="200" src="../images/products_list/<?php echo $detail['HinhSanPham']?>">
						<?php }?>
					</div>
                    
                    <div class="form-group">
						<label> Chi Tiết Sản Phẩm </label>
						<input class="form-control" name="ChiTietSanPham" value="<?php echo @$detail['ChiTietSanPham']?>" >
					</div>
                    
					<div class="form-group">
						<label> Giá Sản Phẩm </label>
						<input class="form-control"  name="GiaSanPham" type="text" value="<?php echo (@$detail['GiaSanPham'])?>" >
					</div>
                    
                    <div class="form-group">
						<label> Ghi Chú Sản Phẩm </label>
						<input class="form-control" name="GhiChuSanPham" value="<?php echo @$detail['GhiChuSanPham']?>" >
					</div>
                    
					<div class="form-group">
						<label> Hãng Sản Phẩm </label>
						<select  class="form-control"  name="MaHangSanPham">
							<?php if(!empty($danhsachhangsanpham)) while($hangsanpham = mysql_fetch_assoc($danhsachhangsanpham)){?>
								<option <?php echo (!empty($detail) && $detail['MaHangSanPham'] == $hangsanpham['MaHangSanPham'])?"selected":""?> value="<?php echo $hangsanpham['MaHangSanPham']?>"> <?php echo $hangsanpham['TenHangSanPham']?> </option>
							<?php }?>
						</select>
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