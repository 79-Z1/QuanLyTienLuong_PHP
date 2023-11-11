<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
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
				PHẠM NGỌC TUYỂN - 62132593
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
							<td>Chu vi diện tích hình vuông</td>
							<td><a href="?page=PNT-HV"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>
						<tr>
							<td>Đếm số tự nhiên</td>
							<td><a href="?page=PNT-DS"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>          
						<tr>
							<td>Số đảo</td>
							<td><a href="?page=PNT-SD"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>          
						<tr>
							<td>Form tính diện tích các hình học</td>
							<td><a href="?page=PNT-FHH"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>          
						<tr>
							<td>Form tính tiền điện</td>
							<td><a href="?page=PNT-TTD"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>          
						<tr>
							<td>Form tính số tự nhiên</td>
							<td><a href="?page=PNT-FSTN"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>          
						<tr>
							<td>Bảng cửu chương</td>
							<td><a href="?page=PNT-BCC"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>          
						<tr>
							<td>bài tập thực hành Nhân Viên</td>
							<td><a href="?page=PNT-NVTH"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>          
						<tr>
							<td>Thông tin sinh viên</td>
							<td><a href="?page=PNT-SV"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>          
						<tr>
							<td>Cộng trừ nhân chia</td>
							<td><a href="?page=PNT-2S"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>          
						 <tr>
							<td>Nối chuỗi</td>
							<td><a href="?page=PNT-NC"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>          
						 <tr>
							<td>Form hình học</td>
							<td><a href="?page=PNT-VDHH"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>           
						 <tr>
							<td>Quản lý nhân viên</td>
							<td><a href="?page=PNT-KTGK"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>  
                        <!-- Mảng     ---------------------------------    -->
						 <tr>
							<td>Kiểm tra mảng</td>
							<td><a href="?page=PNT-KTM"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>          
                        <tr>
							<td>Mảng bé xíu</td>
							<td><a href="?page=PNT-MS"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>  
                        <tr>
							<td>Mảng 2 chiều</td>
							<td><a href="?page=PNT-MHC"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>  

                        <!-- Quản lý bán sữa     ---------------------------------    -->
                        <tr>
							<td>Đăng nhập</td>
							<td><a href="?page=PNT-DNSua"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>  
                        <tr>
							<td>Thông tin khách hàng</td>
							<td><a href="?page=PNT-TTKH"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>  
                        <tr>
							<td>Thông tin sữa</td>
							<td><a href="?page=PNT-TTS"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>  
    
                        <tr>
							<td>Tìm kiếm khách hàng</td>
							<td><a href="?page=PNT-TKKH"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>  
                        <tr>
							<td>Tìm kiếm sữa</td>
							<td><a href="?page=PNT-TKS"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>  
                        <tr>
							<td>edit sữa</td>
							<td><a href="?page=PNT-editS"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>  
                        <tr>
							<td>xóa khách hàng</td>
							<td><a href="?page=PNT-deleteKH"><i class="bi bi-arrow-right-square-fill"></i></a></td>
						</tr>  

					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
</div>
	<?php $this->end(); ?>
