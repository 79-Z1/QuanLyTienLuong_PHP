<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$rowsPerPage = 8; //số mẩu tin trên mỗi trang

if (!isset($_GET['p'])) {
	$_GET['p'] = 1;
}
function CheckTinhTrang($maNV, $thang, $nam, $conn)
{
	$sql = "select MaPhieuLuong from phieu_luong where MaNV = '$maNV' and Thang = $thang and Nam = $nam";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) return true;
	return false;
}
$offset = ($_GET['p'] - 1) * $rowsPerPage;

$sqlTimKiem =
	"select *, TenPhong, TenChucVu from nhan_vien, chuc_vu, phong_ban 
	where nhan_vien.MaPhong = phong_ban.MaPhong 
	and nhan_vien.MaChucVu = chuc_vu.MaChucVu order by MaNV
	";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);
$numRows = mysqli_num_rows($resultTimKiem);
$sqlTimKiem .= " limit $offset, $rowsPerPage";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);
?>
<style>
	tbody td {
		font-size: 16px !important;
	}

	#tren {
		height: 662px;
	}
</style>
<div id='tren'>
	<div class="card shadow border-0 mt-7 mb-7">
		<div class="card-header d-flex justify-content-between">
			<h5 class="mb-0">BÀI TẬP CÁ NHÂN</h5>
			<h5>
				TRẦN NGỌC TIẾN - 62132217
			</h5>
		</div>
		<div>
			<form action="" method="post" enctype="multipart/form-data">
				<table class="table table-hover table-nowrap">
					<thead class="thead-light">
						<tr>
							<th style="text-align: center;" colspan="2" scope="col">Bài tập về form</th>
						</tr>
						<tr>
							<th scope="col">tên bài tập</th>
							<th scope="col">chạy file</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Chu vi diện tích hình chữ nhật</td>
							<td><a href="?page=TNT-form-dt_cv_hcn"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Chu vi - Diện tích các hình học cơ bản</td>
							<td><a href="?page=TNT-form-dt_cv"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Tính tiền điện</td>
							<td><a href="?page=TNT-form-tien-dien"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Các phép tính</td>
							<td><a href="?page=TNT-form-phep-tinh"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Nhập thông tin</td>
							<td><a href="?page=TNT-form-nhapTT"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
					</tbody>
					<thead class="thead-light">
						<tr>
							<th style="text-align: center;" colspan="2" scope="col">Bài tập về Mảng</th>
						</tr>
						<tr>
							<th scope="col">tên bài tập</th>
							<th scope="col">chạy file</th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td>Bài tập 1</td>
							<td><a href="?page=TNT-Mang-1"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài tập 2</td>
							<td><a href="?page=TNT-Mang-2"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài tập 3</td>
							<td><a href="?page=TNT-Mang-3"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài tập 4</td>
							<td><a href="?page=TNT-Mang-4"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài tập 5</td>
							<td><a href="?page=TNT-Mang-5"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài tập 6</td>
							<td><a href="?page=TNT-Mang-6"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài tập 7</td>
							<td><a href="?page=TNT-Mang-7"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài tập 8</td>
							<td><a href="?page=TNT-Mang-8"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài tập 9</td>
							<td><a href="?page=TNT-Mang-9"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài tập 10</td>
							<td><a href="?page=TNT-Mang-10"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài tập mảng 2 chiều</td>
							<td><a href="?page=TNT-Mang-2-Chieu"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài kiểm tra mảng - Trần Ngọc Tiến</td>
							<td><a href="?page=TNT-Mang-KT"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
					</tbody>
					<thead class="thead-light">
						<tr>
							<th style="text-align: center;" colspan="2" scope="col">Bài tập về hướng đối tượng</th>
						</tr>
						<tr>
							<th scope="col">tên bài tập</th>
							<th scope="col">chạy file</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Bài tập 1</td>
							<td><a href="?page=TNT-Object-1"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài tập 2</td>
							<td><a href="?page=TNT-Object-2"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài tập 3</td>
							<td><a href="?page=TNT-Object-3"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Các đối tượng hình học</td>
							<td><a href="?page=TNT-Object-VD"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Bài kiểm tra hướng đối tượng - Trần Ngọc Tiến</td>
							<td><a href="?page=TNT-Object-KT"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
					</tbody>
					<thead class="thead-light">
						<tr>
							<th style="text-align: center;" colspan="2" scope="col">Bài tập quản lý bán sữa</th>
						</tr>
						<tr>
							<th scope="col">tên bài tập</th>
							<th scope="col">chạy file</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Danh sách sữa</td>
							<td><a href="?page=TNT-QLBS-List-Sua"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Tìm kiếm sữa</td>
							<td><a href="?page=TNT-QLBS-Find-Sua"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Danh sách khách hàng</td>
							<td><a href="?page=TNT-QLBS-List-KH"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Tìm kiếm khách hàng</td>
							<td><a href="?page=TNT-QLBS-Find-KH"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Danh sách sửa - Chi tiết sữa</td>
							<td><a href="?page=TNT-QLBS-Anh-Sua"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Thêm sữa</td>
							<td><a href="?page=TNT-QLBS-Add-Sua"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Đăng nhập</td>
							<td><a href="?page=TNT-QLBS-Login"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Đăng kí</td>
							<td><a href="?page=TNT-QLBS-Register"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
<?php $this->end(); ?>