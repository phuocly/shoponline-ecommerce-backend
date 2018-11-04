<?php 
 include_once('check_login.php');
 $danhsachkhachhang = "SELECT * FROM khachhang where 1";
 $query = mysql_query($danhsachkhachhang);
 $table_header = @mysql_fetch_assoc($query);
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2> Danh Sách Khách Hàng </h2>
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
									<td> <a href="<?php echo PATH_ADMIN."?controller=formdskhachhang&id=".$ma?>"> Sửa </a> </td>
							</tr>
							<?php if(!empty($query)) while($rows = mysql_fetch_assoc($query)){?>
							<tr> 
								<?php $i=0; if(!empty($table_header))foreach($table_header as $key => $val){ $i++;if($i == 1) $ma = $rows[$key] ?>
									<td> <?php echo $rows[$key]?> </td>
								<?php }?>
									<td> <a href="<?php echo PATH_ADMIN."?controller=formdskhachhang&id=".$ma?>"> Sửa </a> </td>
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