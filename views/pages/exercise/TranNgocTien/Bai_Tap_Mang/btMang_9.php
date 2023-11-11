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
		
        if(isset($_POST['mangA']))  
		    $mangA=trim($_POST['mangA']); 
		else $mangA=""; 
        if(isset($_POST['mangB']))  
		    $mangB=trim($_POST['mangB']); 
		else $mangB=""; 
        
        

        $sptA = "";
        $sptB = "";
        $mangC = "";
        $CTang = "";
        $CGiam = "";

		if(isset($_POST['xuLy'])){
            if ($mangA != "" && $mangB != "")  {
                $manga = explode(",",$mangA);
                $sptA = count($manga);

                $mangb = explode(",",$mangB);
                $sptB = count($mangb);

                $mangc = array_merge($manga,$mangb);

                foreach($mangc as $value){
                    $mangC .= "$value, ";
                }

                asort($mangc);
                foreach($mangc as $value){
                    $CTang .= "$value, ";
                }

                arsort($mangc);
                foreach($mangc as $value){
                    $CGiam .= "$value, ";
                }
            }
            else echo "Vui lòng nhập dãy số";
        }
		
	?>
	<form action="" method="post">
		<table border="0" cellpadding="0">
			<th colspan="2"><h2>ĐẾM PHẦN TỬ, GHÉP MẢNG VÀ SẮP XẾP</h2></th>
            <tr>
                <td>Mảng A: </td>
                <td><input type="text" name="mangA" size="50" value="<?php echo $mangA;?>"></td>
            </tr>
            <tr>
                <td>Mảng B: </td>
                <td><input type="text" name="mangB" size="50" value="<?php echo $mangB;?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="xuLy"  size="20" value="Thực hiện"/></td>
            </tr>
            <tr>
                <td>Số phần tử mảng A: </td>
                <td><input type="text" disabled="disabled" name="sptA" size="30" value="<?php echo $sptA;?>"></td>
            </tr>
            <tr>
                <td>Số phần tử mảng B: </td>
                <td><input type="text" disabled="disabled" name="sptB" size="30" value="<?php echo $sptB;?>"></td>
            </tr>
            <tr>
                <td>Mảng C: </td>
                <td><input type="text" disabled="disabled" name="mangC" size="50" value="<?php echo $mangC;?>"></td>
            </tr>
            <tr>
                <td>Mảng C tăng dần: </td>
                <td><input type="text" disabled="disabled" name="CTang" size="50" value="<?php echo $CTang;?>"></td>
            </tr>
            <tr>
                <td>Mảng C giảm dần: </td>
                <td><input type="text" disabled="disabled" name="$CGiam" size="50" value="<?php echo $CGiam;?>"></td>
            </tr>
            <tr>
                <td colspan="2">(*) Các số được nhập cách nhau bằng dấu ","</td>
            </tr>
		</table>

        
	</form>
</body>
</html>
<?php $this->end(); ?>