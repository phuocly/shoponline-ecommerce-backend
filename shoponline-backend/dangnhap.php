<?php
include_once('check_login.php');
if(!empty($_POST['u']) && $_POST['check_inc'] == 1){
	$u = $_POST['u'];
	$p = md5($_POST['p']);
    $sql = "SELECT * FROM quantrivien WHERE TaiKhoan ='".$u."' and MatKhau='".$p."'";
	$row = mysql_fetch_assoc(mysql_query($sql));
	if(!empty($row))
	{
		$_SESSION['admin'] = $row;
		echo "<script>window.location='".PATH_ADMIN."'</script>";exit;
	}
} 	
?>
<h4 class="text_login"> Đăng nhập </h4>
<div class="login">
	<form action="" method="post">
		<div class="form-group">
			<label> UserName </label>
			<input class="form-control" type="text" name="u" />
		</div>
		<div class="form-group">
			<label> Password </label>
			<input class="form-control" type="password" name="p" />
		</div>
		<p align='center'> <input  class="btn btn-default" type="submit" value="Đăng nhập" /> </p>
	</form>
</div>
