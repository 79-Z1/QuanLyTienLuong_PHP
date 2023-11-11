<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>tinh tien dien</title>
    <style type="text/css">
        body {  
            background-color: #d24dff;
        }
        table{
            background: #ffd94d;
            border: 0 solid yellow;
        }
        thead{
            background: #fff14d;    

        }
        td {
            color: blue;

        }
        h3{
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
if(isset($_POST['chuho']))  
    $chuho=trim($_POST['chuho']); 
else $chuho=" ";
if(isset($_POST['chisocu'])) 
    $chisocu=trim($_POST['chisocu']); 
else $chisocu=" ";
if(isset($_POST['chisocu'])) 
    $chisocu=trim($_POST['chisocu']); 
else $chisocu=" ";
if(isset($_POST['chisomoi'])) 
    $chisomoi=trim($_POST['chisomoi']); 
else $chisomoi=" ";
if(isset($_POST['dongia'])) 
    $dongia=trim($_POST['dongia']); 
else $dongia=" ";
if(isset($_POST['tinh']))
        if (is_numeric($chisomoi) && is_numeric($chisocu) && is_numeric($dongia))  
            $sotien=($chisomoi - $chisocu)* $dongia;
        else {
                echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
                $sotien="";
            }
		else $sotien=0;
?>
<form    action="" method="post">
<table>
    <thead>
        <th      align="center"><h3>THANH TOÁN TIỀN ĐIỆN</h3></th>
    </thead>
    <tr><td>Tên chủ hộ:</td>
     <td><input type="text" name="chuho" value="<?php  echo $chuho;?> "/>(Kw)</td>
    </tr>
    <tr><td>Chỉ số cũ:</td>
     <td><input type="text" name="chisocu" value="<?php  echo $chisocu;?> "/>(Kw)</td>
    </tr>
    <tr><td>Chỉ số mới:</td>
     <td><input type="text" name="chisomoi"  value="<?php  echo $chisomoi;?> "/>(VNĐ)</td>
    </tr>
    <tr><td>Đơn giá:</td>
     <td><input type="text" name="dongia"  value="<?php  echo $dongia;?> "/>(VNĐ)</td>
    </tr>
    <tr><td>Số tiền thanh toán:</td>
     <td><input type="text" name="sotien" disabled="disabled" value="<?php  echo $sotien;?> "/>(VNĐ)</td>
    </tr>
    <tr>
     <td colspan="2" align="center"><input type="submit" value="Tính" name="tinh" /> </td>
    </tr>
</table>
</form>
</body>
</html>
<?php $this->end(); ?>