<?php $this->section('navbar_admin'); ?>
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
                    <a class="nav-link" id="phieuLuong" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-paycheck"?> > <i class="bi bi-cash-coin"></i> Phiếu lương </a>
                </li>
                <li class="nav-item" data-active="2">
                    <a class="nav-link" id="nhanVien" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-staff"?> > <i class="bi bi-person-circle"></i> Nhân viên </a>
                </li>
                <li class="nav-item" data-active="3">
                    <a class="nav-link" id="chamCong" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-timekeeping"?> > <i class="bi bi-calendar-check-fill"></i> Chấm công </a>
                </li>
                <li class="nav-item" data-active="4">
                    <a class="nav-link" id="taiKhoan" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-account"?> > <i class="bi bi-person-fill-lock"></i> Tài khoản </a>
                </li>
                <li class="nav-item" data-active="5">
                    <a class="nav-link" id="phongBan" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-department"?> > <i class="bi bi-door-open-fill"></i> Phòng ban</a>
                </li>
                <li class="nav-item" data-active="6">
                    <a class="nav-link" id="tangCa" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-overtime"?>"> <i class="bi bi-graph-up-arrow"></i> Tăng ca</a>
                </li>
                <li class="nav-item" data-active="7">
                    <a class="nav-link" id="chucVu" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-position"?>"> <i class="bi bi-person-raised-hand"></i> Chức vụ </a>
                </li>
                <li class="nav-item" data-active="8">
                    <a class="nav-link" id="ungLuong" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-salary-slip"?>"> <i class="bi bi-receipt-cutoff"></i> Phiếu ứng lương </a>
                </li>
                <li class="nav-item" data-active="9">
                    <a class="nav-link" id="xemtt" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-parameter"?>"> <i class="bi bi-calculator"></i> Tham số </a>
                </li>
                <li class="nav-item" data-active="10">
                    <a class="nav-link" id="exit"> <i class="bi bi-box-arrow-left"></i> Logout </a>
                </li>
            </ul> <!-- Divider -->
        </div>
    </div>
</nav> <!-- Main content -->

<?php $this->end(); ?>
