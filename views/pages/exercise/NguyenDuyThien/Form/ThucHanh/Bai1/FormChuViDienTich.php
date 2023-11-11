<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Chu vi dien tich</title>
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
    if(isset($_POST['a']))  
    $a=trim($_POST['a']); 
    else $a=0;
    if(isset($_POST['b']))  
    $b=trim($_POST['b']); 
    else $b=0;
    if(isset($_POST['tinh']))
        if (is_numeric($a) && is_numeric($b))  
        switch($a){
            case 1: $chuvi = 4*$b;
                    $dientich = $b*$b;
                    $hinh = 'Hình vuông';
                    break;
            case 2: define("PI", 3.1415);
                    $chuvi = 2*PI*$b;
                    $dientich = round(PI*pow($b,2),2);
                    $hinh = 'Hình tròn';
                    break;
            case 3: $p = ($b * 3)/2;
                    $chuvi = $b*3;
                    $dientich = sqrt($p*3*($p-$b));
                    $hinh = 'Hình tam giác đều';
                    break;
            case 4: $chuvi = ($a + $b) * 2;
                    $dientich = $a * $b;
                    $hinh = 'Hình chữ nhật';
                    break;
            default: echo " <br>Khong tinh trong truong hop nay";
        }
        else {
                echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
            }
?>
    <form align='center' action="" method="post">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h3>CHU VI VÀ DIỆN TÍCH CÁC HÌNH HỌC CƠ BẢN</h3>
                </th>
            </thead>
            <tr>
                <td>nhập a:</td>
                <td><input type="text" name="a" value="<?php  echo $a;?> " /></td>
            </tr>
            <tr>
                <td>nhập b:</td>
                <td><input type="text" name="b" value="<?php  echo $b;?> " /></td>
            </tr>
            <tr>
                <td>Hình:</td>
                <td><input type="text" name="hinh" disabled="disabled" value="<?php  echo $hinh;?> " /></td>
            </tr>
            <tr>
                <td>Chu vi:</td>
                <td><input type="text" name="chuvi" disabled="disabled" value="<?php  echo $chuvi;?> " /></td>
            </tr>
            <tr>
                <td>Diện tích:</td>
                <td><input type="text" name="dientich" disabled="disabled" value="<?php  echo $dientich;?> " /></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input class="btn btn-success" type="submit" value="Xử Lý" name="tinh" /></td>
            </tr>
        </table>
    </form>
</body>
</html>
</form>
    <form action="" method="get">
    <input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
<?php $this->end(); ?>