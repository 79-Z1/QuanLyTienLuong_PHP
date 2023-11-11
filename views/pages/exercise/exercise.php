<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php echo 'Current PHP version: ' . phpversion();?>
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="card p-0">
                <div class="card-image">
                    <img src="<?="/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/TranNgocTien.jpg"?>" alt='Avatar'>
                </div>
                <div class="card-content d-flex flex-column align-items-center">
                    <h4 class="pt-2">Trần Ngọc Tiến</h4>
                    <h5>NHÓM TRƯỞNG</h5>
                    <span class="maxim">❝ Ngôn ngữ là nhất thời, <br>thuật toán là mãi mãi ❞</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-0">
                <div class="card-image">
                    <img src="<?="/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/TruongKhanhHoa.jpg"?>" alt='Avatar'>
                </div>
                <div class="card-content d-flex flex-column align-items-center">
                    <h4 class="pt-2">Trương Khánh Hòa</h4>
                    <h5>NHÓM PHÓ</h5>
                    <span class="maxim">
                        ❝ Lập trình tại nhân, 
                        <br>Thực được tại thiên ❞</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-0">
                <div class="card-image">
                    <img src="<?="/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/NguyenDuyThien.png"?>" alt='Avatar'>
                </div>
                <div class="card-content d-flex flex-column align-items-center">
                    <h4 class="pt-2">Nguyễn Duy Thiên</h4>
                    <h5>NHÓM VIÊN</h5>
                    <span class="maxim">
                        ❝Đó không phải là lỗi,
                        <br>Đó là tính năng❞
                                </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 second-info">
        <div class="col-lg-4">
            <div class="card p-0">
                <div class="card-image">
                    <img src="<?="/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/LeHoangThien.jpg"?>" alt='Avatar'>
                </div>
                <div class="card-content d-flex flex-column align-items-center">
                    <h4 class="pt-2">Lê Hoàng Thiện</h4>
                    <h5>NHÓM VIÊN</h5>
                    <span class="maxim">❝ Ngôn ngữ là nhất thời, <br>thuật toán là mãi mãi ❞</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-0">
                <div class="card-image">
                    <img src="<?="/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/PhamNgocTuyen.jpg"?>" alt='Avatar'>
                </div>
                <div class="card-content d-flex flex-column align-items-center">
                    <h4 class="pt-2">Phạm Ngọc Tuyển</h4>
                    <h5>NHÓM VIÊN</h5>
                    <span class="maxim">❝ Tôi là chó, <br>bạn cũng thế ❞</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->end(); ?>
