<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tính toán</title>
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
    ?>
    
    <form align='center' action="" method="Get">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h3>Phép Tính</h3>
                </th>
            </thead>
            <tr>
                <td>Phép Tính</td>
                <td style="display: flex">
                <input type="radio" name="radPT" value="Cong"<?php if(isset($_GET['radPT'])&&$_GET['radPT']=='Cong') echo 'checked="checked"';?> checked/>Cộng<br>
	            <input type="radio" name="radPT" value="Tru" <?php if(isset($_GET['radPT'])&&$_GET['radPT']=='Tru') echo 'checked="checked"';?>/>Trừ<br>
                <input type="radio" name="radPT" value="Nhan"<?php if(isset($_GET['radPT'])&&$_GET['radPT']=='Nhan') echo 'checked="checked"';?>/>Nhân<br>
                <input type="radio" name="radPT" value="Chia"<?php if(isset($_GET['radPT'])&&$_GET['radPT']=='Chia') echo 'checked="checked"';?>/>Chia<br>
                </td>
            </tr>
            <tr>
                <td>Số thứ nhất:</td>
                <td><input type="text" name="a" value="<?php  echo $a;?> " /></td>
            </tr>
            <tr>
                <td>Số thứ hai:</td>
                <td><input type="text" name="b" value="<?php  echo $b;?> " /></td>
            </tr>
            <tr>
                <input name="page" value="KQThucHanhForm3" style="display: none">
                <td colspan="2" align="center"><input class="btn btn-success" type="submit" value="Tính" name="tinh" /></td>
            </tr>
        </table>
    </form>
    <form action="" method="get">
    <input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
</body>
<?php $this->end(); ?>