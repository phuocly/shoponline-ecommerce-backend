<?php 
	include_once('check_login.php');
	$controller = !empty($_GET['controller'])?$_GET['controller']:"trangchu";
	
 	if(empty($_SESSION['admin'])){
		$controller = 'dangnhap';	
	}else{
		//**** lay menu  ****/
		$admin = $_SESSION['admin'];
	}
	if($controller == 'logout'){
		unset($_SESSION['admin']);
		
		header('Location:'.PATH_ADMIN);Exit;
	}
	elseif($controller != 'dangnhap') {
		echo "<div id='wrapper'>";
		include_once('menu_left.php');
	}
	else
		echo "<div class='bodyright'>";	
	switch($controller){
		case 'trangchu':
			include_once('trangchu.php');
			break;
		case 'dangnhap':
			include_once('dangnhap.php');
			break;
			
		case 'quanlyhangsanpham':
			include_once('quanlyhangsanpham.php');
			break;
		case 'formquanlyhangsanpham':
			include_once('formquanlyhangsanpham.php');
			break;	
			
		case 'quanlysanpham':
			include_once('quanlysanpham.php');
			break;
		case 'formquanlysanpham':
			include_once('formquanlysanpham.php');
			break;

		case 'quanlykhuyenmai':
			include_once('quanlykhuyenmai.php');
			break;
		case 'formquanlykhuyenmai':
			include_once('formquanlykhuyenmai.php');
			break;			
			
		case 'quanlydonhang':
			include_once('quanlydonhang.php');
			break;
		case 'formquanlydonhang':
			include_once('formquanlydonhang.php');
			break;
			
		case 'dskhachhang':
			include_once('dskhachhang.php');
			break;
		case 'formdskhachhang':
			include_once('formdskhachhang.php');
			break;
			
		case 'thongke':
			include_once('thongke.php');
			break;			
	}
	echo '</div>'
?>