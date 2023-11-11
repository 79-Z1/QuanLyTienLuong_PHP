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
		if(isset($_POST['namT']))  
		    $namT=trim($_POST['namT']); 
		else $namT=""; 


        if(isset($_POST['namD']))  
		    $namD=trim($_POST['namD']); 
		else $namD="";            

		$kq1 = "";
		$kq2 = "";

        function nam_nhuan($nam){
            if($nam%400 == 0 || $nam%4==0 && $nam%100!=0) return 1;
            else return 0;
        }


		if(isset($_POST['xuLy1']) || isset($_POST['xuLy2'])){
            if (is_numeric($namT) && $namT < 2000)  {
                foreach (range($namT,2000) as $year) {
                   if(nam_nhuan($year) == 1) $kq1 .= "$year ";
                }
                if($kq1!="") $kq1 .= "là năm nhuận";
                else $kq1 = "Không có năm nhuận";
            }
            else echo "Vui lòng nhập năm đúng với yêu cầu!";

            if (is_numeric($namD) && $namD > 2000)  {
                foreach (range(2000,$namD) as $year) {
                   if(nam_nhuan($year) == 1) $kq2 .= "$year ";
                }
                if($kq2!="") $kq2 .= "là năm nhuận";
                else $kq2 = "Không có năm nhuận";
            }
            else echo "Vui lòng nhập năm đúng với yêu cầu!";

        }
		
	?>
	<form action="" method="post">
        <b>Năm nhập vào nhỏ hơn năm 2000</b>
		<table border="0" cellpadding="0">
			<th colspan="2"><h2>Tìm năm nhuận</h2></th>
			<tr align="center">
				<td>
					Năm:
				</td>
				<td>
					<input type="text" name="namT" size="30" value="<?php echo $namT;?>">
				</td>
			</tr>
            <tr>
				<td colspan="2"><textarea disabled="disabled" cols="50" rows="2" name="ketqua1"> <?php echo $kq1?></textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="xuLy1"  size="20" value="Tìm năm nhuận"/></td>
			</tr>
		</table>

        <b>Năm nhập vào lớn hơn năm 2000</b>
		<table border="0" cellpadding="0">
			<th colspan="2"><h2>Tìm năm nhuận</h2></th>
			<tr align="center">
				<td>
					Năm:
				</td>
				<td>
					<input type="text" name="namD" size="30" value="<?php echo $namD;?>">
				</td>
			</tr>
            <tr>
				<td colspan="2"><textarea disabled="disabled" cols="50" rows="2" name="ketqua2"> <?php echo $kq2?></textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="xuLy2"  size="20" value="Tìm năm nhuận"/></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php $this->end(); ?>