<html lang='en'>
<style>
	.profile-left-container {
		margin-right: 30px;
	}

	ul li span {
		font-size: 30px !important;
	}

	img {
		width: 100%;
		height: 100%;
	}

	button,
	.btn {
		background-color: #007bff;
		color: #fff;
		padding: 10px 20px;
		border: none;
		cursor: pointer;
	}

	.modal button {
		background-color: #007bff;
		color: #fff;
		padding: 10px 20px;
		border: none;
		cursor: pointer;
	}

	.modal button:hover {
		background-color: #0056b3;
	}

	.card {
		height: 615px;

	}
	h6{
		font-size: 23px!important;
	}
	.hr{
		border: 1px solid!important;
		width: 100%;
		opacity: 0.25;
		margin: 15px 2px;
	}
</style>

<head>
	<meta charset='UTF-8' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge' />
	<meta name='viewport' content='width=device-width, initial-scale=1.0' />
	<title>Chi Tiết Nhân Viên</title>
	<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css' rel='stylesheet' />
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css' />
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css' />
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css' />

	<link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css' />
	<link rel='stylesheet' href='/css/app.css' />
	<link rel='stylesheet' href='/css/{{style}}' />
	<script src='https://unpkg.com/axios/dist/axios.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js'></script>
	<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js'></script>
	<script defer src='/scripts/script.js'></script>
</head>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
$maNV = "NV001";
$sqlNhanVien = "select * from nhan_vien, phong_ban,chuc_vu
	where nhan_vien.MaChucVu = chuc_vu.MaChucVu and nhan_vien.MaPhong= phong_ban.MaPhong AND nhan_vien.MaNV='$maNV'	 ";
$resultNhanVien = mysqli_query($conn, $sqlNhanVien);
$ttNV = mysqli_fetch_array($resultNhanVien);

if ($ttNV['GioiTinh'] == 0) $gt = "Nữ";
else $gt = "Nam";
?>

<body>
	<div class="container">
		<div class="main-body">
			<nav aria-label="breadcrumb" class="main-breadcrumb p-2">
				<div class='option-buttons d-flex justify-content-end'>
					<button type='button' class="btn btn-info " id='exit'>QUAY LẠI</button>
				</div>
			</nav>

			<div class="row gutters-sm">
				<div class="col-md-4 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center ">
								<img <?php echo "src='" .  '/' . explode('/', $_SERVER["PHP_SELF"])[1] . "/assets/images/imgnv/$ttNV[Hinh]" . "' alt='Avatar' " ?> class="rounded-circle" width="150">
								<div class="mt-3 p-2">
									<h1><?php echo "$ttNV[HoNV]     $ttNV[TenNV]"  ?></h1>
									<h3 class="text-secondary mb-1"><?php echo "$ttNV[TenChucVu]" ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card mb-3">
						<div class="card-body">
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Mã nhân viên</h6>
								</div>
								<div class="col-sm-9 text-secondary " style="font-size: 18px;">
									<?php echo "$ttNV[MaNV]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Phòng</h6>
								</div>
								<div class="col-sm-9 text-secondary " style="font-size: 18px;">
									<?php echo "$ttNV[TenPhong]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Giới Tính</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
								
									<?php echo "$gt " ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Ngày Sinh</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[NgaySinh]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Địa Chỉ</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[DiaChi]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Số Tài Khoản</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[STK]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">CMND</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[CCCD]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Số điện thoại</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[SDT]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Số con</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[SoCon]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Hệ số lương</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[HeSoLuong]" ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	</div>
</body>

</html>

<script>
	$('#exit').on('click', function() {
		instance.deleteAllCookie();
		window.location.replace('/auth/login')
	})

	$('.ungluong-xacnhan').on('click', async function() {
		if (Number($('.ungluong-sotien').val()) > 5000000) {
			alert('Số tiền phải nhỏ hơn 5.000.000 VNĐ');
			return;
		}
		await UngLuong();
		alert('thành công!!!');
	})

	$('.khieunai-xacnhan').on('click', async function() {
		await KhieuNai();
		alert('thành công!!!');
	});

	async function UngLuong() {
		const payload = {
			manv: await instance.getCookie('tai khoan'),
			lydo: $('.ungluong-lydo').val(),
			sotien: $('.ungluong-sotien').val()
		}
		return (await instance.post('/ung-luong', payload)).data;
	}

	async function KhieuNai() {
		const payload = {
			manv: await instance.getCookie('tai khoan'),
			lydo: $('.khieunai-lydo').val(),
		}
		return (await instance.post('/khieu-nai', payload)).data
	}
</script>