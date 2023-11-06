<?php $this->layout('layout_manager') ?>
<?php $this->section('content'); ?>
<style>
    [class*=" bi-"]::before,
    [class^=bi-]::before {
        height: 18.40px;
    }

    .date-board {
        overflow-x: scroll;
    }

    .table-split1 {
        width: 31%;
    }

    .table-split2 {
        width: 69%;
    }

    .table-split2 .date-board table thead,
    .table-split2 .date-board table thead tr th,
    .table-split2 .date-board table tbody tr td {
        border-left: 1px solid #00000012;
    }

    th,
    td {
        text-align: center;
    }

    td i {
        font-size: larger;
    }
    .pagination-link {
    display: inline-block;
    padding: 3px 5px;
    margin: 1px ;
    border: 1px solid #ccc;
    text-decoration: none;
    color: #333;
    font-size: 12px;
    border-radius: 15px;
}

.pagination-link.active {
    background-color: #333;
    color: #fff;

}

.pagination-link:not(.active) {
    font-weight: 400;
    font-size: 12px;
    color: #666;
}
.phanTrang{
    margin-top: 13px;
}
</style>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
$rowsPerPage = 9; //số mẩu tin trên mỗi trang

if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
$offset = ($_GET['p'] - 1) * $rowsPerPage;

