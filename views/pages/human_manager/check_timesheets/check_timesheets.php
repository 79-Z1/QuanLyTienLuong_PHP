<?php $this->layout('layout_manager') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

$dN = date('d');
$mN = date('m');
$yN = date('Y');

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

            $sqlgetThang = "SELECT DISTINCT month(Ngay) as thangtrongnam, year(Ngay) as nam from cham_cong 
                ORDER BY year(Ngay) ";

            $resultgetThang = mysqli_query($conn, $sqlgetThang);
            $chamCongTonTai = mysqli_num_rows($resultgetThang);

            if ($chamCongTonTai > 0) {
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
                                            $sqlgetTen1 = "SELECT MaNV, HoNV, TenNV from nhan_vien";
                                            $resultgetTen1 = mysqli_query($conn, $sqlgetTen1);
                                            $numRows = mysqli_num_rows($resultgetTen1);
                                            $sqlgetTen1 .= " limit $offset, $rowsPerPage";
                                            $resultgetTen1 = mysqli_query($conn, $sqlgetTen1);
                                            while ($rowTen = mysqli_fetch_array($resultgetTen1)) {
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
                                <div class="card-header d-flex justify-content-between">
                                    <h3 class="mb-0">THÁNG <?= $rowsThang['thangtrongnam'] ?> NĂM <?= $rowsThang['nam'] ?></h3>
                                    <form action="" method="post">
                                        <input type="text" name="thangIN" value="<?= $rowsThang['thangtrongnam'] ?>" style="display: none;">
                                        <input type="text" name="namIN" value="<?= $rowsThang['nam'] ?>" style="display: none;">
                                        <input class="button" type="submit" value="Xuất Excel" name="xuat">
                                    </form>
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
                                                        $sqlgetCC = "SELECT TinhTrang, day(Ngay) as ngay from cham_cong where MaNV = '$rowTen[MaNV]' and day(Ngay) = $i and month(Ngay) = $rowsThang[thangtrongnam] and year(Ngay) = $rowsThang[nam]";
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
                        <?php
                        if (isset($_POST['xuat'])) {

                            $sqlgetTen1 = "SELECT MaNV, HoNV, TenNV from nhan_vien";
                            $resultgetTen1 = mysqli_query($conn, $sqlgetTen1);
                            if (mysqli_num_rows($resultgetTen1) <> 0) {
                                $spreadsheet = new Spreadsheet();
                                $sheet = $spreadsheet->getActiveSheet();

                                $sheet->getColumnDimension('B')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('G')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('H')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('I')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('J')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('K')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('L')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('M')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('N')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('O')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('P')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('Q')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('R')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('S')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('T')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('U')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('V')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('W')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('X')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('Y')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('AA')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('AB')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('AC')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('AD')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('AE')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('AF')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension('AG')->setAutoSize(false)->setWidth(3.89);

                                $sheet->mergeCells("A1:AG1");
                                $sheet->setCellValue('A1', 'PHÒNG KHÁM ĐA KHOA THIỆN TRANG');
                                $sheet->getColumnDimension('A1')->setAutoSize(true);
                                $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('0070C0');
                                $sheet->getStyle('A1')->getFont()->setBold(true)->setName('Times New Roman')->setSize(20)->getColor()->setRGB('FFFFFF');
                                $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

                                $sheet->mergeCells("A2:AG2");
                                $sheet->setCellValue('A2', 'BẢNG CHẤM CÔNG');
                                $sheet->getColumnDimension('A2')->setAutoSize(true);
                                $sheet->getStyle('A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                                $sheet->getStyle('A2')->getFont()->setBold(true)->setName('Times New Roman')->setSize(18)->getColor()->setRGB('FF0000');
                                $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

                                $sheet->mergeCells("A3:AG3");
                                $sheet->setCellValue('A3', "Tháng $_POST[thangIN] Năm $_POST[namIN] ");
                                $sheet->getColumnDimension('A3')->setAutoSize(true);
                                $sheet->getStyle('A3')->getFont()->setBold(true)->setName('Times New Roman')->setSize(16)->getColor()->setRGB('FF0000');;
                                $sheet->getStyle('A3')->getAlignment()->setHorizontal('center');

                                $sheet->mergeCells("A4:AG4");


                                foreach (range('C', 'AG') as $letra) {
                                    $sheet->getColumnDimension($letra)->setAutoSize(true);
                                    $sheet->getStyle($letra . "6")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00B050');
                                    $sheet->getStyle($letra . "6")->getFont()->setBold(true)->setName('Times New Roman')->setSize(12);
                                    $sheet->getStyle($letra . "6")->getAlignment()->setHorizontal('center');
                                    $sheet->getStyle($letra . "6")->getAlignment()->setVertical('center');
                                }
                                $sheet->getColumnDimension("A5")->setAutoSize(true);
                                $sheet->getStyle("A5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00B050');
                                $sheet->getStyle("A5")->getFont()->setBold(true)->setName('Times New Roman')->setSize(12);
                                $sheet->getStyle("A5")->getAlignment()->setHorizontal('center');
                                $sheet->getStyle("A5")->getAlignment()->setVertical('center');
                                $sheet->mergeCells("A5:A7");
                                $sheet->setCellValue('A5', 'STT');

                                $sheet->mergeCells("B5:B7");
                                $sheet->getColumnDimension("B5")->setAutoSize(true);
                                $sheet->getStyle("B5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00B050');
                                $sheet->getStyle("B5")->getFont()->setBold(true)->setName('Times New Roman')->setSize(12);
                                $sheet->getStyle("B5")->getAlignment()->setHorizontal('center');
                                $sheet->getStyle("B5")->getAlignment()->setVertical('center');
                                $sheet->setCellValue('B5', 'Họ và tên');

                                $sheet->getColumnDimension("C5")->setAutoSize(true);
                                $sheet->getStyle("C5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00B050');
                                $sheet->getStyle("C5")->getFont()->setBold(true)->setName('Times New Roman')->setSize(12);
                                $sheet->getStyle("C5")->getAlignment()->setHorizontal('center');
                                $sheet->getStyle("C5")->getAlignment()->setVertical('center');
                                $sheet->mergeCells("C5:AG5");
                                $sheet->setCellValue('C5', 'Ngày trong tháng');
                                $cot = "C";
                                $ngaytrongthang = cal_days_in_month(CAL_GREGORIAN, $_POST['thangIN'], $_POST['namIN']);

                                for ($i = 1; $i <= $ngaytrongthang; $i++) {
                                    $sheet->getStyle($cot . '7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00B050');
                                    $sheet->getStyle($cot . '7')->getFont()->setBold(true)->setName('Times New Roman');
                                    $sheet->getStyle($cot . '7')->getAlignment()->setHorizontal('center');
                                    $sheet->getStyle($cot . '7')->getAlignment()->setVertical('center');
                                    $sheet->setCellValue($cot . '7', $i);

                                    $ngayTrongTuan = $i . '-' . $_POST['thangIN'] . '-' . $_POST['namIN'];
                                    $day = GetDayOfWeek($ngayTrongTuan);
                                    $sheet->getStyle($cot . '6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00B050');
                                    $sheet->getStyle($cot . '6')->getFont()->setBold(true)->setName('Times New Roman');
                                    $sheet->getStyle($cot . '6')->getAlignment()->setHorizontal('center');
                                    $sheet->getStyle($cot . '6')->getAlignment()->setVertical('center');
                                    $sheet->setCellValue($cot . '6', $day);

                                    $cot++;
                                }
                                $numRow = 8;
                                $stt = 1;
                                while ($rows = mysqli_fetch_array($resultgetTen1)) {
                                    $sheet->getStyle('A' . $numRow)->getAlignment()->setHorizontal('center');
                                    $sheet->getStyle('B' . $numRow)->getAlignment()->setHorizontal('left');

                                    $sheet->setCellValue('A' . $numRow, $stt);
                                    $sheet->setCellValue('B' . $numRow, $rows['HoNV'] . " " . $rows['TenNV']);

                                    $numRow++;
                                    $stt++;
                                }
                                $numRow = 8;
                                $ngaytrongthang = cal_days_in_month(CAL_GREGORIAN, $_POST['thangIN'], $_POST['namIN']);
                                $sqlgetTen = "SELECT MaNV, HoNV, TenNV from nhan_vien";
                                $resultgetTen = mysqli_query($conn, $sqlgetTen);
                                if (mysqli_num_rows($resultgetTen) <> 0) {
                                    while ($rowTen = mysqli_fetch_array($resultgetTen)) {
                                        $col = "C";
                                        for ($i = 1; $i <= $ngaytrongthang; $i++) {
                                            $sqlgetCC = "SELECT TinhTrang, day(Ngay) as ngay from cham_cong where MaNV = '$rowTen[MaNV]' and day(Ngay) = $i and month(Ngay) = $_POST[thangIN]";
                                            $resultgetCC = mysqli_query($conn, $sqlgetCC);
                                            $rowCC = mysqli_fetch_array($resultgetCC);
                                            $numCC = mysqli_num_rows($resultgetCC);
                                            $sheet->getStyle($col . $numRow)->getAlignment()->setHorizontal('center');
                                            if (!is_null($rowCC)) {
                                                if ($rowCC['TinhTrang'] == 1 && $numCC == 1) {
                                                    $sheet->setCellValue($col . $numRow, "X");
                                                }
                                            } else {
                                                $sheet->getStyle($col . $numRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('808080');
                                                $sheet->setCellValue($col . $numRow, "");
                                            }
                                            $col++;
                                        }
                                        $numRow++;
                                    }
                                }

                                $sheet->mergeCells("X" . $numRow + 1 . ":AG" . $numRow + 1);
                                $sheet->setCellValue("X" . $numRow + 1, "Nha Trang, ngày $dN tháng $mN năm $yN");
                                $sheet->getColumnDimension("X" . $numRow + 1)->setAutoSize(true);
                                $sheet->getStyle("X" . $numRow + 1)->getFont()->setItalic(true)->setName('Times New Roman')->setSize(10);
                                $sheet->getStyle("X" . $numRow + 1)->getAlignment()->setHorizontal('center');

                                $sheet->mergeCells("X" . $numRow + 2 . ":AG" . $numRow + 2);
                                $sheet->setCellValue("X" . $numRow + 2, "Giám đốc Công ty");
                                $sheet->getColumnDimension("X" . $numRow + 2)->setAutoSize(true);
                                $sheet->getStyle("X" . $numRow + 2)->getFont()->setBold(true)->setName('Times New Roman')->setSize(10);
                                $sheet->getStyle("X" . $numRow + 2)->getAlignment()->setHorizontal('center');

                                $sheet->mergeCells("X" . $numRow + 3 . ":AG" . $numRow + 3);
                                $sheet->setCellValue("X" . $numRow + 3, "(Ký, họ tên, đóng dấu)");
                                $sheet->getColumnDimension("X" . $numRow + 3)->setAutoSize(true);
                                $sheet->getStyle("X" . $numRow + 3)->getFont()->setItalic(true)->setName('Times New Roman')->setSize(10);
                                $sheet->getStyle("X" . $numRow + 3)->getAlignment()->setHorizontal('center');

                                $sheet->mergeCells("R" . $numRow + 2 . ":U" . $numRow + 2);
                                $sheet->setCellValue("R" . $numRow + 2, "Quản lý nhân sự");
                                $sheet->getColumnDimension("R" . $numRow + 2)->setAutoSize(true);
                                $sheet->getStyle("R" . $numRow + 2)->getFont()->setBold(true)->setName('Times New Roman')->setSize(10);
                                $sheet->getStyle("R" . $numRow + 2)->getAlignment()->setHorizontal('center');

                                $sheet->mergeCells("R" . $numRow + 3 . ":U" . $numRow + 3);
                                $sheet->setCellValue("R" . $numRow + 3, "(Ký, họ tên)");
                                $sheet->getColumnDimension("R" . $numRow + 3)->setAutoSize(true);
                                $sheet->getStyle("R" . $numRow + 3)->getFont()->setItalic(true)->setName('Times New Roman')->setSize(10);
                                $sheet->getStyle("R" . $numRow + 3)->getAlignment()->setHorizontal('center');

                                $sheet->mergeCells("L" . $numRow + 2 . ":O" . $numRow + 2);
                                $sheet->setCellValue("L" . $numRow + 2, "Người lập bảng");
                                $sheet->getColumnDimension("L" . $numRow + 2)->setAutoSize(true);
                                $sheet->getStyle("L" . $numRow + 2)->getFont()->setBold(true)->setName('Times New Roman')->setSize(10);
                                $sheet->getStyle("L" . $numRow + 2)->getAlignment()->setHorizontal('center');

                                $sheet->mergeCells("L" . $numRow + 3 . ":O" . $numRow + 3);
                                $sheet->setCellValue("L" . $numRow + 3, "(Ký, họ tên)");
                                $sheet->getColumnDimension("L" . $numRow + 3)->setAutoSize(true);
                                $sheet->getStyle("L" . $numRow + 3)->getFont()->setItalic(true)->setName('Times New Roman')->setSize(10);
                                $sheet->getStyle("L" . $numRow + 3)->getAlignment()->setHorizontal('center');

                                $sheet->getStyle('A5:AG' . $numRow - 1)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));

                                $sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(3.89);
                                $sheet->getColumnDimension("Z")->setAutoSize(false)->setWidth(3.89);

                                $writer = new Xlsx($spreadsheet);
                                $filename = 'BangChamCongThang' . $_POST['thangIN'] . 'Nam' . $_POST['namIN'] . '.xlsx';
                                $pathname = $_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/ExcelResults/" . 'BangChamCongThang' . $_POST['thangIN'] . 'Nam' . $_POST['namIN'] . '.xlsx';
                                $writer->save($pathname);
                                header('Location: ' . "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/ExcelResults/" . $filename);
                            } else {
                                echo "Ko thể xuất file Excel do chưa có dữ liệu";
                            }
                        }
                        ?>
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
            } else {
                ?>
                <div class="d-flex h-100 w-100 justify-content-center align-items-center">
                    <div id="tb" class="d-flex  h-50 w-50 justify-content-center align-items-center">
                        <i class="bi bi-ban"></i>
                        <b>Chưa có dữ liệu chấm công!</b>
                    </div>
                </div>
            <?php } ?>
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