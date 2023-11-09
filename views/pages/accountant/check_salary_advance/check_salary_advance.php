<?php $this->layout('layout_accountant') ?>
<?php $this->section('content'); ?>
<?php
function money_format($tien)
{
	return number_format($tien, 0, ',', '.');
}
function Ngay_Format($date)
{
	$day = explode('-', $date);
	return $day[2] . '-' . $day[1] . '-' . $day[0];
}
?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$sqlUngLuong = 'select * from phieu_ung_luong';
$rowsPerPage = 7; //số mẩu tin trên mỗi trang, giả sử là 5
if (!isset($_GET['p'])) {
	$_GET['p'] = 1;
}
$sql = 'SELECT * FROM phieu_ung_luong  ';
$resultUngLuong = mysqli_query($conn, $sql);

$numRows = mysqli_num_rows($resultUngLuong);

$offset = ($_GET['p'] - 1) * $rowsPerPage;
$sql = 'SELECT * FROM phieu_ung_luong LIMIT ' . $offset . ', ' . $rowsPerPage;
$resultUngLuong = mysqli_query($conn, $sql);
?>

<div style="height:650px">
	<div class="card shadow border-0 mb-7 mt-5">
		<div class="card-header">
			<h5 class="mb-0">BẢNG ỨNG LƯƠNG</h5>
		</div>
		<table class="table table-hover table-nowrap">
			<thead class="thead-light">
				<tr>
					<th scope="col">mã phiếu</th>
					<th scope="col">mã nhân viên</th>
					<th scope="col">ngày ứng</th>
					<th scope="col">lý do</th>
					<th scope="col">số tiền</th>
					<th scope="col">xét duyệt</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (mysqli_num_rows($resultUngLuong) <> 0) {
					while ($rows = mysqli_fetch_array($resultUngLuong)) {
				?>
						<tr data-maphieu="<?= $rows['MaPhieu'] ?>">
							<td><?= $rows['MaPhieu'] ?></td>
							<td><?= $rows['MaNV'] ?></td>
							<td><?= Ngay_Format($rows['NgayUng']) ?></td>
							<td><?= $rows['LyDo'] ?></td>
							<td><?= money_format($rows['SoTien']) ?> đ</td>
							<td>
								<p class="duyet-p" style="color:<?= $rows['Duyet'] ? 'green' : 'red' ?>;">
									<?= $rows['Duyet'] ? 'Đã duyệt' : 'Chưa duyệt' ?>
								</p>
							</td>
							<?php if ($rows['Duyet']) : ?>
								<td align="center">
									<i style="font-size:35px !important;color:green;" class='bi bi-check-circle-fill'></i>
								</td>
							<?php else : ?>
								<td align="center">
									<button onclick='acceptPUL(this,"<?= $rows["MaPhieu"] ?>","<?= $rows["MaNV"] ?>")' class='btn btn-outline-purple'>Duyệt</button>
								</td>
							<?php endif; ?>
							<td class='text-end'>
								<button data-bs-toggle="modal" data-bs-target="#<?= $rows["MaPhieu"] ?>" style='background-color: red;' class='btn btn-sm btn-xoa btn-square btn-neutral2 text-danger-hover'>
									<i class='bi bi-trash' style='color:black'></i>
								</button>
								<!-- Modal xóa ứng lương-->
								<div class="modal fade" id="<?= $rows["MaPhieu"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title text-center" id="exampleModalLabel">Xóa phiếu ứng lương <?= $rows["MaPhieu"] ?></h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p style="text-align: left;">Bạn có chắc chắn muốn xóa phiếu ứng lương này không?</p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
												<button onclick='deletePUL(this,"<?= $rows["MaPhieu"] ?>","<?= $rows["MaNV"] ?>")' type="button" class="btn btn-danger">Xóa</button>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
				<?php
					}
				}
				?>

				<!-- Modal1 -->
				<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Xác nhận</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<h3>Bạn có chắc chắn muốn duyệt không</h3>
							</div>
							<div class="modal-footer">
								<button type="button" class="btnn " data-bs-dismiss="modal">Close</button>
								<button type="button" class="btnn duyet-yes-btn" data-bs-dismiss="modal">Yes</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal2 -->
				<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog test-modal">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Xác nhận</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<h3>Bạn có chắc chắn muốn xóa phiếu ứng lương này không</h3>
							</div>
							<div class="modal-footer">
								<button type="button" class="btnn " data-bs-dismiss="modal">Close</button>
								<button type="button" class="btnn xoa-yes-btn" data-bs-dismiss="modal">Yes</button>
							</div>
						</div>
					</div>
				</div>
			</tbody>
		</table>

	</div>

</div>
<div align="center">
	<?php
	// Tổng số trang
	$maxPage = ceil($numRows / $rowsPerPage);
	echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-advance&p=" . (1) . ">Đầu</a> ";
	// Gắn thêm nút Back
	echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-advance&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";

	for ($i = 1; $i <= $maxPage; $i++) {
		if ($i == $_GET['p']) {
			echo '<b><a class="pagination-link active" href=' . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-advance&p=" . $i . ">" . $i . "</a></b> "; // Trang hiện tại sẽ được bôi đậm
		} else {
			echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-advance&p=" . $i . ">" . $i . "</a> ";
		}
	}
	// Gắn thêm nút Next
	echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-advance&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a> ";
	// gắn nút về trang đầu
	echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-advance&p=" . ($maxPage) . ">Cuối</a> ";
	?>
</div>
<?php $this->end(); ?>