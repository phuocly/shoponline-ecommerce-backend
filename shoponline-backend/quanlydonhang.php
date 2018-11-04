<?php 
 include_once('check_login.php');
 $danhsachdonhang = "SELECT donhang.* FROM donhang";
 $query = mysql_query($danhsachdonhang);
 $table_header = @mysql_fetch_assoc($query);
 if(!empty($_GET['type']) && $_GET['type'] == 'xoa')
 {
	$id = $_GET['id'];
	$query_detail = "SELECT * FROM donhang where MaDonHang=".$id;
	$detail = @mysql_fetch_assoc(mysql_query($query_detail));
	if(!empty($detail))
	{
		$query_delete = "DELETE FROM donhang where MaDonHang=".$id;
		$query_delete2 = "DELETE FROM chitietdonhang where MaDonHang=".$id;
		mysql_query($query_delete);
		mysql_query($query_delete2);
		echo "<script> alert('Xóa thành công');window.location='".PATH_ADMIN."?controller=quanlydonhang'</script>";exit;
	}
	else
	{
		echo "<script> alert('Có lỗi trong quá trình xóa hảy thử lại');window.location='".PATH_ADMIN."?controller=quanlydonhang'</script>";exit;
	}
 }
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2> Quản Lý Đơn Hàng </h2>
			</div><div class="col-lg-12">
				<h4> Trạng thái 0: Chờ xử lý | Trạng thái 1: Đang xử lý | Trạng thái 2: Đã hoàn thành | Trạng thái 3: Hủy đơn hàng </h4>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<?php if(!empty($table_header)){foreach($table_header as $key => $val){?>
								<th><?php echo $key?></th>
							<?php }} ?>
							<th> Chức năng </th>
						</thead>
						<tbody>
							<tr> 
								<?php $i=0; if(!empty($table_header))foreach($table_header as $key => $val){ $i++;if($i == 1) $ma = $table_header[$key] ?>
								<td> <?php echo $table_header[$key]?> </td>
								<?php }?>
								<td> <a href="<?php echo PATH_ADMIN."?controller=formquanlydonhang&id=".$ma?>"> Xem </a> || <A class="delete" href="<?php echo PATH_ADMIN."?controller=quanlydonhang&id=".$ma."&type=xoa"?>"> Xóa </a> </td>
							</tr>
							<?php if(!empty($query)) while($rows = mysql_fetch_assoc($query)){?>
							<tr> 
								<?php $i=0; if(!empty($table_header))foreach($table_header as $key => $val){ $i++;if($i == 1) $ma = $rows[$key] ?>
								<td> <?php echo $rows[$key]?> </td>
								<?php }?>
								<td> <a href="<?php echo PATH_ADMIN."?controller=formquanlydonhang&id=".$ma?>"> Xem </a> || <A class="delete" href="<?php echo PATH_ADMIN."?controller=quanlydonhang&id=".$ma."&type=xoa"?>"> Xóa </a> </td>
							</tr>
							<?php }?>
						<tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$('.delete').click(function(){
		return confirm('Bạn có thật sự muốn xóa');
	});
});
</script>