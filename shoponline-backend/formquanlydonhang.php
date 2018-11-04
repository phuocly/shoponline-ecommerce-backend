<?php 
include('check_login.php');
$id = @$_GET['id'];
if(!empty($id)){
	$sql = "SELECT donhang.*, khachhang.* FROM donhang, khachhang where donhang.MaDonHang = '".$id."' and donhang.MaKhachHang = khachhang.MaKhachHang";
	$query = mysql_query($sql);
	$detail = @mysql_fetch_assoc($query);
	if(empty($detail)){
		header('location:'.PATH_ADMIN."?controller=".$controller);
		exit;
	}
	$chitietdonhang = "SELECT col1.*,col3.* FROM chitietdonhang as col1, sanpham as col3 Where col1.MaSanPham = col3.MaSanPham AND col1.MaDonHang = ".$detail['MaDonHang'];
	$chitietdonhang = mysql_query($chitietdonhang);
}else{
	echo "<script>alert('Đơn hàng không tồn tại');window.location='".PATH_ADMIN."?controller=quanlydonhang'</script>";exit;		
	exit;
}
if(!empty($_GET['type']) and $_GET['type'] == 'xoasanpham'){ // xoa san pham
	$query = 'DELETE FROM `chitietdonhang` WHERE MaChiTietDonHang='.$_GET["MaChiTietDonHang"];
	mysql_query($query);
	echo "<script>alert('Xóa sản phẩm thành công');window.location='".PATH_ADMIN."?controller=formquanlydonhang&id=".$id."'</script>";exit;				
	exit;
}
if(!empty($_POST['action_form']))
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
	
	if(!empty($id) and $_POST['typeupdate'] =='TrangThai'){
		$query = "UPDATE donhang SET  TrangThaiDonHang='".$_POST["TrangThai"]."' WHERE MaDonHang = '".$id."'";
		mysql_query($query);
		echo "<script>alert('Cập nhật trạng thái thành công');window.location='".PATH_ADMIN."?controller=formquanlydonhang&id=".$id."'</script>";exit;		
	}
	
	if(!empty($id) and $_POST['typeupdate'] =='NgayGiao'){
		$query = "UPDATE donhang SET  NgayGiao='".$_POST["NgayGiao"]."' WHERE MaDonHang = '".$id."'";
		mysql_query($query);
		echo "<script>alert('Cập nhật ngày giao thành công');window.location='".PATH_ADMIN."?controller=formquanlydonhang&id=".$id."'</script>";exit;		
	}
	
	if(empty($_POST['SoLuong']))
	{
		echo "<script>alert('Cần nhập vào số lượng sản phẩm');window.location='".PATH_ADMIN."?controller=formquanlydonhang&id=".$id."'</script>";exit;
	}
	
	if(!empty($_POST['MaDonHang']) and $_POST['typeupdate'] =='themsanpham'){	
		$query_sp = mysql_query("SELECT sanpham.* FROM sanpham WHERE MaSanPham = '".$_POST["MaSanPham"]."'");
		$sanpham = mysql_fetch_assoc($query_sp);
		if(!empty($sanpham)){
			$query = "INSERT INTO chitietdonhang (MaSanPham,TenSanPham,GiaMua,SoLuong,MaDonHang) VALUES ('".$_POST["MaSanPham"]."','".$sanpham['TenSanPham']."','".$sanpham["GiaSanPham"]."','".$_POST['SoLuong']."','".$_POST['MaDonHang']."')";
			mysql_query($query);			
			echo "<script>alert('Thêm sản phẩm vào đơn hàng thành công');window.location='".PATH_ADMIN."?controller=formquanlydonhang&id=".$_POST['MaDonHang']."'</script>";exit;		
		}		
	}
}
//danh sách trang thái đơn hàng
$danhsachtrangthai = array("Chờ xử lý","Đang xử lý","Đã hoàn thành","Hủy đơn hàng");
$danhsachtensanpham 	= mysql_query("SELECT * FROM  sanpham");
?>
<?php

