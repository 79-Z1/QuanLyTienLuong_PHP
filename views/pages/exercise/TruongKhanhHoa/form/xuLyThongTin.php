<style>
    p {
        font-size: 20px;
    }
</style>
<p>Họ tên: <?php echo $_POST['hoten'] ?></p>
<p>Giới tính: <?php echo $_POST['radGT'] ?></p>
<p>Địa chỉ: <?php echo $_POST['diachi'] ?></p>
<p>Điện thoại: <?php echo $_POST['sodienthoai'] ?></p>
<p>Quốc tịch: <?php echo $_POST['quoctich'] ?></p>
<p>Môn học: <?php 
    if(isset($_POST['chk1'])) echo $_POST['chk1'] . ", "; 
    if(isset($_POST['chk2'])) echo $_POST['chk2'] . ", "; 
    if(isset($_POST['chk3'])) echo $_POST['chk3'] . ", "; 
    if(isset($_POST['chk4'])) echo $_POST['chk4']; 
?></p>
<p>Ghi chú: <?php if(isset($_POST['ghichu'])) echo $_POST['ghichu']; ?></p>