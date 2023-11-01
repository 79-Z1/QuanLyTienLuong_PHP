<?php $this->layout('layout_accountant') ?>
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

if (date('m') > 1) {
	$thang = date('m') - 1;
	$nam = date('Y');
} else {
	$thang = 12;
	$nam = date('Y') - 1;
}
if (isset($_POST['thang'])) {
	$thangChon = $_POST['thang'];
} else $thangChon = $thang;
if (isset($_POST['nam'])) {
	$namChon = $_POST['nam'];
} else $namChon = $nam;

function MoneyFormat($tien)
{
	return number_format($tien, 0, ',', '.');
}
$sqlPhieuLuong = "SELECT * FROM phieu_luong, nhan_vien, phong_ban, chuc_vu
								WHERE phieu_luong.MaNV = nhan_vien.MaNV 
								and nhan_vien.MaChucVu = chuc_vu.MaChucVu
								and nhan_vien.MaPhong = phong_ban.MaPhong
								and Thang = $thangChon and $nam = $namChon";
$resultPhieuLuong = mysqli_query($conn, $sqlPhieuLuong);

$lt10 = mysqli_num_rows(mysqli_query($conn, "SELECT MaNV FROM `phieu_luong` WHERE Thang = $thangChon and Nam = $namChon and ThucLinh < 10000000"));
$bt10_15 = mysqli_num_rows(mysqli_query($conn, "SELECT MaNV FROM `phieu_luong` WHERE Thang = $thangChon and Nam = $namChon and ThucLinh > 10000000 and ThucLinh <= 15000000"));
$bt15_20 = mysqli_num_rows(mysqli_query($conn, "SELECT MaNV FROM `phieu_luong` WHERE Thang = $thangChon and Nam = $namChon and ThucLinh > 15000000 and ThucLinh <= 20000000"));
$bt20_25 = mysqli_num_rows(mysqli_query($conn, "SELECT MaNV FROM `phieu_luong` WHERE Thang = $thangChon and Nam = $namChon and ThucLinh > 20000000 and ThucLinh <= 25000000"));
$gt25 = mysqli_num_rows(mysqli_query($conn, "SELECT MaNV FROM `phieu_luong` WHERE Thang = $thangChon and Nam = $namChon and ThucLinh > 25000000"));

$dataPoints = array(
	array("y" => $lt10, "label" => "Nhỏ hơn 10"),
	array("y" => $bt10_15, "label" => "Từ 10 đến 15"),
	array("y" => $bt15_20, "label" => "Từ 15 đến 20"),
	array("y" => $bt20_25, "label" => "Từ 20 đến 25"),
	array("y" => $gt25, "label" => "Trên 25")
);
$dataPoints2 = array();
$sqlPhongBan = "SELECT * FROM phong_ban";
$resultPhong = mysqli_query($conn, $sqlPhongBan);
if (mysqli_num_rows($resultPhong) > 0) {
	while ($row = mysqli_fetch_array($resultPhong)) {
		$sqlAVG = "SELECT AVG(ThucLinh) from phieu_luong, nhan_vien WHERE phieu_luong.MaNV = nhan_vien.MaNV 
									and nhan_vien.MaPhong = '$row[MaPhong]' and Thang = $thangChon and Nam = $namChon";
		$resultAVG = mysqli_query($conn, $sqlAVG);
		if (mysqli_num_rows($resultAVG) > 0) {
			while ($rows = mysqli_fetch_row($resultAVG)) {
				$dataPoints2[] = array("y" => $rows[0], "label" => "$row[TenPhong]");
			}
		} else {
			$dataPoints2[] = array("y" => 0, "label" => "$row[TenPhong]");
		}
	}
}

