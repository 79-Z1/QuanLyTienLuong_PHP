<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tính tiền điện</title>
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
        if(isset($_POST['ten']))  
        $ten=trim($_POST['ten']); 
        else $ten='';
        if(isset($_POST['cu']))  
        $cu=trim($_POST['cu']); 
        else $cu=0;
        if(isset($_POST['moi']))  
        $moi=trim($_POST['moi']); 
        else $moi=0;
        if(isset($_POST['dongia']))  
        $dongia=trim($_POST['dongia']); 
        else $dongia=20000;
        if(isset($_POST['tinh']))
        if (is_numeric($cu) && is_numeric($moi) && is_string($ten))  
            $sotien = ($moi - $cu) * $dongia;
        else {
                echo "<font color='red'>Vui lòng nhập lại! </font>"; 
                $dongia = 20000;
            }
        else $dongia = 20000;
    ?>
<form align='center' action="" method="post">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h3>TÍNH TIỀN ĐIỆN</h3>
                </th>
            </thead>
            <tr>
                <td>Tên chủ hộ:</td>
                <td><input type="text" name="ten" value="<?php  echo $ten;?> " /></td>
            </tr>
            <tr>
                <td>Chỉ số cũ:</td>
                <td><input type="text" name="cu" value="<?php  echo $cu;?> " /> (Kw)</td>
            </tr>
            <tr>
                <td>Chỉ số mới:</td>
                <td><input type="text" name="moi" value="<?php  echo $moi;?> " /> (Kw)</td>
            </tr>
            <tr>
                <td>Đơn giá:</td>
                <td><input type="text" name="dongia" value="<?php  echo $dongia;?> " /> (VNĐ)</td>
            </tr>
            <tr>
                <td>Số tiền thanh toán:</td>
                <td><input type="text" name="sotien" readonly value="<?php  echo $sotien;?> " /> (VNĐ)</td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input class="btn btn-success" type="submit" value="Tính" name="tinh" /></td>
            </tr>
        </table>
    </form>
</body>
</form>
<form action="" method="get">
    <input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
<?php $this->end(); ?>