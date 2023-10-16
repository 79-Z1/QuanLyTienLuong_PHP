<?php $this->layout('layout') ?>
<?php $this->section('content'); ?>
    <!-- Card stats -->
<div class="g-6 mb-6 w-100 search-container mt-5">
	<div class="col-xl-12 col-sm-12 col-12">
		<div class="card shadow border-0 d-flex">
			<nav class="navbar navbar-light bg-light">
				<div class="container-fluid">
					<form class="d-flex" action="/admin/search">
						<input class="form-control me-2 search-input" type="search" name="search" id="search-input" placeholder="Search">
						<select class="form-select search-option" id="inputGroupSelect02">
							<option value="1">Tên nhân viên</option>
							<option value="2">Mã nhân viên</option>
							<option value="3">Chức vụ</option>
						</select>
						<button class="btn btn-outline-success search-btn" type="submit">Search</button>
					</form>
				</div>
			</nav>
		</div>
	</div>

</div>
<div class="card shadow border-0 mb-7">
	<div class="card-header">
		<h5 class="mb-0">THÔNG TIN NHÂN VIÊN</h5>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-nowrap">
			<thead class="thead-light">
				<tr>
					<th scope="col">mã nhân viên</th>
					<th scope="col">họ tên</th>
					<th scope="col">chức vụ</th>
					<th scope="col">phòng</th>
					<th scope="col">giới tính</th>
					<th scope="col">số diện thoại</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>123456</td>
					<td>Nguyễn Duy Thiên</td>
					<td>Chủ tịch</td>
					<td>Chủ tịch</td>
					<td>Nam</td>
					<td>0906420744</td>
					
					<td class="text-end">
						<a href="#" class="btn btn-sm btn-neutral">View</a>
						<button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
							<i class="bi bi-trash"></i>
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<script>
	$('input[type=search]').on('search', function () {
    	window.location.replace("/admin/ketoan");
	});
</script>
<?php $this->end(); ?>