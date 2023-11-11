<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $sTukhoa = $_GET["txtTuKhoa"];
    ?>
    <h1>Tim sach</h1>
    Tu khoa tim sach la: <?php echo $sTukhoa; ?>
    <br />
    Ket qua tim la : <?php echo 'Sach ' . $sTukhoa?>
</body>
</html>
</form>
    <form action="" method="get">
    <input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
<?php $this->end(); ?>