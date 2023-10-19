<html>
<?php $this->renderSection('header_employee'); ?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div>
        <!-- BEGIN USER PROFILE -->
        <div class="col-md-12">
            <div class="grid profile">
                <div class="grid-header">
                    <div class="d-flex">
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-circle" alt="">
                        <div>
                            <h1>PHÒNG KHÁM ĐA KHOA THIỆN TRANG</h1>
                            <h2>TRẦN NGỌC TIẾN</h2>
                        </div>
                    </div>
                </div>
                <div class="grid-body">
                    <?php $this->renderSection('content'); ?>
                </div>
            </div>
        </div>
        <!-- END USER PROFILE -->
</body>

</html>