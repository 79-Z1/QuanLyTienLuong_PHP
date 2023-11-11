<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">

	table{

		color: #ffff00;

		background-color: gray;     

	}

	table th{

		background-color: blue;

		font-style: vni-times;

		color: yellow;

	}

	</style>
</head>
<body>
	<?php 
		
        if(isset($_POST['namD']))  
		    $namD=trim($_POST['namD']); 
		else $namD="";            

        $namA = "";
        $hinh_anh = "";

        $mang_can = array("Quý","Giáp","Ất","Bính","Đinh","Mậu","Kỷ","Canh","Tân","Nhâm");

        $mang_chi = array("Hợi","Tí","Sửu","Dần","Mão","Thìn","Tỵ","Ngọ","Mùi","Thân","Dậu","Tuất");

        $mang_hinh = array("hoi.jpg","ti.jpg","suu.jpg","dan.jpg","meo.jpg","thin.jpg","ty.jpg","ngo.jpg","mui.jpg","than.jpg","dau.jpg","tuat.jpg");

		if(isset($_POST['xuLy'])){
            if (is_numeric($namD) && $namD > 0)  {
                $nam = $namD - 3;
                $can  = $nam%10;
                $chi  = $nam%12;
                $namA = $mang_can[$can];
                $namA = $namA . " " . $mang_chi[$chi];
                $hinh = $mang_hinh[$chi];
            }
            else echo "Vui lòng nhập năm > 0";

        }
		
	?>
	<form action="" method="post">
		<table border="0" cellpadding="0">
			<th colspan="3"><h2>Tính năm âm lịch</h2></th>
            <tr align="center">
                <td>Năm dương lịch</td>
                <td></td>
                <td>Năm âm lịch</td>
            </tr>
            <tr align="center">
                <td><input type="text" name="namD" size="30" value="<?php echo $namD;?>"></td>
                <td><input type="submit" name="xuLy"  size="20" value="=>"/></td>
                <td><input type="text" disabled="disabled" name="namA" size="30" value="<?php echo $namA;?>"></td>
            </tr>
			<th colspan="3"><img src="/QuanLyTienLuong_PHP/views/pages/exercise/TranNgocTien/Bai_Tap_Mang/image/<?php echo $hinh ?>" alt=""></th>
		</table>
	</form>
</body>
</html>
<?php $this->end(); ?>