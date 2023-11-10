<?php if (strpos($_SERVER['REQUEST_URI'], "accountant") !== false) : ?>
    <?php $this->layout('layout_accountant') ?>
    <?php $this->section('content'); ?>
    <link rel="stylesheet" href=<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/css/shared/notification.css" ?> type="text/css" />
    <script defer src="/<?php echo explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/js/shared/notification.js" ?>"></script>
    <div class="card shadow border-0 mt-7 mb-7">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mx-5 text-center">THÔNG BÁO</h3>
            <button class="btn btn-danger mx-5" id="dismiss-all">Xóa tất cả</button>
        </div>
        <div class="row notification-container">
            <div id="thongbao-container" class="mt-3 py-3 d-flex flex-column align-items-center"></div>
        </div>
    </div>
    <?php $this->end(); ?>
<?php elseif (strpos($_SERVER['REQUEST_URI'], "employee") !== false) : ?>
    <div class="row notification-container">
        <div class="d-flex justify-content-end" style="height: fit-content;">
            <button class="btn btn-danger me-3" id="dismiss-all">Xóa tất cả</button>
        </div>
        <div id="thongbao-container" class="mt-3 py-3 d-flex flex-column align-items-center" style="height: 345px; overflow-y: scroll;">
        </div>
    </div>
<?php endif ?>