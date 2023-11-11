<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Thông tin Khách Hàng</title>
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

  // Ket noi CSDL
//require("connect.php");
$conn = mysqli_connect ('localhost', 'root', '', 'qlbansua') 
		OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
$sql = 'select Ma_khach_hang,Ten_khach_hang,Phai,Dia_chi,Dien_thoai from khach_hang';
$result = mysqli_query($conn, $sql);
$maKH = $_GET['Ma_khach_hang'];  
$getKH= "select * from khach_hang
where Ma_khach_hang='$maKH '";   
$resultKH = mysqli_query($conn, $getKH);
$kh = mysqli_fetch_array($resultKH);

if (isset($_POST['Ma_khach_hang']))
$makh = trim($_POST['Ma_khach_hang']);
else $makh = $kh['Ma_khach_hang'] ;

if (isset($_POST['name']))
$name = trim($_POST['name']);
else $name = $kh['Ten_khach_hang'];

if (isset($_POST['sdt']))
$sdt = trim($_POST['sdt']);
else $sdt = $kh['Dien_thoai'];

if (isset($_POST['dc']))
$dc = trim($_POST['dc']);
else $dc = $kh['Dia_chi'];

if (isset($_POST['em']))
$em = trim($_POST['em']);
else $em = $kh['Email'];



if (isset($_POST['capnhat'])) {
    if($name != ''&& $sdt != ''&& $dc != ''&& $em !=''){
        $sqlupdate = "UPDATE `khach_hang` SET `Ten_khach_hang`='$name',`Phai`='$_POST[radGT]',`Dia_chi`='$dc',`Dien_thoai`='$sdt',`Email`='$em' WHERE Ma_khach_hang='$_GET[Ma_khach_hang]'";
        $resultupdate = mysqli_query($conn, $sqlupdate);
    }
}

?>
<form action="" method="post">
<table>
    <thead><th colspan="4" align="center"><h3>CHI TIẾT NHÂN VIÊN</h3></th></thead>
    <tr>
        <td>Mã khách hàng: </td>
        <td><input type="text" name="makh" size="10" value="<?php  echo $makh;?>"disabled="disabled"/> </td>
        
        <tr><td >Giới tính: </td>
        <td>
            <input type="radio" name="radGT" value="1" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '0' || $kh['Phai']=='0') echo 'checked="checked"'; ?> checked />
            Nam
            <input type="radio" name="radGT" value="0" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '1' || $kh['Phai']=='1') echo 'checked="checked"'; ?> />
            Nữ
        </td>
        </tr>
    </tr>
    <tr>
        <td>Tên khách hàng:</td>
            <td><input type="text" name="name" value="<?php  echo $name;?> "/></td>
        <tr>
        <td >Số điện thoại: </td>
            <td><input type="text" name="sdt" value="<?php  echo $sdt;?> "/></td>
        </tr>
    </tr>
    <tr>
        <td>Địa chỉ:</td>
        <td><input type="text" name="dc" size="30" value="<?php  echo $dc;?> "/></td>
    <tr>    
        <td>Email:</td>
        <td><input type="text" name="em" value="<?php  echo $em;?> "/></td>
        </tr>
    </tr>
    <tr>
                        <td id="no_color" colspan="4" align="center">
                        <input type="submit" value="Cập Nhật" name="capnhat" class="btn btn-outline-purple capnhatkh-btn mb-5 w-25"/>
                        </td>
                    </tr>
</table>
</form>