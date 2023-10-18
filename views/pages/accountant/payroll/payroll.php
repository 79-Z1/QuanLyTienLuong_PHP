<?php $this->layout('layout_accountant') ?>
<?php $this->section('content'); ?>
    <!-- Card stats -->
<div class="g-6 mb-6 w-100 search-container mt-5">
	<div class="col-xl-12 col-sm-12 col-12">
		<div class="card shadow border-0 d-flex">
			<nav class="navbar navbar-light bg-light">
				<div class="container-fluid">
					<div class="d-flex">
						<input 
							class="form-control me-2 search-input" 
							value=""
							type="text" 
							id="ma-input" 
							placeholder="Nhập Mã..."
						>						
						<input class="cal" type="date" id="calendar" name="calendar" min="2022-12-01">
						<select class="form-select search-option tinhluong-option" id="inputGroupSelect02">
							<option value="" selected>--Chọn kiểu tính--</option>
							<option value="nhanvien">Nhân viên</option>
							<option value="phong">Phòng</option>
							<option value="congty">Công ty</option>
						</select>
						<button class="btn  search-btn tinhluong-btn" type="submit" disabled>
							Tính lương
						</button>
					</div>
				</div>
			</nav>
		</div>
	</div>
</div>
<div class="card shadow border-0 mb-7">
	<div class="card-header">
		<h5 class="mb-0">BẢNG TÍNH LƯƠNG NHÂN VIÊN</h5>
		<input type="month" id="start" name="start" min="2018-03" value="2022-12">
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-nowrap">
			<thead class="thead-light">
				<tr>
					<th scope="col">mã nhân viên</th>
					<th scope="col">họ tên</th>
					<th scope="col">chức vụ</th>
					<th scope="col">phòng</th>
					<th scope="col">hệ số lương</th>
					<th scope="col">ngày công</th>
					<th scope="col">tăng ca</th>
					<th scope="col">tiền tạm ứng</th>
					<th scope="col">bảo hiểm</th>
					<th scope="col">thuế</th>
					<th scope="col">thực lĩnh</th>
				</tr>
			</thead>
			<tbody>
				<tr>
                    <td>{{#toUpperCase this.MaNV}}{{/toUpperCase}}</td>
                    <td>{{this.HoTen}}</td>
                    <td>{{this.TenChucVu}}</td>	
					<td>{{this.TenPhong}}</td>				
                    <td>{{this.HeSoLuong}}</td>					
                    <td>{{this.SoNgayCong}}</td>
                    <td>{{#toVND this.TangCa}}{{/toVND}}</td>
					<td>{{#toVND this.TamUng}}{{/toVND}}</td>
					<td>{{#toVND this.BaoHiem}}{{/toVND}}</td>
					<td>{{#toVND this.Thue}}{{/toVND}}</td>
					<td>{{#toVND this.ThucLinh}}{{/toVND}}</td>
                </tr>
					<tr>						
						<td style="padding-left: 520px; font-size: 20px; " colspan="11" >Bảng tính lương đang rỗng</td>
					</tr>
			</tbody>
		</table>
	
	</div>
</div>

<script>
	$('.search-btn').on('click',async function(e) {
		searchValue = $('#search-input').val();		
	})

	$('input[type=search]').on('search', function () {
    	window.location.replace("/admin/tinhluong");
	});

	async function search(value) {
		await instance.get('/admin/search', {
			params: {
				searchValue: value
			}
		});
	}

	const today = new Date().toLocaleDateString('en-CA');//en-US
	$('#calendar').val(today);

	$('#calendar').on('change', function() {
		$(this).val()
	})

	$('.tinhluong-option').on('change', function() {
		$('.tinhluong-btn').removeAttr('disabled');
	})

	$('.tinhluong-btn').on('click',async function() {
		await instance.get('/admin/thuc-hien-tinh-luong', {
			params: {
				type: $('.tinhluong-option').val(),
				ma: $('#ma-input').val()
			}
		});
		window.location.replace(`/admin/thuc-hien-tinh-luong?type=${$('.tinhluong-option').val()}&&ma=${$('#ma-input').val()}`);
	})
	
	
</script>
<?php $this->end(); ?>