function GetDayOfWeek($date)
{
    $day = '';
    switch (date('w', strtotime($date))) {
        case '0':
            $day = 'CN';
            break;
        case '1':
            $day = 'T2';
            break;
        case '2':
            $day = 'T3';
            break;
        case '3':
            $day = 'T4';
            break;
        case '4':
            $day = 'T5';
            break;
        case '5':
            $day = 'T6';
            break;
        case '6':
            $day = 'T7';
            break;
    }
    return $day;
}
?>
<div class="card shadow mt-1 border-0 mb-3" style="height:652px">
    <div id="thang" class="carousel slide" data-bs-interval="false">
        <div class="carousel-inner">
            <?php
            $counter = 1;

            $sqlgetThang = "SELECT month(Ngay) as thangtrongnam, year(Ngay) as nam from cham_cong 
            GROUP BY month(Ngay)
            ORDER BY month(Ngay) ";

            $resultgetThang = mysqli_query($conn, $sqlgetThang);

            while ($rowsThang = mysqli_fetch_array($resultgetThang)) {
                $actives = '';
                if ($counter == mysqli_num_rows($resultgetThang)) {
                    $actives = 'active';
                }
            ?>
                <div class="carousel-item <?= $actives; ?>">
                    <div style='display:flex; height:652px'>
                        <div class='table-split1'>
                            <div class="card-header">
                                <h3 style="padding-left: 30px;">BẢNG CHẤM CÔNG</h3>
                            </div>
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="padding-top: 32.5px;padding-bottom: 32.5px;">Mã <br> nhân viên</th>
                                        <th>
                                            <p align="start">HỌ VÀ TÊN</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $sqlgetTen = "SELECT MaNV, HoNV, TenNV from nhan_vien";
                                        $resultgetTen = mysqli_query($conn, $sqlgetTen);
                                        $numRows = mysqli_num_rows($resultgetTen);
                                        $sqlgetTen .= " limit $offset, $rowsPerPage";
                                        $resultgetTen = mysqli_query($conn, $sqlgetTen);
                                        while ($rowTen = mysqli_fetch_array($resultgetTen)) {
                                        ?>
                                            <td><?= $rowTen['MaNV'] ?></td>
                                            <td>
                                                <p align="start"><?= $rowTen['HoNV'] . ' ' . $rowTen['TenNV'] ?></p>
                                            </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class='table-split2'>
                            <div class="card-header">
                                <h3 class="mb-0">THÁNG <?= $rowsThang['thangtrongnam'] ?> NĂM <?= $rowsThang['nam'] ?></h3>
                            </div>
                            <div class='date-board'>
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <?php
                                            $ngaytrongthang = cal_days_in_month(CAL_GREGORIAN, $rowsThang['thangtrongnam'], $rowsThang['nam']);
                                            for ($i = 1; $i <= $ngaytrongthang; $i++) {
                                                $ngayTrongTuan = $i . '-' . $rowsThang['thangtrongnam'] . '-' . $rowsThang['nam'];
                                                $day = GetDayOfWeek($ngayTrongTuan);
                                                echo "<th>$day</th>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            $ngaytrongthang = cal_days_in_month(CAL_GREGORIAN, $rowsThang['thangtrongnam'], $rowsThang['nam']);
                                            for ($i = 1; $i <= $ngaytrongthang; $i++) {
                                                echo "<th>$i</th>";
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $sqlgetTen = "SELECT MaNV, HoNV, TenNV from nhan_vien";
                                            $resultgetTen = mysqli_query($conn, $sqlgetTen);
                                            $sqlgetTen .= " limit $offset, $rowsPerPage";
                                            $resultgetTen = mysqli_query($conn, $sqlgetTen);
                                            $icon = '';
                                            $ngaytrongthang = cal_days_in_month(CAL_GREGORIAN, $rowsThang['thangtrongnam'], $rowsThang['nam']);
                                            while ($rowTen = mysqli_fetch_array($resultgetTen)) {
                                                for ($i = 1; $i <= $ngaytrongthang; $i++) {
                                                    $sqlgetCC = "SELECT TinhTrang, day(Ngay) as ngay from cham_cong where MaNV = '$rowTen[MaNV]' and day(Ngay) = $i and month(Ngay) = $rowsThang[thangtrongnam]";
                                                    $resultgetCC = mysqli_query($conn, $sqlgetCC);
                                                    $rowCC = mysqli_fetch_array($resultgetCC);
                                                    $numCC = mysqli_num_rows($resultgetCC);
                                                    if (!is_null($rowCC)) {
                                                        if ($rowCC['TinhTrang'] == 1 && $numCC == 1) {
                                                            $icon = '<i class="bi bi-check-lg" style="color: green"></i>';
                                                        } else if ($rowCC['TinhTrang'] == 0 && $numCC == 1) {
                                                            $icon = '<i class="bi bi-x-lg" style="color: red"></i>';
                                                        }
                                                    } else $icon = '<i class="bi bi-ban"></i>';
                                            ?>
                                                    <td><a style="color: black" href='index.php?page=human-manager-edit-timesheet&MaNV=<?= $rowTen['MaNV'] ?>&Ngay=<?= $rowCC['ngay'] ?>&Thang=<?= $rowsThang['thangtrongnam'] ?>&Nam=<?= $rowsThang['nam'] ?>'><?= $icon ?></a></td>
                                                <?php } ?>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="phanTrang" align="center">
                        <?php
                        $maxPage = ceil($numRows / $rowsPerPage);
                        echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=human-manager-check-timesheets&p=" . (1) . "> Đầu trang </a> ";
                        echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=human-manager-check-timesheets&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "> < </a> ";


                        for ($i = 1; $i <= $maxPage; $i++) {
                            if ($i == $_GET['p']) {
                                echo '<b><a class="pagination-link active" href=' . $_SERVER['PHP_SELF'] . "?page=human-manager-check-timesheets&p=" . $i . ">" . $i . "</a></b> "; // Trang hiện tại sẽ được bôi đậm
                            } else {
                                echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=human-manager-check-timesheets&p=" . $i . ">" . $i . "</a> ";
                            }
                        }

                        echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=human-manager-check-timesheets&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . "> > </a>";
                        echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=human-manager-check-timesheets&p=" . ($maxPage) . "> Cuối trang </a> ";

                        echo "</p>";
                        ?>
                    </div>
                </div>
            <?php
                $counter++;
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#thang" data-bs-slide="prev" style="left: -20px;">
            <i style="color: black; font-size: 50px; position:fixed; top: 10px; left: 18.5%" class="bi bi-caret-left-fill"></i>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#thang" data-bs-slide="next" style="right: -20px;">
            <i style="color: black; font-size: 50px; position:fixed; top: 10px; right: 2.5%" class="bi bi-caret-right-fill"></i>
        </button>
    </div>
</div>
<?php $this->end(); ?>