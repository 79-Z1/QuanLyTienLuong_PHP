<?php $this->section('navbar_exercise'); ?>
<style>
    li a{
        font-size: 17px !important;
    }
</style>
<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
    <div class="container-fluid">
        <!-- Toggler --> <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button> <!-- Brand -->
        <a class="navbar-brand py-1 mb-lg-5 px-2 me-0" href="http://localhost/QuanLyTienLuong_PHP/views/pages/exercise/"> <img style="width:242px !important; height: 70px" src="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/logo.png" ?>" alt="Logo Công Ty Á"> </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item" data-active="1">
                    <a class="nav-link" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/exercise"?> > <i class="bi bi-emoji-kiss-fill"></i> Giới thiệu </a>
                </li>
                <li class="nav-item" data-active="2">
                    <a class="nav-link" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/exercise/TranNgocTien"?>"><i class="bi bi-person-fill"></i>Trần Ngọc Tiến</a>
                </li>
                <li class="nav-item" data-active="3">
                    <a class="nav-link" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/exercise/PhamNgocTuyen"?>"><i class="bi bi-person-fill"></i>Phạm Ngọc Tuyển</a>
                </li>
                <li class="nav-item" data-active="4">
                    <a class="nav-link" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/exercise/LeHoangThien"?>"><i class="bi bi-person-fill"></i>Lê Hoàng Thiện</a>
                </li>
                <li class="nav-item" data-active="5">
                    <a class="nav-link" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/exercise/NguyenDuyThien"?>"><i class="bi bi-person-fill"></i>Nguyễn Duy Thiên</a>
                </li>
                <li class="nav-item" data-active="6">
                    <a class="nav-link" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/views/pages/exercise/TruongKhanhHoa"?>"><i class="bi bi-person-fill"></i>Trương Khánh Hòa</a>
                </li>
                <li class="nav-item" data-active="7">
                    <a href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1]?>" class="nav-link"> <i class="bi bi-box-arrow-left"></i> Đăng nhập </a>
                </li>
            </ul>
        </div>
    </div>
</nav> <!-- Main content -->
<?php $this->end(); ?>