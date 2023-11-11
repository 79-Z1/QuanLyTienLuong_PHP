<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tinh nam nhuan</title>
    <style type="text/css">
    body {
        background-color: #d24dff;
    }

    table {
        background: #ffd94d;
        border: 0 solid yellow;
    }

    thead {
        background: #fff14d;
    }
    td {
        color: blue;
    }
    h3 {
        font-family: verdana;
        text-align: center;
        /* text-anchor: middle; */
        color: #ff8100;
        font-size: medium;
    }
    </style>
</head>
<body>
<?php
    function tinh_nam_nhuan($nam){
        if($nam % 400 == 0 || $nam % 4 == 0 && $nam % 100 != 0)
        return true;
        else
        return false;
    }
    if(isset($_POST['nam1']))
    $nam1 = trim($_POST['nam1']);
    else
    $nam1 = 0;

    if(isset($_POST['nam2']))
    $nam2 = trim($_POST['nam2']);
    else
    $nam2 = 0;

    $ketqua1 = "";
    $ketqua2 = "";

    if(isset($_POST['tinh1']) && $nam1 < 2000){
        foreach(range(2000,$nam1) as $year){
            if(tinh_nam_nhuan($year)){
                $ketqua1 .= "$year ";
            }
        }
        if($ketqua1 != "")
            $ketqua1 .= "la nam nhuan";
        else
            $ketqua1 = "khong co nam nhuan";
    }

    if(isset($_POST['tinh2']) && $nam2 > 2000){
        foreach(range(2000,$nam2) as $year){
            if(tinh_nam_nhuan($year)){
                $ketqua2 .= "$year ";
            }
        }
        if($ketqua2 != "")
            $ketqua2 .= "la nam nhuan";
        else
            $ketqua2 = "khong co nam nhuan";
    }

?>
    <form align='center'  method="post">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h3>NHAP NAM < 2000</h3>
                </th>
            </thead>
            <tr>
                <td>nhap nam:</td>
                <td><input type="text" name="nam1" value="<?php  echo $nam1;?> " /></td>
            </tr>
            <tr>
                <td>ket qua: </td>
                <td><textarea name="ketqua1" rows = "2" cols = "50" ><?php echo $ketqua1;?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input class="btn btn-success" type="submit" value="Xử Lý" name="tinh1" /></td>
            </tr>
            <thead>
                <th colspan="2" align="center">
                    <h3>NHAP NAM > 2000</h3>
                </th>
            </thead>
            <tr>
                <td>nhap nam:</td>
                <td><input type="text" name="nam2" value="<?php  echo $nam2;?> " /></td>
            </tr>
            <tr>
                <td>ket qua: </td>
                <td><textarea name="ketqua2" rows = "2" cols = "50" ><?php echo $ketqua2;?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input class="btn btn-success" type="submit" value="Xử Lý" name="tinh2" /></td>
            </tr>
        </table>
    </form>
    <form action="" method="get">
    <input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
</body>
</html>
<?php $this->end(); ?>