?>
<style>
	td,
	th {
		padding: 15px !important;
	}

	.ct {
		text-align: center;
	}

	.form-select {
		padding: .375rem 2.25rem .375rem .75rem !important;
	}

	tbody {
		height: 200px;
		overflow-y: scroll;
	}

	.button {
		display: inline-block;
		padding: 8px 20px;
		font-size: 18px;
		cursor: pointer;
		text-align: center;
		text-decoration: none;
		outline: none;
		color: #fff;
		background-color: #03C03C;
		border: none;
		border-radius: 15px;
		box-shadow: 0 9px #97ed8a;
	}

	.button:hover {
		background-color: #157806;
	}

	.button:active {
		background-color: #157806;
		box-shadow: 0 5px #666;
		transform: translateY(4px);
	}

	.tableWrap {
		height: 547px;
		overflow: auto;
	}

	/* Set header to stick to the top of the container. */
	thead tr th {
		background-color: #fefefe !important;
		position: sticky;
		z-index: 9999;
		top: 0;
	}

	#tb {
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
<form action="" method="post">
	<div class="card shadow border-0 mb-7 mt-5">
		<div class="card-header d-flex justify-content-between">
			<div>
				<h3>BÁO CÁO THỐNG KÊ LƯƠNG</h3>
			</div>
			<div>
				<b style="font-size:20px;">Tháng</b>
				<input style="font-size:20px; padding-left:20px" type="number" min="8" max="<?= $thang ?>" name="thang" value="<?= $thangChon ?>">
				<b style="font-size:20px;">Năm</b>
				<input style="font-size:20px; padding-left:20px" type="number" min="2023" max="<?= $nam ?>" size="4" type="text" name="nam" value="<?= $namChon ?>">
				<b style="font-size:20px;">Chế độ xem</b>
				<input type="radio" name="radCD" value="1" <?php if (isset($_POST['radCD']) && $_POST['radCD'] == '1') echo 'checked="checked"'; ?> checked />
				Bảng dữ liệu
				<input type="radio" name="radCD" value="0" <?php if (isset($_POST['radCD']) && $_POST['radCD'] == '0') echo 'checked="checked"'; ?> />
				Biểu đồ
				<input id="xacNhan" class="button p-2" style="margin-left: 20px;" type="submit" name="xacNhan" value="Xác nhận">
				<input id="xuat" class="button p-2" style="margin-left: 20px;" type="submit" name="xuat" value="Xuất Excel">
			</div>
		</div>
		<?php


		if (isset($_POST['xuat'])) {

			if (mysqli_num_rows($resultPhieuLuong) <> 0) {
				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();

				$sheet->mergeCells("H1:M1");
				$sheet->setCellValue('H1', 'PHÒNG KHÁM ĐA KHOA THIỆN TRANG');
				$sheet->getColumnDimension('H1')->setAutoSize(true);
				$sheet->getStyle('H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('0070C0');
				$sheet->getStyle('H1')->getFont()->setBold(true)->setName('Times New Roman')->setSize(20)->getColor()->setRGB('FFFFFF');
				$sheet->getStyle('H1')->getAlignment()->setHorizontal('center');

				$sheet->mergeCells("A2:T2");
				$sheet->setCellValue('A2', 'BẢNG BÁO CÁO LƯƠNG');
				$sheet->getColumnDimension('A2')->setAutoSize(true);
				$sheet->getStyle('A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
				$sheet->getStyle('A2')->getFont()->setBold(true)->setName('Times New Roman')->setSize(18)->getColor()->setRGB('FF0000');
				$sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

				$sheet->mergeCells("A3:T3");
				$sheet->setCellValue('A3', "Tháng $thangChon Năm $namChon ");
				$sheet->getColumnDimension('A3')->setAutoSize(true);
				$sheet->getStyle('A3')->getFont()->setBold(true)->setName('Times New Roman')->setSize(16)->getColor()->setRGB('FF0000');;
				$sheet->getStyle('A3')->getAlignment()->setHorizontal('center');

				$sheet->mergeCells("Q4:T4");
				$sheet->setCellValue('Q4', "Đơn vị tính: Việt Nam Đồng");
				$sheet->getColumnDimension('Q4')->setAutoSize(true);
				$sheet->getStyle('Q4')->getFont()->setUnderline(true)->setItalic(true)->setName('Times New Roman')->setSize(10);
				$sheet->getStyle('Q4')->getAlignment()->setHorizontal('center');

				foreach (range('A', 'T') as $letra) {
					$sheet->getColumnDimension($letra)->setAutoSize(true);
					$sheet->getStyle($letra . "5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('B8CCE4');
					$sheet->getStyle($letra . "5")->getFont()->setBold(true)->setName('Times New Roman')->setSize(12);
					$sheet->getStyle($letra . "5")->getAlignment()->setHorizontal('center');
				}
				$sheet->setCellValue('A5', 'STT');
				$sheet->setCellValue('B5', 'Mã phiếu lương');
				$sheet->setCellValue('C5', 'Mã nhân viên');
				$sheet->setCellValue('D5', 'Họ tên');
				$sheet->setCellValue('E5', 'Phòng');
				$sheet->setCellValue('F5', 'Chức vụ');
				$sheet->setCellValue('G5', 'Hệ số lương');
				$sheet->setCellValue('H5', 'Số ngày công');
				$sheet->setCellValue('I5', 'Số ngày vắng');
				$sheet->setCellValue('J5', 'Lương tăng ca');
				$sheet->setCellValue('K5', 'Tiền tạm ứng');
				$sheet->setCellValue('L5', 'Trợ cấp');
				$sheet->setCellValue('M5', 'Trừ bảo hiểm');
				$sheet->setCellValue('N5', 'Phạt');
				$sheet->setCellValue('O5', 'Thưởng');
				$sheet->setCellValue('P5', 'Tiền lương tháng');
				$sheet->setCellValue('Q5', 'Tổng thu nhập');
				$sheet->setCellValue('R5', 'Thuế TNCN');
				$sheet->setCellValue('S5', 'Thực lĩnh');
				$sheet->setCellValue('T5', 'Ghi chú');

				$numRow = 6;
				$stt = 	1;
				while ($rows = mysqli_fetch_array($resultPhieuLuong)) {
					$sheet->getStyle('A' . $numRow)->getAlignment()->setHorizontal('center');
					$sheet->getStyle('B' . $numRow)->getAlignment()->setHorizontal('center');
					$sheet->getStyle('C' . $numRow)->getAlignment()->setHorizontal('center');
					$sheet->getStyle('G' . $numRow)->getAlignment()->setHorizontal('center');
					$sheet->getStyle('H' . $numRow)->getAlignment()->setHorizontal('center');
					$sheet->getStyle('I' . $numRow)->getAlignment()->setHorizontal('center');
					$sheet->getStyle('J' . $numRow)->getAlignment()->setHorizontal('right');
					$sheet->getStyle('K' . $numRow)->getAlignment()->setHorizontal('right');
					$sheet->getStyle('L' . $numRow)->getAlignment()->setHorizontal('right');
					$sheet->getStyle('M' . $numRow)->getAlignment()->setHorizontal('right');
					$sheet->getStyle('N' . $numRow)->getAlignment()->setHorizontal('right');
					$sheet->getStyle('O' . $numRow)->getAlignment()->setHorizontal('right');
					$sheet->getStyle('P' . $numRow)->getAlignment()->setHorizontal('right');
					$sheet->getStyle('Q' . $numRow)->getAlignment()->setHorizontal('right');
					$sheet->getStyle('R' . $numRow)->getAlignment()->setHorizontal('right');
					$sheet->getStyle('S' . $numRow)->getAlignment()->setHorizontal('right');
					$sheet->setCellValue('A' . $numRow, $stt);
					$sheet->setCellValue('B' . $numRow, $rows['MaPhieuLuong']);
					$sheet->setCellValue('C' . $numRow, $rows['MaNV']);
					$sheet->setCellValue('D' . $numRow, $rows['HoNV'] . " " . $rows['TenNV']);
					$sheet->setCellValue('E' . $numRow, $rows['TenPhong']);
					$sheet->setCellValue('F' . $numRow, $rows['TenChucVu']);
					$sheet->setCellValue('G' . $numRow, $rows['HeSoLuong']);
					$sheet->setCellValue('H' . $numRow, $rows['SoNgayCong']);
					$sheet->setCellValue('I' . $numRow, $rows['SoNgayVang']);
					$sheet->setCellValue('J' . $numRow, MoneyFormat($rows['LuongTangCa']));
					$sheet->setCellValue('K' . $numRow, MoneyFormat($rows['TienTamUng']));
					$sheet->setCellValue('L' . $numRow, MoneyFormat($rows['TroCap']));
					$sheet->setCellValue('M' . $numRow, MoneyFormat($rows['TruBaoHiem']));
					$sheet->setCellValue('N' . $numRow, MoneyFormat($rows['Thuong']));
					$sheet->setCellValue('O' . $numRow, MoneyFormat($rows['Phat']));
					$sheet->setCellValue('P' . $numRow, MoneyFormat($rows['TienLuongThang']));
					$sheet->setCellValue('Q' . $numRow, MoneyFormat($rows['TongThuNhap']));
					$sheet->setCellValue('R' . $numRow, MoneyFormat($rows['Thue']));
					$sheet->setCellValue('S' . $numRow, MoneyFormat($rows['ThucLinh']));
					$sheet->setCellValue('T' . $numRow, $rows['GhiChu']);

					$numRow++;
					$stt++;
				}

				$sheet->mergeCells("S" . $numRow +1 . ":T" . $numRow +1 );
				$sheet->setCellValue("S" . $numRow +1, "Nha Trang, ngày $dN tháng $mN năm $yN");
				$sheet->getColumnDimension("S" . $numRow +1)->setAutoSize(true);
				$sheet->getStyle("S" . $numRow +1)->getFont()->setItalic(true)->setName('Times New Roman')->setSize(10);
				$sheet->getStyle("S" . $numRow +1)->getAlignment()->setHorizontal('center');

				$sheet->mergeCells("S" . $numRow +2 . ":T" . $numRow +2 );
				$sheet->setCellValue("S" . $numRow +2, "Giám đốc Công ty");
				$sheet->getColumnDimension("S" . $numRow +2)->setAutoSize(true);
				$sheet->getStyle("S" . $numRow +2)->getFont()->setBold(true)->setName('Times New Roman')->setSize(10);
				$sheet->getStyle("S" . $numRow +2)->getAlignment()->setHorizontal('center');

				$sheet->mergeCells("S" . $numRow +3 . ":T" . $numRow +3 );
				$sheet->setCellValue("S" . $numRow +3, "(Ký, họ tên, đóng dấu)");
				$sheet->getColumnDimension("S" . $numRow +3)->setAutoSize(true);
				$sheet->getStyle("S" . $numRow +3)->getFont()->setItalic(true)->setName('Times New Roman')->setSize(10);
				$sheet->getStyle("S" . $numRow +3)->getAlignment()->setHorizontal('center');

				$sheet->setCellValue("Q" . $numRow +2, "Kế toán trưởng");
				$sheet->getColumnDimension("Q" . $numRow +2)->setAutoSize(true);
				$sheet->getStyle("Q" . $numRow +2)->getFont()->setBold(true)->setName('Times New Roman')->setSize(10);
				$sheet->getStyle("Q" . $numRow +2)->getAlignment()->setHorizontal('center');

				$sheet->setCellValue("Q" . $numRow +3, "(Ký, họ tên)");
				$sheet->getColumnDimension("Q" . $numRow +3)->setAutoSize(true);
				$sheet->getStyle("Q" . $numRow +3)->getFont()->setItalic(true)->setName('Times New Roman')->setSize(10);
				$sheet->getStyle("Q" . $numRow +3)->getAlignment()->setHorizontal('center');

				$sheet->mergeCells("N" . $numRow +2 . ":O" . $numRow +2 );
				$sheet->setCellValue("N" . $numRow +2, "Người lập báo cáo");
				$sheet->getColumnDimension("N" . $numRow +2)->setAutoSize(true);
				$sheet->getStyle("N" . $numRow +2)->getFont()->setBold(true)->setName('Times New Roman')->setSize(10);
				$sheet->getStyle("N" . $numRow +2)->getAlignment()->setHorizontal('center');

				$sheet->mergeCells("N" . $numRow +3 . ":O" . $numRow +3 );
				$sheet->setCellValue("N" . $numRow +3, "(Ký, họ tên)");
				$sheet->getColumnDimension("N" . $numRow +3)->setAutoSize(true);
				$sheet->getStyle("N" . $numRow +3)->getFont()->setItalic(true)->setName('Times New Roman')->setSize(10);
				$sheet->getStyle("N" . $numRow +3)->getAlignment()->setHorizontal('center');

				$sheet->getStyle('A1:T' . $numRow - 1)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
				$writer = new Xlsx($spreadsheet);
				$filename = 'BaoCaoLuongThang' . $thangChon . 'Nam' . $namChon . '.xlsx';
				$pathname = $_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/ExcelResults/" . 'BaoCaoLuongThang' . $thangChon . 'Nam' . $namChon . '.xlsx';
				$writer->save($pathname);
				header('Location: ' . "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/ExcelResults/" . $filename);
			} else {
				echo "Ko thể xuất file Excel do chưa có dữ liệu";
			}
		}
		if (isset($_POST['xacNhan'])) {
			if ($_POST['radCD'] == "1") {
				if (mysqli_num_rows($resultPhieuLuong) <> 0) {
		?>
					<div style="overflow:scroll; width:100%; height:574px;">

						<div class="card shadow border-0 mb-3">
							<table class="table table-hover table-nowrap">
								<thead>
									<tr>
										<th scope="col">mã phiếu lương</th>
										<th scope="col">mã nhân viên</th>
										<th scope="col">họ tên</th>
										<th scope="col">phòng</th>
										<th scope="col">chức vụ</th>
										<th scope="col">hệ số lương</th>
										<th scope="col">số ngày công</th>
										<th scope="col">số ngày vắng</th>
										<th scope="col">lương tăng ca</th>
										<th scope="col">tiền tạm ứng</th>
										<th scope="col">trợ cấp</th>
										<th scope="col">trừ bảo hiểm</th>
										<th scope="col">phạt</th>
										<th scope="col">thưởng</th>
										<th scope="col">tiền lương tháng</th>
										<th scope="col">tổng thu nhập</th>
										<th scope="col">thuế</th>
										<th scope="col">thực lĩnh</th>
										<th scope="col">ghi chú</th>
									</tr>
								</thead>

								<tbody>
									<?php
									//tổng số trang
									// $maxPage = floor($numRows / $rowsPerPage) + 1;

									while ($rows = mysqli_fetch_array($resultPhieuLuong)) {
									?>
										<tr>
											<td><?= $rows['MaPhieuLuong'] ?></td>
											<td><?= $rows['MaNV'] ?></td>
											<td><?= $rows['HoNV'] . " " . $rows['TenNV'] ?></td>
											<td><?= $rows['TenPhong'] ?></td>
											<td><?= $rows['TenChucVu'] ?></td>
											<td><?= $rows['HeSoLuong'] ?></td>
											<td><?= $rows['SoNgayCong'] ?></td>
											<td><?= $rows['SoNgayVang'] ?></td>
											<td><?= MoneyFormat($rows['LuongTangCa']) ?></td>
											<td><?= MoneyFormat($rows['TienTamUng']) ?></td>
											<td><?= MoneyFormat($rows['TroCap']) ?></td>
											<td><?= MoneyFormat($rows['TruBaoHiem']) ?></td>
											<td><?= MoneyFormat($rows['Thuong']) ?></td>
											<td><?= MoneyFormat($rows['Phat']) ?></td>
											<td><?= MoneyFormat($rows['TienLuongThang']) ?></td>
											<td><?= MoneyFormat($rows['TongThuNhap']) ?></td>
											<td><?= MoneyFormat($rows['Thue']) ?></td>
											<td><?= MoneyFormat($rows['ThucLinh']) ?></td>
											<td><?= $rows['GhiChu'] ?></td>
										</tr>
									<?php }
									?>
								</tbody>
							</table>
						</div>
					</div>
				<?php
				} else {
				?>
					<div class=" d-flex w-100 h-100 justify-content-center align-items-center">
						<div id="tb" class="d-flex w-100 h-100 justify-content-center align-items-center">
							<i class="bi bi-exclamation-triangle"></i>
							<b>Chưa có nhân viên nào được tính lương</b>
							<br>
							<b>Vui lòng tính lương cho nhân viên ở tháng <?php echo $thangChon . " năm " . $namChon ?>!</b>
						</div>
					</div>
				<?php
				}
			} else {
				?>
				<script>
					window.onload = function() {

						var chart1 = new CanvasJS.Chart("chartContainer1", {
							animationEnabled: true,
							title: {
								text: "PHÂN TÍCH MỨC LƯƠNG NHÂN VIÊN",
								fontFamily: "arial",
								fontWeight: "bold"
							},
							subtitles: [{
								text: "(Theo số nhân viên đã được tính lương ở tháng <?= $thangChon ?>)",
								fontFamily: "arial",
								//Uncomment properties below to see how they behave
								//fontColor: "red",
								//fontSize: 30
							}],
							axisX: {
								title: "Mức lương (Triệu đồng)",
								fontFamily: "arial"
								// includeZero: true,
							},
							axisY: {
								title: "Số lượng nhân viên",
								fontFamily: "arial",
								includeZero: true,
								interval: 1

							},
							data: [{
								type: "bar",
								yValueFormatString: "#0 NV",
								indexLabel: "{y}",
								indexLabelPlacement: "inside",
								indexLabelFontWeight: "bolder",
								indexLabelFontColor: "white",
								dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
							}]
						});
						chart1.render();

						var chart2 = new CanvasJS.Chart("chartContainer2", {
							animationEnabled: true,
							theme: "light2",
							title: {
								text: "THU THẬP BÌNH QUÂN THEO PHÒNG BAN",
								fontFamily: "arial",
								fontWeight: "bold"
							},
							subtitles: [{
								text: "(Theo số nhân viên đã được tính lương ở tháng <?= $thangChon ?>)",
								fontFamily: "arial",
							}],
							axisY: {
								title: "Mức lương (đồng)",
								fontFamily: "arial",

							},
							axisX: {
								title: "Phòng ban",
								fontFamily: "arial",

							},
							data: [{
								type: "column",
								yValueFormatString: "#,##0.## đồng",
								dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
							}]
						});
						chart2.render();

					}
				</script>
				<div style="padding-top:20px; padding-left: 10px; padding-right:10px;">
					<div style="margin-bottom:50px;">
						<div id="chartContainer1" style="height: 442px; width: 100%;"></div>
					</div>
					<div id="chartContainer2" style="height: 442px; width: 100%;"></div>
				</div>


				<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
		<?php
			}
		}
		?>
	</div>
</form>
<?php $this->end(); ?>