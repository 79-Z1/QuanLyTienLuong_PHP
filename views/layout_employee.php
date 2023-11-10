<html>
<?php $this->renderSection('header_employee'); ?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
$sqlTT = "select MaNV, HoNV, TenNV, Hinh from nhan_vien
        where MaNV = '$_SESSION[MaNV]'";
$resultTT = mysqli_query($conn, $sqlTT);
if (mysqli_num_rows($resultTT) > 0) {
    $TT = mysqli_fetch_array($resultTT);
}
?>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div id="profile-container">
        <!-- BEGIN USER PROFILE -->
        <div class="grid profile">
            <div class="grid-header">
                <div class="d-flex justify-content-start">
                    <img src="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/imgnv/$TT[Hinh]" ?>" alt="Ảnh nhân viên">
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
</body>
</html>