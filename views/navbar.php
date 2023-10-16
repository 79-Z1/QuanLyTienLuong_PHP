<?php $this->section('navbar'); ?>
<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
    <div class="container-fluid">
        <!-- Toggler --> <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button> <!-- Brand --> <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="/admin/ketoan"> <img style="height: 91px !important;" src="/img/laugau.png" alt="..."> </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" id="xemtt" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/accountant?page=accountant-list-employee-info"?> > <i class="bi bi-person-lines-fill"></i> Xem thông tin nhân viên </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ungluong" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/accountant?page=accountant-check-salary-advance"?>"> <i class="bi bi-cash-coin"></i>Kiểm tra ứng lương
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tinhluong" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/accountant?page=accountant-payroll"?>"> <i class="bi bi-calculator"></i> Tính lương </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="thongke" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/accountant?page=accountant-statistic"?>"><i class="bi bi-clipboard-data"></i>Báo cáo thống kê </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="exit"> <i class="bi bi-box-arrow-left"></i> Logout </a>
                </li>
            </ul> <!-- Divider -->
        </div>
    </div>
</nav> <!-- Main content -->

<?php $this->end(); ?>