<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Kết quả</title>
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
        if(isset($_GET['a']))
        $a=trim($_GET['a']); 
        else $a= 0;
        if(isset($_GET['b']))  
        $b=trim($_GET['b']); 
        else $b= 0;
        if(isset($_GET['radPT']))
        $pheptinh = $_GET['radPT'];
        if(isset($_GET['tinh']))
        if (is_numeric($a) && is_numeric($b))
            switch($pheptinh)
            {
                case 'Cong': $ketqua = $a + $b;
                break;
                case 'Tru': $ketqua = $a - $b;
                break;
                case 'Nhan': $ketqua = $a * $b;
                break;
                case 'Chia': $ketqua = $a / $b;
                break;
                default: echo " <br>Khong tinh trong truong hop nay";
            }
            else {
                echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
            }
    ?>
    
    <form align='center' action="PhepTinh.php" method="post">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h3>KẾT QUẢ</h3>
                </th>
            </thead>
            <tr>
                <td>Số thứ nhất:</td>
                <td><input type="text" name="a" value="<?php  echo $a;?> " /></td>
            </tr>
            <tr>
                <td>Số thứ hai:</td>
                <td><input type="text" name="b" value="<?php  echo $b;?> " /></td>
            </tr>
            <tr>
                <td>Phép tính:</td>
                <td><input type="text" name="pheptinh" disabled="disabled" value="<?php  echo $pheptinh;?> " /></td>
            </tr>
            <tr>
                <td>Kết quả:</td>
                <td><input type="text" name="ketqua" disabled="disabled" value="<?php  echo $ketqua;?> " /></td>
            </tr>
        </table>
    </form>
    <form action="" method="get">
    <input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
</body>
<?php $this->end(); ?>