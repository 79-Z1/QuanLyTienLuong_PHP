<?php $this->layout('layout_employee') ?>
<?php $this->section('content'); ?>
    <div class="tabs">
        <input class="input" name="tabs" type="radio" value="tab-1" id="tab-1" checked />
        <label class="label" for="tab-1">Thông Tin</label>
        <div class="panel">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/employee/info/info.php");  ?>
        </div>
        <input class="input" name="tabs" type="radio" value="tab-2" id="tab-2"  />
        <label class="label" for="tab-2">Bảng Lương</label>
        <div class="panel">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/employee/check_payroll/check_payroll.php");  ?>
        </div>
        <input class="input" name="tabs" type="radio" value="tab-3" id="tab-3"/>
        <label class="label" for="tab-3">Bảng Chấm Công</label>
        <div class="panel">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/employee/check_timesheets/check_timesheets.php");  ?>
        </div>
        <input class="input" name="tabs" type="radio" value="tab-4" id="tab-4"/>
        <label class="label" for="tab-4">Ứng Lương</label>
        <div class="panel">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/employee/salary_advance/salary_advance.php");  ?>
        </div>
    </div>
<?php $this->end(); ?>