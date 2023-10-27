<style>
    table {
        width: 1366px !important;
        height: 350px !important;
        margin-bottom: 0 !important;
    }

    .left {
        padding-left: 50px !important;
    }

    .right {
        width: 226px !important;
    }

    table td {
        font-size: 20px !important;
    }

    .title {
        text-align: end;
        width: 226px !important;
    }

    #tb {
        height: 350px;
        flex-direction: column;
    }

    #tb i {
        color: red;
        font-size: 200px;
        margin-bottom: 10px;

    }

    #tb b {
        color: red;
        font-size: 32px;
    }
</style>
<div id="thang" class="carousel slide" data-bs-interval="false">
    <div class="carousel-inner">
        <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
        if (!isset($_SESSION)) {
            session_start();
            echo $_SESSION["MaNV"];
        }
        function MoneyFormat($tien)
        {
            return number_format($tien, 0, ',', '.') . " VNĐ";
        }
        $counter = 1;
        if (date('m') > 1) {
            $thang = date('m') - 1;
            $nam = date('Y');
        } else {
            $thang = 12;
            $nam = date('Y') - 1;
        }

        for ($i = 8; $i <= $thang; $i++) {
            if ($counter == $thang - 8 + 1) {
                $actives = 'active';
            }
            $sqlLuong = "SELECT * FROM phieu_luong where MaNV = '$_SESSION[MaNV]' and Thang = $i and Nam = $nam";
            $resultLuong = mysqli_query($conn, $sqlLuong);
        ?>
            <div class="carousel-item <?= $actives; ?>">
                <div class="g-6 mb-6 w-100 search-container">
                    <div class="col-xl-12 col-sm-12 col-12">
                        <div class="card shadow border-1 mb-7">
                            <div class="card-header">
                                <h4 align='center' class="mb-1 mt-1"><?= "BẢNG LƯƠNG THÁNG $i NĂM $nam" ?></h4>
                            </div>
                            <?php
                            if (mysqli_num_rows($resultLuong) > 0) {
                                $ttLuong = mysqli_fetch_array($resultLuong);
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-nowrap">
                                        <tr>
                                            <td class="title left">Số ngày công:</td>
                                            <td><?= $ttLuong['SoNgayCong'] ?></td>
                                            <td class="title  ">Số ngày vắng:</td>
                                            <td><?= $ttLuong['SoNgayVang'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="title left">Lương tăng ca:</td>
                                            <td><?= MoneyFormat($ttLuong['LuongTangCa']) ?></td>
                                            <td class="title ">Tiền tạm ứng:</td>
                                            <td><?= MoneyFormat($ttLuong['TienTamUng']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="title left">Trợ cấp:</td>
                                            <td><?= MoneyFormat($ttLuong['TroCap']) ?></td>
                                            <td class="title ">Trừ bảo hiểm:</td>
                                            <td><?= MoneyFormat($ttLuong['TruBaoHiem']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="title left">Phạt:</td>
                                            <td><?php if ($ttLuong['Phat'] > 0) {
                                                    echo MoneyFormat($ttLuong['Phat']);
                                                } else echo 0; ?></td>
                                            <td class="title">Thưởng:</td>
                                            <td><?= MoneyFormat($ttLuong['Thuong']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="title left">Tiền lương tháng:</td>
                                            <td><?= MoneyFormat($ttLuong['TienLuongThang']) ?></td>
                                            <td class="title ">Tổng thu nhập:</td>
                                            <td><?= MoneyFormat($ttLuong['TongThuNhap']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="title left">Thuế:</td>
                                            <td><?= MoneyFormat($ttLuong['Thue']) ?></td>

                                            <td class="title ">Thực lĩnh:</td>
                                            <td><?= MoneyFormat($ttLuong['ThucLinh']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="title left">Ghi chú:</td>
                                            <td id="no_color" colspan="3">
                                                <?= $ttLuong['GhiChu'] ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <div class=" d-flex w-100 justify-content-center align-items-center">
                                    <div id="tb" class="d-flex w-50 justify-content-center align-items-center">
                                        <i class="bi bi-exclamation-triangle"></i>
                                        <b>Chưa được tính lương</b>
                                        <br>
                                        <b>Vui lòng khiếu nại với nhân viên kế toán !</b>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            $counter++;
        }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#thang" data-bs-slide="prev" style="left: -20px;">
        <i style="color: black; font-size: 50px; position:fixed; top: 39%; left: 4%" class="bi bi-caret-left-fill"></i>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#thang" data-bs-slide="next" style="right: -20px;">
        <i style="color: black; font-size: 50px; position:fixed; top: 39%;right: 3.5%" class="bi bi-caret-right-fill"></i>
    </button>
</div>

<?php

?>