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
    <h1>Tim sach</h1>
    <form method="GET">
        Tu khoa: <input type="text" name="txtTuKhoa"/>
        <input name="page" value="KQFormTimSach" style="display: none">
        <input class="btn btn-success" type="submit" value="Tìm">
    </form>
</body>
</html>
</form>
    <form action="" method="get">
    <input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
<?php $this->end(); ?>