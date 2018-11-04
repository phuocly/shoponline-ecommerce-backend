<?php 
 include_once('check_login.php');
 $danhsachsanpham = "SELECT sanpham.*,TenHangSanPham FROM sanpham LEFT JOIN hangsanpham ON hangsanpham.MaHangSanPham  = sanpham.MaHangSanPham ORDER BY MaSanPham";
 $query = mysql_query($danhsachsanpham);
 $table_header = @mysql_fetch_assoc($query);
 if(!empty($_GET['type']) && $_GET['type'] == 'xoa'){
	$id = $_GET['id'];
	$query_detail = "SELECT * FROM sanpham where MaSanPham=".$id;
	$detail = @mysql_fetch_assoc(mysql_query($query_detail));
	if(!empty($detail)){
		@unlink("../".$detail['HinhSanPham']);
		@unlink("../".$detail['HinhSanPham']);
		$query_delete = "DELETE FROM sanpham where MaSanPham=".$id;
		mysql_query($query_delete);
		echo "<script> alert('Xóa thành công');window.location='".PATH_ADMIN."?controller=quanlysanpham'</script>";exit;
	}else{
		echo "<script> alert('Có lỗi trong quá trình xóa hảy thử lại');window.location='".PATH_ADMIN."?controller=quanlysanpham'</script>";exit;
	}
 }
 
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2> Quản Lý Sản Phẩm </h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo PATH_ADMIN."?controller=formquanlysanpham"?>"> Thêm Sản Phẩm </a>
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
										<td>
											<?php if($key =='HinhSanPham'){?>
                                            <img src="<?php echo PATH?>/images/products_list/<?php echo str_replace("../images/products_list/","",$table_header[$key])?>" width='80'>
											<?php }else if ($key == 'GiaSanPham') {?>
                                            	<?php echo number_format ($table_header[$key],0," ",'.')?> VNĐ
												
                                                <?php }else{?>
                                            		<?php echo $table_header[$key]?> 
											<?php }?> 
										</td>
									<?php }?>
									<td> <a href="<?php echo PATH_ADMIN."?controller=formquanlysanpham&id=".$ma?>"> Sửa </a> || <A class="delete" href="<?php echo PATH_ADMIN."?controller=quanlysanpham&id=".$ma."&type=xoa"?>"> Xóa </a> </td>
								</tr>
							<?php if(!empty($query)) while($rows = mysql_fetch_assoc($query)){?>
								<tr> 
									<?php $i=0; if(!empty($table_header))foreach($table_header as $key => $val){ $i++;if($i == 1) $ma = $rows[$key] ?>
										<td> 
											<?php if($key =='HinhSanPham'){?>
											<img src="<?php echo PATH?>/images/products_list/<?php echo str_replace("../images/products_list/","",$rows[$key])?>" width='80'>
                                            <?php }else if($key == 'GiaSanPham'){?>
                                            <?php echo number_format ($rows[$key],0," ",'.')?> VNĐ
											<?php }else{?>
											<?php echo $rows[$key]?> 
											<?php }?>
										</td>
									<?php }?>
										<td> <a href="<?php echo PATH_ADMIN."?controller=formquanlysanpham&id=".$ma?>"> Sửa </a> || <A class="delete" href="<?php echo PATH_ADMIN."?controller=quanlysanpham&id=".$ma."&type=xoa"?>"> Xóa </a> </td>
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