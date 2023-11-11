<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Thông tin khách hàng</title>

</head>

<body>

<?php

$conn = mysqli_connect ('localhost', 'root', '', 'qlbansua') 

		OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

$sql = 'select Ma_khach_hang,Ten_khach_hang,Phai,Dia_chi,Dien_Thoai,Email from khach_hang';

$result = mysqli_query($conn, $sql);
?>


<p align='center'><font size='5' color='blue'> THÔNG TIN KHÁCH HÀNG</font></P>

<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>
<tr>

    <th width="50">Mã KH</th>

    <th width="50">Tên khách hàng</th>

    <th width="30">Giới tính</th>

    <th width="80">Địa chỉ</th>
    
    <th width="50">Số điện thoại</th>
    
    <th width="50">Email</td>
</tr>
<style>
    a{
        margin-left: 30px;
    }
</style>

<?php

 if(mysqli_num_rows($result)<>0)
 {	$stt = 1;

	while($rows=mysqli_fetch_row($result))
	{     
        if($stt % 2 != 0 ) $bg = "#DCDCDC";
        else $bg = "white";
        if($rows[2] == 0) $gt = "nam";
        else $gt = "nu";
        ?>
        <tr style = 'background-color: <?=$bg?>'>
        <td><?=$rows[0]?></td>
        <td><?=$rows[1]?></td>
        <td align = 'center'><img width = '30' src='/QuanLyTienLuong_PHP/views/pages/exercise/NguyenDuyThien/QLBS/Avatar/<?=$gt?>.jpg'></td>
        <td><?=$rows[3]?></td>
        <td><?=$rows[4]?></td>
        <td><?=$rows[5]?></td>
        <td><a href="index.php?page=QLBSSuaTTKH&MaKH=<?=$rows[0]?>">Sửa</a><a href="index.php?page=QLBSSuaTTKH&MaKH=<?=$rows[0]?>">Xoá</a></td>
        </tr>
        <?php
        $stt++;
	}
 }
?>
</table>
</body>
<form action="" method="get">
<input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
</html>
<?php $this->end(); ?>