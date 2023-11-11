<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Thao tac tren mang</title>

<style type="text/css">
    fieldset {
        background-color: #eeeeee;
    }

    legend {
        background-color: gray;
        color: white;
        padding: 5px 10px;
    }

    input {
        margin: 5px;
    }
    table, th, td {
        border:1px solid black;
    }
</style>

</head>

<body>

<?php

    $listsinhvien = array (
        array("62.CNTT1","6212341","Nguyễn Minh Anh","Nữ","2002-08-09"),
        array("62.CNTT1","6210123","Trần Anh Tú","Nam","2002-05-21"),
        array("62.CNTT2","6211012","Nguyễn Ngọc Thanh","Nam","2002-02-30"),
        array("62.CNTT3","6210123","Lê Phương Thảo","Nam","2001-10-15")
    );
    if(isset($_POST['them']) || isset($_POST['luu'])) {
        if(empty($_POST['masv']) || empty($_POST['hoten']) || empty($_POST['ngaysinh'])){
            echo "Vui lòng nhập đầy đủ thông tin";
        }
        else{
            $file = "NguyenDuyThien_62131996.dat";
            $myfile = fopen($file, "w") or die("Unable to open file!");
            foreach($listsinhvien as $sinhvien){
            $txt = implode(" ",$sinhvien);
            $txt .= "\n";
            fwrite($myfile, $txt);
            }
            fclose($myfile);
            $newsinhvien = array($_POST['lop'],$_POST['masv'],$_POST['hoten'],$_POST['radGT'],$_POST['ngaysinh']);
            array_push($listsinhvien,$newsinhvien);
            $txtsv = implode(" ",$newsinhvien);
            $txtsv .= "\n";
            $myfile = fopen($file, "a") or die("Unable to open file!");
            fwrite($myfile, $txtsv);
            fclose($myfile);
        }
    }
?>

<form action="" method="post">

<fieldset>
	<legend>Nhập thông tin sinh viên</legend>
	<table border="0" cellpadding="0">
    <tr>
        <td>Lớp:</td>
        <td>
        <select name="lop">
            <option value="62cntt1" <?php if(isset($_POST['lop'])&& $_POST['lop']=='62.CNTT1') echo 'selected';?>>
            62.CNTT1
            </option>
            <option value="62cntt2" <?php if(isset($_POST['lop'])&& $_POST['lop']=='62.CNTT2') echo 'selected';?>>
            62.CNTT2
            </option>
            <option value="62cntt3" <?php if(isset($_POST['lop'])&& $_POST['lop']=='62.CNTT3') echo 'selected';?>>
            62.CNTT3
            </option>
        </select>
        </td>
    </tr>
    <tr>
        <td>Giới tính:</td>
        <td style= "display: flex">
        <input type="radio" name="radGT" value="Nam"<?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nam') echo 'checked="checked"';?> checked/>Nam<br>
        <input type="radio" name="radGT" value="Nu" <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nu') echo 'checked="checked"';?>/>Nữ<br>
        </td>
    </tr>
    <tr>
        <td>Mã sinh viên:</td>
        <td><input type="text" name="masv" value="<?php  echo $masv;?> " size="15"/></td>
    </tr>
    <tr>
        <td>Họ và tên sinh viên:</td>
        <td><input type="text" name="hoten" value="<?php  echo $hoten;?> " size="30"/></td>
    </tr>
    <tr>
        <td>Ngày sinh:</td>
        <td><input type="date" name="ngaysinh" value="<?php  echo $ngaysinh;?> " /></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input type="submit" name="them"  size="20" value="Thêm Sinh Viên"/></td>
        <td colspan="2" align="center"><input type="submit" name="luu"  size="20" value="Lưu Sinh Viên"/></td>
    </tr>
</table>

</fieldset>

</form>
<h1>Thông tin sinh viên</h1>
<table style="width:100%">
  <tr>
    <th>Lớp</th>
    <th>Mã SV</th>
    <th>Họ tên</th>
    <th>Giới Tính</th>
    <th>Ngày sinh</th>
  </tr>
  <?php
    foreach($listsinhvien as $sinhvien){
        echo "
        <tr>
        <td>$sinhvien[0]</td>
        <td>$sinhvien[1]</td>
        <td>$sinhvien[2]</td>
        <td>$sinhvien[3]</td>
        <td>$sinhvien[4]</td>
        </tr>
        ";
    }
    ?>
</table>
</body>

</html>