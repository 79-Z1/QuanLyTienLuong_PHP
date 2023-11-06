<?php $this->section('header_employee'); ?>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="Quản lý tiền lương..." />
    <meta name="description" content="Web app quản lý tiền lương phòng khám đa khoa thiện trang..." />
    <title>PayrollSystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/assets/css/main_employee.css"?> type="text/css" />
    <link rel="stylesheet" href="<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1]. "/views/assets/css/employee/{$css}" ?>" type="text/css">
    <link rel="stylesheet" href=<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/css/shared/notification.css" ?> type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script defer src="/<?php echo explode('/', $_SERVER['PHP_SELF'])[1]. "/assets/js/main.js"?>"></script>
    <script defer src="/<?php echo explode('/', $_SERVER['PHP_SELF'])[1]. "/assets/js/socket.js"?>"></script>
    <script defer src="/<?php echo explode('/', $_SERVER['PHP_SELF'])[1]. "/assets/js/employee/{$js}"?>"></script>
    <script defer src="/<?php echo explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/js/shared/notification.js" ?>"></script>
</head>
<?php $this->end(); ?>