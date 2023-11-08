<?php $this->section('navbar_accountant'); ?>
<style>
    li a{
        font-size: 17px !important;
    }
</style>
<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
    <div class="container-fluid">
        <!-- Toggler --> <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span> </button> <!-- Brand --> 
             <a class="navbar-brand py-1 mb-lg-5 px-2 me-0" href="http://dakhoathientrang.com/"> <img style="width:242px !important; height: 70px" src="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/logo.png" ?>" alt="Logo Công Ty Á"> </a>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item" data-active="1">
                    <a class="nav-link" href="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/accountant" ?>"> <i class="bi bi-person-lines-fill"></i> Danh sách nhân viên </a>
                </li>
                <li class="nav-item" data-active="2">
                    <a class="nav-link" id="ungluong" href="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/accountant?page=accountant-check-salary-advance" ?>"> <i class="bi bi-cash-coin"></i>Phiếu ứng lương
                    </a>
                </li>
                <li class="nav-item" data-active="3">
                    <a class="nav-link" href="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/accountant?page=accountant-payroll" ?>"> <i class="bi bi-calculator"></i> Tính lương </a>
                </li>
                <li class="nav-item" data-active="4">
                    <a class="nav-link" id="phieuluong" href="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/accountant?page=accountant-check-paycheck" ?>"> <i class="bi bi-card-checklist"></i> Bảng lương </a>
                </li>
                <li class="nav-item" data-active="5">
                    <a class="nav-link" id="thongke" href="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/accountant?page=accountant-statistic" ?>"><i class="bi bi-bar-chart-line-fill"></i> Báo cáo thống kê </a>
                </li>
                <li class="nav-item" data-active="6">
                    <a class="nav-link d-flex align-items-center" href="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/accountant?page=notification" ?>">
                        <i class="bi bi-bell"></i>Thông báo
                        <span id='num-noti' class="text-center ms-5"></span>
                    </a>
                </li>
                <li class="nav-item" data-active="7" id="Logout">
                    <a class="nav-link"> <i class="bi bi-box-arrow-left"></i> Logout </a>
                </li>
            </ul> <!-- Divider -->
        </div>
    </div>
</nav> <!-- Main content -->

<?php $this->end(); ?>