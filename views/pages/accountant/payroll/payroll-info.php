<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1]."/connect.php");
$sqlPL = "select * from phieu_luong
        where MaNV = '$_GET[MaNV]'";
$resultPL = mysqli_query($conn, $sqlPL);

if (mysqli_num_rows($resultPL) > 0) {
    $PL = mysqli_fetch_array($resultPL);
}

echo $_GET["MaNV"];

?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">PHIẾU LƯƠNG NHÂN VIÊN</h5>
            </div>
            <div class="table-responsive">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <?php
                        
                    ?>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>