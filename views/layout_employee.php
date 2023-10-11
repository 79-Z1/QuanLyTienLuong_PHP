<html>
<?php $this->renderSection('header'); ?>

<body>
    <section class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div class="card card-style1 border-0 p-5">
                        <?php $this->renderSection('content'); ?>
                        <div class="option-buttons d-flex ">
                            <button type="button" class="btnn " data-bs-toggle="modal" data-bs-target="#staticBackdrop">ỨNG LƯƠNG</button>
                            <button type="button" class="btnn " data-bs-toggle="modal" data-bs-target="#staticBackdrop1">KHIẾU NẠI</button>
                            <button type="button" class="btnn chamcong-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">XEM BẢNG CHẤM CÔNG</button>
                            <button type="button" class="btnn ms-auto" id="exit">ĐĂNG XUẤT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>