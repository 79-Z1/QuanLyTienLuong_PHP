<?php $this->section('navbar_manager'); ?>
<style>
    li a{
        font-size: 17px !important;
    }
</style>
<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
    <div class="container-fluid">
        <!-- Toggler --> <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button> <!-- Brand -->
        <a class="navbar-brand py-1 mb-lg-5 px-2 me-0" href="http://dakhoathientrang.com/"> <img style="width:242px !important; height: 70px" src="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/logo.png" ?>" alt="Logo Công Ty Á"> </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item" data-active="1">
                    <a class="nav-link" id="xemtt" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/human_manager"?> > <i class="bi bi-person-lines-fill"></i> Danh sách nhân viên </a>
                </li>
                <li class="nav-item" data-active="2">
                    <a class="nav-link" id="ungluong" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/human_manager?page=human-manager-add-employee"?>"><i class="bi bi-person-fill-add"></i></i>Thêm nhân viên</a>
                </li>
                <li class="nav-item" data-active="3">
                    <a class="nav-link" id="tinhluong" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/human_manager?page=human-manager-add-timesheets"?>"><i class="bi bi-calendar2-plus-fill"></i>  Chấm công </a>
                </li>
                <li class="nav-item" data-active="4">
                    <a class="nav-link" id="thongke" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/human_manager?page=human-manager-check-timesheets"?>"><i class="bi bi-calendar-check-fill"></i>Bảng chấm công</a>
                </li>
                <li class="nav-item" data-active="5">
                    <a class="nav-link" id="exit"> <i class="bi bi-box-arrow-left"></i> Logout </a>
                </li>
            </ul> <!-- Divider -->
        </div>
    </div>
</nav> <!-- Main content -->
<?php $this->end(); ?>