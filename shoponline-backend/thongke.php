  <div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2> Thống Kê </h2>
			</div>
		</div>
        
<?php 
 include_once('check_login.php');
 $thongkehangsp = "SELECT COUNT(MaHangSanPham) FROM hangsanpham";
 $query4 = mysql_query($thongkehangsp);
 $table_header4 = @mysql_fetch_assoc($query4);
?>         
        <div class="row">
			<div class="col-lg-12">
				<a href="<?php echo PATH_ADMIN."?controller=quanlyhangsanpham"?>"> Hãng Sản Phẩm </a>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>		
								<th>Số Lượng Hãng Sãn Phẩm</th>												
						</thead>
						<tbody>
							<tr> 
								<?php $i=0; if(!empty($table_header4))foreach($table_header4 as $key => $val){ $i++;if($i == 1) $ma = $table_header4[$key] ?>
								<td> <?php echo $table_header4[$key]?> </td>
								<?php }?>							
							</tr>
							<?php if(!empty($query4)) while($rows = mysql_fetch_assoc($query4)){?>
							<tr> 
								<?php $i=0; if(!empty($table_header4))foreach($table_header4 as $key => $val){ $i++;if($i == 1) $ma = $rows[$key] ?>
								<td> <?php echo $rows[$key]?> </td>
								<?php }?>	
							</tr>
							<?php }?>
						<tbody>
					</table>
				</div>
			</div>  
		</div> 
        
<?php 
 $thongkesanpham = "SELECT COUNT(MaSanPham) FROM sanpham";
 $query = mysql_query($thongkesanpham);
 $table_header = @mysql_fetch_assoc($query);
?>
		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo PATH_ADMIN."?controller=quanlysanpham"?>"> Sản Phẩm </a>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
								<th>Số Lượng Sản Phẩm Kinh Doanh</th>					
						</thead>
						<tbody>
							<tr> 
								<?php $i=0; if(!empty($table_header))foreach($table_header as $key => $val){ $i++;if($i == 1) $ma = $table_header[$key] ?>
								<td> <?php echo $table_header[$key]?> </td>
								<?php }?>					
							</tr>
							<?php if(!empty($query)) while($rows = mysql_fetch_assoc($query)){?>
							<tr> 
								<?php $i=0; if(!empty($table_header))foreach($table_header as $key => $val){ $i++;if($i == 1) $ma = $rows[$key] ?>
								<td> <?php echo $rows[$key]?> </td>
								<?php }?>									
							</tr>
							<?php }?>
						<tbody>
					</table>
				</div>
			</div>  
		</div>
          
<?php 
 $tenhangsanpham = "SELECT * FROM hangsanpham";
 $querytenhang = mysql_query($tenhangsanpham);
?>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
                        		<?php $array_table_count = array(); while ($r = mysql_fetch_assoc($querytenhang)){ ?>
								<th>
									<p> <?php echo $r['TenHangSanPham']; ?> </p>
                                <?php
								 //SELECT MaHangSanPham, COUNT(*) FROM sanpham GROUP BY MaHangSanPham
								 $thongkesanpham = "SELECT COUNT(MaSanPham) FROM sanpham WHERE MaHangSanPham = ".$r['MaHangSanPham'];
 								 $query = mysql_query($thongkesanpham);
 								 $table_header = @mysql_fetch_assoc($query); 
								 if(!empty($table_header)) 
								 {
									foreach ($table_header as $key => $val)
									{
										$array_table_count[] =  $table_header[$key];
									}
								 } 
								 else 
								 {
									 $array_table_count[] =  0;
							     }
								}			
								?>	
                                </th>				
						</thead>
                        <tbody> 
                        	<tr> 
                            	<?php foreach ($array_table_count as $val) { ?>
                            		<td> <?php echo $val ?> </td> 
                                <?php } ?>
                            <tr>
                        </tbody>             
					</table>
				</div>
			</div>  
		</div>

<?php 
 $thongkekhachhang = "SELECT COUNT(MaKhachHang) FROM khachhang";
 $query2 = mysql_query($thongkekhachhang);
 $table_header2 = @mysql_fetch_assoc($query2);
?>   
        <div class="row">
			<div class="col-lg-12">
				<a href="<?php echo PATH_ADMIN."?controller=dskhachhang"?>"> Danh Sách Khách Hàng  </a>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
								<th>Số Lượng Khách Hàng</th>													
						</thead>
						<tbody>
							<tr> 
								<?php $i=0; if(!empty($table_header2))foreach($table_header2 as $key => $val){ $i++;if($i == 1) $ma = $table_header2[$key] ?>
								<td> <?php echo $table_header2[$key]?> </td>
								<?php }?>							
							</tr>
							<?php if(!empty($query2)) while($rows = mysql_fetch_assoc($query2)){?>
							<tr> 
								<?php $i=0; if(!empty($table_header2))foreach($table_header2 as $key => $val){ $i++;if($i == 1) $ma = $rows[$key] ?>
								<td> <?php echo $rows[$key]?> </td>
								<?php }?>	
							</tr>
							<?php }?>
						<tbody>
					</table>
				</div>
			</div>  
		</div>
 
<?php 
 $thongkehoadon = "SELECT COUNT(MaDonHang) FROM donhang";
 $query3 = mysql_query($thongkehoadon);
 $table_header3 = @mysql_fetch_assoc($query3);
?>   
        <div class="row">
			<div class="col-lg-12">
				<a href="<?php echo PATH_ADMIN."?controller=quanlydonhang"?>"> Đơn Hàng  </a>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>							
								<th>Số Lượng Đơn Hàng</th>														
						</thead>
						<tbody>
							<tr> 
								<?php $i=0; if(!empty($table_header3))foreach($table_header3 as $key => $val){ $i++;if($i == 1) $ma = $table_header3[$key] ?>
								<td> <?php echo $table_header3[$key]?> </td>
								<?php }?>							
							</tr>
							<?php if(!empty($query3)) while($rows = mysql_fetch_assoc($query3)){?>
							<tr> 
								<?php $i=0; if(!empty($table_header3))foreach($table_header3 as $key => $val){ $i++;if($i == 1) $ma = $rows[$key] ?>
								<td> <?php echo $rows[$key]?> </td>
								<?php }?>	
							</tr>
							<?php }?>
						<tbody>
					</table>
				</div>
			</div>  
		</div>       
        
	</div>
</div>
