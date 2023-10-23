<html lang='en'>
<style>
    .profile-left-container{
        margin-right:30px;
    }
    ul li span {
        font-size: 30px !important;
    }
    img{
        width: 100%;
        height: 500px;
    }
    button, .btn {
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
?>
<body >
	<section class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 mb-4 mb-sm-5">
					<div class="card card-style1 border-0">
						<div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
							<div class="row align-items-center">
								<div class="info-wrapper d-flex align-items-center">
									<div class="col-lg-4 mb-4 mb-lg-0 profile-left-container">
										<?php 
										echo "
										<div
											class='bg-dark d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded w-100'>
											<h3 class='h2 text-white mb-0'> $ttNV[HoNV]   $ttNV[TenNV]</h3>
											<h5 class='text-primary'>$ttNV[TenChucVu]</h5>
											
                                        <div >   
                                        <img src='" .  '/' . explode('/', $_SERVER["PHP_SELF"])[1] . "/assets/images/imgnv/$ttNV[Hinh]" . "' alt='Avatar'>
                                        </div>
									</div>

									<div class='col-lg-8 px-xl-10 profile-right-container; '>
									<ul class='list-unstyled'>
										<li class='mb-2 mb-xl-3 '>
											<span class=' me-2 font-weight-600'>
												<b>Mã nhân viên:</b> $ttNV[MaNV]</span>
											
										</li>
										<li class='mb-2 mb-xl-3 '>
												<span class=' me-2 font-weight-600'>
                                                <b>Phòng:</b> $ttNV[TenPhong]</span>
                                                    
											</li>
											<li class='mb-2 mb-xl-3 '>
												<span class=' me-2 font-weight-600'>
													<b>Giới tính:</b> $ttNV[GioiTinh]</span> 
                                         	</li>
											<li class='mb-2 mb-xl-3 '>
												<span class=' me-2 font-weight-600'>
													<b>Ngày sinh:</b> $ttNV[NgaySinh]</span>
                                                    
											</li>
											<li class='mb-2 mb-xl-3 '>
												<span class=' me-2 font-weight-600'>
													<b>Địa chỉ:</b> $ttNV[DiaChi]</span> 
                                                    
											</li>
											<li class='mb-2 mb-xl-3 '>
												<span class=' me-2 font-weight-600'>
													<b>Số tài khoản:</b> $ttNV[STK]</span> 
                                                    
											</li>
											<li class='mb-2 mb-xl-3 '>
												<span class=' me-2 font-weight-600'>
													<b>CMND:</b> $ttNV[CCCD]</span>
                                                    
											</li>
											<li class='mb-2 mb-xl-3 '>
												<span class=' me-2 font-weight-600'>
													<b>Số điện thoại:</b> $ttNV[SDT]</span> 
											</li>
										</ul>
									</div>
									</div>
									<div class='option-buttons d-flex '>			
									<button type='button' class='btnn ms-auto' id='exit'>QUAY LẠI</button>
								</div>
										";
										?>
											
								</div>
                               
							</div>
						</div>
					</div>
				</div>
			</div>
</body>

</html>

<script>
	$('#exit').on('click', function () {
		instance.deleteAllCookie();
		window.location.replace('/auth/login')
	})

	$('.ungluong-xacnhan').on('click', async function () {
		if(Number($('.ungluong-sotien').val()) > 5000000) {
			alert('Số tiền phải nhỏ hơn 5.000.000 VNĐ');
			return;
		}
		await UngLuong();
		alert('thành công!!!');
	})

	$('.khieunai-xacnhan').on('click', async function () {
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