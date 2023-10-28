<?php $this->layout('layout_accountant') ?>
<?php $this->section('content'); ?>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'quan_ly_tien_luong')

	or die('Could not connect to MySQL: ' . mysqli_connect_error());

$sqlUngLuong = 'select * from phieu_ung_luong';
$rowsPerPage = 6; //số mẩu tin trên mỗi trang, giả sử là 5
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

<div style="height:620px">
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
				<tr>
					<?php
					if (mysqli_num_rows($resultUngLuong) <> 0) {

						while ($rows = mysqli_fetch_array($resultUngLuong)) {
							echo "<tr>
							<td>{$rows['MaPhieu']}</td>
							<td>{$rows['MaNV']}</td>
							<td>{$rows['NgayUng']}</td>
							<td>{$rows['LyDo']}</td>
							<td>{$rows['SoTien']}</td>
							<td>{$rows['Duyet']}</td>
							<td><button class='btn btn-outline-purple ' data-bs-toggle='modal' data-ma-phieu='{{this.MaPhieu}}' data-bs-target='#staticBackdrop' >Duyệt</button></td>
							<td class='text-end'>
								<button style='background-color: red;' type='button' class='btn btn-sm btn-xoa btn-square btn-neutral2 text-danger-hover' data-ma-phieu='{{this.MaPhieu}}' data-bs-toggle='modal' data-bs-target='#staticBackdrop1'>
									<i class='bi bi-trash' style='color:black'></i>
								</button>
							</td>
							</tr>";
						}
					}
					?>
				</tr>

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
	$maxPage = floor($numRows / $rowsPerPage) + 1;
	echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-advance&p=" . (1) . ">Đầu trang</a> ";
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
	echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-advance&p=" . ($maxPage) . ">Cuối trang</a> ";
	// gắn nút về trang đầu
	?>
</div>

<script>
	let maPhieu = '';

	$('.js-btn-duyet').on('click', async function() {
		maPhieu = $(this).data("ma-phieu");
	})

	$('.duyet-yes-btn').on('click', async function(e) {
		await checkUngLuong(maPhieu, 1);
		window.location.reload();
	})


	$('.btn-xoa').on('click', async function() {
		maPhieu = $(this).data("ma-phieu");
		console.log(maPhieu)
	})

	$('.xoa-yes-btn').on('click', async function() {
		await checkUngLuong(maPhieu, 0);
		window.location.reload();
	})


	async function checkUngLuong(maphieu, isduyet) {
		const payload = {
			maphieu: maphieu,
			duyet: isduyet
		}
		return (await instance.put('/admin/ung-luong/check', payload)).data
	}
</script>
<?php $this->end(); ?>