<?php $this->section('navbar_admin'); ?>
<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
    <div class="container-fluid">
        <!-- Toggler --> <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button> <!-- Brand --> <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="/admin/ketoan"> <img style="height: 91px !important;" src="/img/laugau.png" alt="..."> </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item" data-active="1">
                    <a class="nav-link" id="xemtt" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-salary-slip"?> > <i class="bi bi-person-lines-fill"></i> Phiếu lương </a>
                </li>
                <li class="nav-item" data-active="2">
                    <a class="nav-link" id="xemtt" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-staff"?> > <i class="bi bi-person-lines-fill"></i> Nhân viên </a>
                </li>
                <li class="nav-item" data-active="3">
                    <a class="nav-link" id="xemtt" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-timekeeping"?> > <i class="bi bi-person-lines-fill"></i> Chấm công </a>
                </li>
                <li class="nav-item" data-active="4">
                    <a class="nav-link" id="xemtt" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-account"?> > <i class="bi bi-person-lines-fill"></i> Tài khoản </a>
                </li>
                <li class="nav-item" data-active="5">
                    <a class="nav-link" id="xemtt" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-department"?> > <i class="bi bi-person-lines-fill"></i>Phòng ban</a>
                </li>
                <li class="nav-item" data-active="6">
                    <a class="nav-link" id="ungluong" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-overtime"?>"> <i class="bi bi-cash-coin"></i>Tăng ca</a>
                </li>
                <li class="nav-item" data-active="7">
                    <a class="nav-link" id="tinhluong" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-position"?>"> <i class="bi bi-calculator"></i> Chức vụ </a>
                </li>
                <li class="nav-item" data-active="8">
                    <a class="nav-link" id="tinhluong" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/admin?page=admin-salary-slip"?>"> <i class="bi bi-calculator"></i> Phiếu ứng lương </a>
                </li>
                <li class="nav-item" data-active="9">
                    <a class="nav-link" id="exit"> <i class="bi bi-box-arrow-left"></i> Logout </a>
                </li>
            </ul> <!-- Divider -->
        </div>
    </div>
</nav> <!-- Main content -->

<?php $this->end(); ?>