<?php $this->layout('layout_accountant') ?>
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
			<h5 class="mb-0">TÍNH LƯƠNG NHÂN VIÊN</h5>
			<h5>
				<?php
				if (date('m') > 1) {
					$thang = date('m') - 1;
					$nam = date('Y');
				} else {
					$thang = 12;
					$nam = date('Y') - 1;
				}
				echo "Tháng $thang năm $nam";
				?>
			</h5>
		</div>
		<div>
			<form action="" method="post" enctype="multipart/form-data">
				<table class="table table-hover table-nowrap">
					<thead class="thead-light">
						<tr>
							<th scope="col">mã nhân viên</th>
							<th scope="col">họ tên</th>
							<th scope="col">chức vụ</th>
							<th scope="col">phòng</th>
							<th scope="col">tình trạng</th>
							<th scope="col">tính lương</th>
						</tr>
					</thead>

					<tbody>
						<?php
						//tổng số trang
						$maxPage = ceil($numRows / $rowsPerPage);
						if (mysqli_num_rows($resultTimKiem) <> 0) {
							while ($rows = mysqli_fetch_array($resultTimKiem)) {
								echo "<tr>
                        <td>{$rows['MaNV']}</td>
                        <td>{$rows['HoNV']} {$rows['TenNV']}</td>
                        <td>{$rows['TenChucVu']}</td>
                        <td>{$rows['TenPhong']}</td>";
								if (CheckTinhTrang($rows['MaNV'], $thang, $nam, $conn)) {
									echo "
								<td style='color:green'> Đã Tính </td>
								<td ' style='color:green; font-size:35px !important; padding-left:50px'>
									<i class='bi bi-check-circle-fill'></i>
								</td>
							";
								} else {
									echo "
							<td style='color:red'> Chưa tính </td>
							<td>
								<a class='btn btn-outline-purple p-2' href ='index.php?page=payroll-info&MaNV=$rows[MaNV]&thang=$thang&nam=$nam&p=$_GET[p]'>Tính lương</a>
							</td>
							";
								}
								echo "</tr>";
							}
						}
						?>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
<div align="center">
	<?php
	$maxPage = ceil($numRows / $rowsPerPage);
	echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-payroll&p=" . (1) . "> Đầu </a> ";
	echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-payroll&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "> < </a> ";


	for ($i = 1; $i <= $maxPage; $i++) {
		if ($i == $_GET['p']) {
			echo '<b><a class="pagination-link active" href=' . $_SERVER['PHP_SELF'] . "?page=accountant-payroll&p=" . $i . ">" . $i . "</a></b> "; // Trang hiện tại sẽ được bôi đậm
		} else {
			echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-payroll&p=" . $i . ">" . $i . "</a> ";
		}
	}

	echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-payroll&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . "> > </a>";
	echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-payroll&p=" . ($maxPage) . "> Cuối </a> ";

	echo "</p>";
	?>
</div>

<?php $this->end(); ?>