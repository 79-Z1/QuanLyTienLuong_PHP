<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>
	<link rel="stylesheet" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1]. "/views/pages/auth/login.css" ?>" type="text/css">
</head>

<?php $this->renderSection('header'); ?>
<body>
<div class='wrapper container'>
	<div class='banner'>
		<img src='assets/images/login-banner1.jpg' alt='' />
	</div>
	<form id='upload-form'>
		<h1>LOGIN</h1>
		<div class='mb-3 w-100'>
			<label for='username' class='form-label '>Username</label>
			<input type='text' class='form-control username' id='username' />
		</div>
		<div class= 'w-100'>
			<label for='password' class='form-labe'>Password</label>
			<input type='password' class="mb-3 w-100 form-control password" id='password'/>
		</div>
		<div class= 'w-100'>
			<a href="">Quên mật khẩu?</a>
		</div>
		<button type='submit' class='btn btn-primary w-100' id='submit-btn'>
			Login
		</button>
	</form>
</div>
</body>
</html>

