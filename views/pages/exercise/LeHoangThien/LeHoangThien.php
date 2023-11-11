<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>

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
				LÊ HOÀNG THIỆN - 62132006
			</h5>
		</div>
		<div>
			<form action="" method="post" enctype="multipart/form-data">
				<table class="table table-hover table-nowrap">
					<thead class="thead-light">
						<tr>
							<th scope="col">tên bài tập</th>
							<th scope="col">chạy file</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Form diện tích hình chữ nhật</td>
							<td><a href="index.php?page=LHT-form-DT_HCN"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
                        <tr>
							<td>Form Tính tiền điện</td>
							<td><a href="index.php?page=LHT-form-TinhTienDien"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
                        <tr>
							<td>Form phép tính</td>
							<td><a href="index.php?page=LHT-form-PhepTinh"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
                        <tr>
							<td>Form nhập thông tin</td>
							<td><a href="index.php?page=LHT-form-nhapThongTin"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
                        <tr>
							<td>Mảng Chuỗi: BT1</td>
							<td><a href="index.php?page=LHT-Mang-Chuoi-BT1"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
                        <tr>
							<td>Mảng Chuỗi: BT2</td>
							<td><a href="index.php?page=LHT-Mang-Chuoi-BT2"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
                        <tr>
							<td>Hướng đối tượg : BT1</td>
							<td><a href="index.php?page=LHT-HDT-BT1"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
                        <tr>
							<td>Hướng đối tượg : BT2</td>
							<td><a href="index.php?page=LHT-HDT-BT2"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
                        <tr>
							<td>CSDL MySQL : Phân nhánh</td>
							<td><a href="index.php?page=LHT-CSDL_MySQL-PhanTrang"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
                        <tr>
							<td>CSDL MySQL : BT2_7</td>
							<td><a href="index.php?page=LHT-CSDL_MySQL-BT2_7"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
                        <tr>
							<td>CSDL MySQL : BT2_11</td>
							<td><a href="index.php?page=LHT-CSDL_MySQL-BT2_11"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
<?php $this->end(); ?>
