<html>
<?php $this->renderSection('header_employee'); ?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once($_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1]."/connect.php"); 
$sqlTT = "select HoNV, TenNV, Hinh from nhan_vien
        where MaNV = '$_SESSION[MaNV]'";
$resultTT = mysqli_query($conn, $sqlTT);
if (mysqli_num_rows($resultTT) > 0) {
    $TT = mysqli_fetch_array($resultTT);
}
?>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div>
        <!-- BEGIN USER PROFILE -->
        <div class="col-md-12">
            <div class="grid profile">
                <div class="grid-header">
                    <div class="d-flex">
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-circle" alt="">
                        <div>
                            <h1>PHÒNG KHÁM ĐA KHOA THIỆN TRANG</h1>
                            <h2><?= $TT["HoNV"] . " " . $TT["TenNV"] ?></h2>
                        </div>
                    </div>
                </div>
                <div class="grid-body">
                    <?php $this->renderSection('content'); ?>
                </div>
            </div>
        </div>
        <!-- END USER PROFILE -->
</body>

</html>