?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2> <?php echo (!empty($id))?"Xem Chi Tiết":"Thêm Sản Phẩm vào"?> Đơn Hàng </h2>
			</div>
           
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="infoinvoice">
					<div class="infoinvoice_left">
						<p class="thongtinkhachhang"> Thông tin khách hàng </p>
                        <p> <b> Mã Khách hàng: </b> <?php echo $detail['MaKhachHang'] ?> </p>
						<p> <b> Tên Khách hàng: </b> <?php echo $detail['TenKhachHang'] ?> </p>
						<p> <b> Số điện thoại: </b> <?php echo $detail['SDTKhachHang']?></p>
                        <p> <b> Địa chỉ khách hàng: </b> <?php echo $detail['DiaChiKhachHang']?></p>
					</div>
					<div class="infoinvoice_right">
						<p class="thongtinhoadon"> Thông tin đơn hàng </p>
						<p> <b> Mã số hóa đơn: </b>  <?php echo $detail['MaDonHang']?> </p>
						<p> <b> Ngày mua hàng: </b>  <?php echo date("d/m/Y",strtotime($detail['NgayMua']))?> </p>
						<!--<p> <b> Ngày giao hàng: </b>  <?php echo date("d/m/Y",strtotime($detail['NgayGiao']))?> </p>	-->
                        <p> <b>Ngày giao hàng: </b>
                        <?php if($detail["TrangThaiDonHang"]=="0" || $detail["TrangThaiDonHang"]=="1") { ?>
							<form action="" method="post">
								<input class="form-control" name="NgayGiao" type="date" value="<?php echo $detail['NgayGiao']?>" >
								<input type="hidden" name="typeupdate" value="NgayGiao">
								<input type="hidden" name="action_form" value="update">
								<input type="submit" name="btnngaygiao" value="Cập nhật ngày giao">
							</form>
                            <?php 
							} 
							else 
							{ 
								if($detail["TrangThaiDonHang"]=="2")
									echo date("d/m/Y",strtotime($detail['NgayGiao']));	
							}
							?>
						</p>
                        					
						<p> <b> Tình trạng hóa đơn: </b>
                        <?php if($detail["TrangThaiDonHang"]=="0" || $detail["TrangThaiDonHang"]=="1") { ?>
							<form action="" method="post">
								<select name="TrangThai">
									<?php foreach($danhsachtrangthai as $key => $value)
									{ 	
									?>
										<option <?php echo ($detail["TrangThaiDonHang"] == $key)?"selected":""?> value="<?php echo $key?>"><?php echo $value?></option>
									<?php } ?>
								</select>
								<input type="hidden" name="typeupdate" value="TrangThai">
								<input type="hidden" name="action_form" value="update"><br>	
								<input type="submit" name="btnstatus" value="Cập nhật trạng thái">
							</form>
                            <?php 
							} 
							else 
							{ 
								foreach($danhsachtrangthai as $key => $value)
								{
								if($detail["TrangThaiDonHang"] == $key)
									echo $value;
							 	}
							}
							?>
						</p>
					</div>
				</div>
				<div class="infoinvoice infoinvoice_detail">
					<p class="label_invoice_detail"> Chi tiết đơn hàng </p>
					<div class="list_infoinvoice_detail">
						<table class="item_infoinvoice_detail">
							<thead> 
								<tr>
									<th>  Tên sản phẩm </th>
									<th>  Giá </th>
									<th>  Số lượng</th>
									<th>  Tông cộng </th>
									<th>  Chức năng</th>
								</tr>
							</thead>
							<tbody>
								<?php $total_donhang = 0 ;while($row = mysql_fetch_array($chitietdonhang)){
										$total_donhang += $row["SoLuong"] * $row["GiaMua"]
									?>
									<tr> 
										<td> <?php echo $row["TenSanPham"]?> </td>
										<td> <?php echo number_format($row["GiaMua"],0," ",'.')?> VNĐ</td>
										<td> <?php echo $row["SoLuong"]?> </td>
										<td> <?php echo number_format($row["SoLuong"] * $row["GiaMua"],0," ",'.')?> VNĐ </td>
										<td> <a class='delete' href="<?php echo PATH_ADMIN."/?controller=formquanlydonhang&type=xoasanpham&id=".$detail['MaDonHang']."&MaChiTietDonHang=".$row['MaChiTietDonHang']?>"> Xóa </a></td>
									</tr>
								<?php }?>
									<tr> 
										<td colspan='4'> Tổng Tiền Đơn Hàng </td>
										<td colspan='2'> <?php echo number_format($total_donhang,0," ",'.')?> VNĐ </td>
									</tr>
							</tbody>
						</table>
					</div>
				</div>
                
				<div class="infoinvoice infoinvoice_detail">
					<p class="label_invoice_detail"> Thêm sản phẩm vào đơn hàng </p>
					<form action="" method="post">
						<div class="form-group">
							<label> Tên sản phẩm </label>
							<select  class="form-control" name="MaSanPham"> 
								<?php while($row = mysql_fetch_assoc($danhsachtensanpham)){?>
									<option value="<?php echo $row["MaSanPham"]?>"><?php echo $row['TenSanPham']?> (Mã SP:<?php echo $row['MaSanPham']?>)</option>
								<?php } ?>
							</select>
						</div>                    
						<input type='hidden' name='MaDonHang' value='<?php echo $detail['MaDonHang']?>'>
						<input type="hidden" name="typeupdate" value="themsanpham">
						<input type="hidden" name="action_form" value="update">
						<div class="form-group">
							<label> Số lượng </label>
							<input type='text' class="form-control" name="SoLuong">
						</div>
						<div class="form-group">
							<input type='submit' class="form-control" value="Thêm Sản Phẩm">
						</div>
					</form>
				</div>
                
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.delete').click(function(){
		return confirm('Bạn có thật sự muốn xóa');
	});
});
</script>