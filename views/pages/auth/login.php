<html>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<link rel="stylesheet" href="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/css/auth/login.css" ?>" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>
<?php
require('./connect.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1]."/services/jwt.php"); 
include_once($_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1]."/config/const.php"); 

$tentk = isset($_POST['tentk']) ? $_POST['tentk'] : '';
$matkhau = isset($_POST['matkhau']) ? $_POST['matkhau'] : '';
if (isset($_POST['submit'])) {
	if (isset($_POST['tentk'], $_POST['matkhau'])) {
		$sql = "select * from tai_khoan where TenTK = '$tentk' and MatKhau = '$matkhau'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) <> 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				session_start();
				$payload = [
					'MaNV' => $row['MaNV'],
					'LoaiTK' =>  $row['LoaiTK'],
					'iss' => 'http://localhost/QuanLyTienLuong_PHP',
					'aud' => 'dakhoathientrang.com'
				];
				$jwt = new JWT();
				$token = $jwt->generate($payload);
				$_SESSION["MaNV"] = $row['MaNV'];
				$_SESSION["LoaiTK"] = $row['LoaiTK'];
				setcookie("MaNV", $row['MaNV']);
				setcookie("LoaiTK", $row['LoaiTK']);
				$_SESSION["Authorization"] = $token;
				switch ($_SESSION["LoaiTK"]) {
					case 'KT':
						header('Location: ' . "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/accountant");
						break;
					case 'QL':
						header('Location: ' . "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/human_manager");
						break;
					default:
						header('Location: ' . "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/employee");
						break;
				}
			}
		} else {
			echo "<script type='text/javascript'>toastr.error('Sai tên tài khoản hoặc mật khẩu')</script>";
		}
	} else echo "<script type='text/javascript'>toastr.error('Không được để trống thông tin đăng nhập')</script>";
}
?>

<body>
	<div class='wrapper container'>
		<div class='banner'>
			<img src='assets/images/login-banner1.jpg' alt='' />
		</div>
		<form id='upload-form' method="post">
			<h1>LOGIN</h1>
			<div class='mb-3 w-100'>
				<label for='tentk' class='form-label '>Tên tài khoản</label>
				<input name="tentk" class='form-control' id='tentk' value="<?= $tentk ?>" />
			</div>
			<div class='w-100'>
				<label for='matkhau' class='form-labe'>Mật khẩu</label>
				<input name='matkhau' type="password" class="mb-3 w-100 form-control" id='matkhau' value="<?= $matkhau ?>" />
			</div>
			<div class='w-100'>
				<a href="/<?= explode('/', $_SERVER['PHP_SELF'])[1]."/views/pages/auth/enter_email.php"?>">Quên mật khẩu?</a>
			</div>
			<button name="submit" type='submit' class='btn btn-primary w-100' id='submit-btn'>
				Login
			</button>
		</form>
	</div>
</body>

</html>