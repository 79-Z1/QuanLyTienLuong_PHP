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
<div class="card shadow border-0 mb-3">
    <div id="thangchamcong" class="carousel slide" data-bs-interval="false">
        <div class="carousel-inner">
            <?php
            $counter = 1;

            $sqlgetThang = "SELECT month(Ngay) as thangtrongnam, year(Ngay) as nam from cham_cong
            where MaNV = '$_SESSION[MaNV]' 
            GROUP BY month(Ngay) 
            ORDER BY month(Ngay)";

            $resultgetThang = mysqli_query($conn, $sqlgetThang);
            $chamCongTonTai = mysqli_num_rows($resultgetThang);

            if ($chamCongTonTai > 1) {

                while ($rowsThang = mysqli_fetch_array($resultgetThang)) {
                    $actives = '';
                    if ($counter == mysqli_num_rows($resultgetThang)) {
                        $actives = 'active';
                    }
            ?>
                    <div class="carousel-item <?= $actives; ?>">
                        <div class="card-header">
                            <h4 class="mb-1 mt-1">BẢNG CHẤM CÔNG THÁNG <?= $rowsThang['thangtrongnam'] ?> NĂM <?= $rowsThang['nam'] ?></h4>
                        </div>
                        <table id="timeSheets" class="table table-hover table-nowrap">
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
                                $ngaytrongthang = cal_days_in_month(CAL_GREGORIAN, $rowsThang['thangtrongnam'], $rowsThang['nam']);
                                $day = 1 . '-' . $rowsThang['thangtrongnam'] . '-' . $rowsThang['nam'];
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
                                            <td style="background-color: <?= $bgcl ?>"><?= $j ?></td>
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
            } else {
                ?>
                <div class=" d-flex w-100 justify-content-center align-items-center">
                    <div id="tb" class="d-flex w-50 justify-content-center align-items-center">
                        <i class="bi bi-exclamation-triangle"></i>
                        <b>Chưa được chấm công ngày nào</b>
                    </div>
                </div>

            <?php } ?>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#thangchamcong" data-bs-slide="prev" style="left: -20px;">
            <i style="color: black; font-size: 50px; position:fixed; top: 39%; left: 4%" class="bi bi-caret-left-fill"></i>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#thangchamcong" data-bs-slide="next" style="right: -20px;">
            <i style="color: black; font-size: 50px; position:fixed; top: 39%;right: 3.5%" class="bi bi-caret-right-fill"></i>
        </button>
    </div>
</div>