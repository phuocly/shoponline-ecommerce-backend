<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand"><?php echo $_SESSION['admin']['TenQuanTriVien']?></a> -->
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['admin']['TenQuanTriVien']?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo PATH_ADMIN."?controller=logout"?>"><i class="fa fa-fw fa-power-off"></i> Thoát </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">		
                    <li class="<?php echo ($controller == 'trangchu' || empty($controller))?"active":""?>">
                        <a href="<?php echo PATH_ADMIN?>"><i class="fa fa-fw fa-dashboard"></i> Trang chủ </a>
                    </li>
                    <li class="<?php echo ($controller == 'quanlyhangsanpham' || $controller == 'formquanlyhangsanpham')?"active":""?>">
                        <a href="<?php echo PATH_ADMIN."?controller=quanlyhangsanpham"?>"><i class="fa fa-fw fa-dashboard"></i> Quản lý hãng sản phẩm </a>
                    </li>
					<li class="<?php echo ($controller == 'quanlysanpham' || $controller == 'formquanlysanpham')?"active":""?>">
                        <a href="<?php echo PATH_ADMIN."?controller=quanlysanpham"?>"><i class="fa fa-fw fa-dashboard"></i> Quản lý sản phẩm </a>
                    </li>
					<li class="<?php echo ($controller == 'quanlykhuyenmai' || $controller == 'formquanlykhuyenmai')?"active":""?>">
                        <a href="<?php echo PATH_ADMIN."?controller=quanlykhuyenmai"?>"><i class="fa fa-fw fa-dashboard"></i> Quản lý khuyến mãi </a>
                    </li>                    
                    <li class="<?php echo ($controller == 'quanlydonhang' || $controller == 'formquanlydonhang')?"active":""?>">
                        <a href="<?php echo PATH_ADMIN."?controller=quanlydonhang"?>"><i class="fa fa-fw fa-dashboard"></i> Quản lý đơn hàng </a>
                    </li>
                    <li class="<?php echo ($controller == 'dskhachhang' || $controller == 'formdskhachhang')?"active":""?>">
                        <a href="<?php echo PATH_ADMIN."?controller=dskhachhang"?>"><i class="fa fa-fw fa-dashboard"></i> Danh sách khách hàng </a>
                    </li>
                    <li class="<?php echo ($controller == 'thongke' || $controller == '')?"active":""?>">
                        <a href="<?php echo PATH_ADMIN."?controller=thongke"?>"><i class="fa fa-fw fa-dashboard"></i> Thống Kê </a>
                    </li>
            </div>
            <!-- /.navbar-collapse -->
        </nav>