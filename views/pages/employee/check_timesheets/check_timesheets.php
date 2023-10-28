<?php
if (!isset($_SESSION)) {
    session_start();
}
function GetDayOfWeek($date)
{
    switch (date('w', strtotime($date))) {
        case '0':
            $day = 7;
            break;
        case '1':
            $day = 3;
            break;
        case '2':
            $day = 2;
            break;
        case '3':
            $day = 3;
            break;
        case '4':
            $day = 4;
            break;
        case '5':
            $day = 5;
            break;
        case '6':
            $day = 6;
            break;
    }
    return $day;
}
?>
<style>
    th{
        width: 14.3%;
        text-align: center;
    }
    td,h2{
        text-align: center;
    }
    td,th{
        border: 1px solid #000;
    }
</style>
<div class="card shadow border-0 mb-3">
    <div id="thang" class="carousel slide" data-bs-interval="false">
        <div class="carousel-inner">
            <?php
            $counter = 1;
            $yearnow = date('Y');

            $sqlgetThang = "SELECT month(Ngay) as thangtrongnam from cham_cong
            where year(Ngay) = 2023 
            and MaNV = '$_SESSION[MaNV]' 
            GROUP BY month(Ngay) 
            ORDER BY month(Ngay)";

            $resultgetThang = mysqli_query($conn, $sqlgetThang);

            while ($rowsThang = mysqli_fetch_array($resultgetThang)) {
                $actives = '';
                if ($counter == mysqli_num_rows($resultgetThang)) {
                    $actives = 'active';
                }
            ?>
                <div class="carousel-item <?= $actives; ?>">
                    <div class="card-header">
                        <h2 class="mb-0">Bảng chấm công tháng <?= $rowsThang['thangtrongnam'] ?></h3>
                    </div>
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th>Thứ 2</th>
                                <th>Thứ 3</th>
                                <th>Thứ 4</th>
                                <th>Thứ 5</th>
                                <th>Thứ 6</th>
                                <th>Thứ 7</th>
                                <th>Chủ nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dem = 0;
                            $demngay = 1;
                            $ngaytrongthang = cal_days_in_month(CAL_GREGORIAN, $rowsThang['thangtrongnam'], $yearnow);
                            $day = 1 . '-' . $rowsThang['thangtrongnam'] . '-' . $yearnow;
                            for ($i = 0; $i < 6; $i++) {
                            ?>
                                <tr>
                                    <?php
                                    for ($j = $demngay; $j <= $ngaytrongthang; $j++) {
                                        if ($j == 1) {
                                            for ($k = 1; $k < GetDayOfWeek($day); $k++) {

                                    ?>
                                                <td></td>
                                        <?php
                                                $dem++;
                                            }
                                        }
                                        $sqlChamCong = "SELECT TinhTrang FROM `cham_cong` WHERE MaNV = '$_SESSION[MaNV]' AND day(Ngay) = $j and month(Ngay) = $rowsThang[thangtrongnam]";
                                        $resultChamCong = mysqli_query($conn, $sqlChamCong);
                                        $chamCong = mysqli_fetch_array($resultChamCong);
                                        $bgcl = '';
                                        if ($chamCong['TinhTrang'] == 1)
                                            $bgcl = '#0080086e';
                                        else $bgcl = '#ff000091';
                                        ?>
                                        <td style="background-color: <?= $bgcl?>" ><?= $j ?></td>
                                    <?php
                                        $demngay++;
                                        $dem++;
                                        if ($dem == 7) {
                                            $dem = 0;
                                            break;
                                        }
                                    }
                                    ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
</div>