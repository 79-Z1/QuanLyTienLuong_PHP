<?php $this->layout('layout_accountant') ?>
<?php $this->section('content'); ?>
<link rel="stylesheet" href=<?php echo "/". explode('/', $_SERVER['PHP_SELF'])[1] ."/assets/css/shared/notification.css"?> type="text/css" />
<script defer src="/<?php echo explode('/', $_SERVER['PHP_SELF'])[1]. "/assets/js/shared/notification.js"?>"></script>
<div class="row notification-container">
    <h2 class="text-center">Thông báo</h2>
    <div class="w-100" align="right"><button class="btn btn-primary" id="dismiss-all">Xóa tất cả</button></div>
    <div id="thongbao-container" class="mt-3">
    </div>
</div>
<?php $this->end(); ?>