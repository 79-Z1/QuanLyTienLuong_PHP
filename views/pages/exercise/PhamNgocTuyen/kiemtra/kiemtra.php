<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Kiem Tra Mang</title>
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
if(isset($_POST['mssv']))  
    $a=trim($_POST['mssv']); 
else $mssv=0;
if(isset($_POST['name'])) 
    $name=trim($_POST['name']); 
else $name=0;
if(isset($_POST['date'])) 
    $date=trim($_POST['date']); 
else $date=0;

?>
<form align='center' action="" method="post">
<table>
    <thead>
        <th colspan="2" align="center"><h3>QUẢN LÝ SINH VIÊN</h3></th>
    </thead>
    <tr><td>Nhập MSSV:</td>
     <td><input type="text" name="mssv" value="<?php  echo $mssv;?> "/></td>
    </tr>
    <tr><td>Nhập Họ Tên:</td>
     <td><input type="text" name="name" value="<?php  echo $name;?> "/></td>
    </tr>
    <tr><td>Nhập Ngày Sinh:</td>
     <td><input type="text" name="date" value="<?php  echo $date;?> "/></td>
    </tr>

    <tr>
     <td  align="center"><input type="submit" value="Lưu SV" name="luu" /></td>
    </tr>
    <tr>
     <td  align="center"><input type="submit" value="Thêm SV" name="them" /></td>
    </tr>
    <tr>
        <td>
            <select name="lop[]" multiple>
                <option value="1"  selected>
                    62.CNTT-1
                </option>
                <option value="2">
                    62.CNTT-2
                </option>
                <option value="3">
                    62.CNTT-3
                </option>
            </select>
        </td>
    </tr>   
    <tr>
        <td >
            <input type="radio" name="radGT" value="Nam"<?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nam') echo 'checked="checked"';?> checked/>		Nam<br>
            <input type="radio" name="radGT" value="Nu" <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nu') echo 'checked="checked"';?>/>
                    N&#7919;<br>
        </td>
    </tr>
</table>
</form>
<?php 
    $sinhvien = array(
        'sinhvien1' => array(
            "MaLop" =>'62.CNTT-1',
            "MaSV" => '6212341',
            "HoTenSV" => 'Nguyễn Minh Anh',
            "GioiTinh" => 'Nữ',
            "NgaySinh" => "2002-08-09"
        ),
        'sinhvien2' => array(
            "MaLop" =>'62.CNTT-1',
            "MaSV" => '6212341',
            "HoTenSV" => 'Nguyễn Minh Anh',
            "GioiTinh" => 'Nữ',
            "NgaySinh" => "2002-08-09"
        ),
        'sinhvien3' => array(
            "MaLop" =>'62.CNTT-2',
            "MaSV" => '6212341',
            "HoTenSV" => 'Nguyễn Minh Anh',
            "GioiTinh" => 'Nữ',
            "NgaySinh" => "2002-08-09"
        ),
        'sinhvien4' => array(
            "MaLop" =>'62.CNTT-3',
            "MaSV" => '6212341',
            "HoTenSV" => 'Nguyễn Minh Anh',
            "GioiTinh" => 'Nữ',
            "NgaySinh" => "2002-08-09"
        )   
        );
    foreach ($sinhvien as $sinhviens => $value) {
        echo "<ul><h2>Thong tin $sinhviens</h2>";
        foreach($value as $thongtin){
            echo "<li>";
			echo " $thongtin ";
            echo "</li>";    
            
        }
        echo "</ul>";
    }
 ?>

</body>
</html>


<?php $this->end(); ?>