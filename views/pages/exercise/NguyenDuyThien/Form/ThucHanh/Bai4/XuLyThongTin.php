<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php 
    if(isset($_GET['hoten'])){
        $hoten = $_GET['hoten'];
    }else $hoten = '';
    if(isset($_GET['diachi'])){
        $diachi = $_GET['diachi'];
    }else $diachi = '';
    if(isset($_GET['sdt'])){
        $sdt = $_GET['sdt'];
    }else $sdt = '';
    if(isset($_GET['radGT'])){
        $gt = $_GET['radGT'];
    }else $gt = '';
    if(isset($_GET['quoctich'])){
        $quoctich = $_GET['quoctich'];
    }else $quoctich = '';
    if(isset($_GET['comment'])){
        $comment = $_GET['comment'];
    }else $comment = '';
    $monhoc = '';
    if(isset($_GET['chk1']))
        $monhoc .= $_GET['chk1'];
    if(isset($_GET['chk2']))
        $monhoc .= $_GET['chk2'];
    if(isset($_GET['chk3']))
        $monhoc .= $_GET['chk3'];
    if(isset($_GET['chk4']))
        $monhoc .= $_GET['chk4'];
?>
<h4>Bạn đã đăng nhập thành công, dưới đây là những thông tin bạn nhập</h4>
<p>Họ tên: <?php echo $hoten ?></p>
<p>Giới tính: <?php echo $gt ?></p>
<p>Địa chỉ: <?php echo $diachi ?></p>
<p>SĐT: <?php echo $sdt ?></p>
<p>Quốc tịch: <?php echo $quoctich ?></p>
<p>Môn học: <?php echo $monhoc ?></p>
<p>Comment: <?php echo $comment ?></p>
<form action="" method="get">
    <input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
<?php $this->end(); ?>