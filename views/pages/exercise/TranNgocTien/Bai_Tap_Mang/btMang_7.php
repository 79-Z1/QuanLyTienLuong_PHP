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
		
        if(isset($_POST['daySo']))  
		    $daySo=trim($_POST['daySo']); 
		else $daySo=""; 
        
        if(isset($_POST['x']))  
		    $x=trim($_POST['x']); 
		else $x=""; 

        if(isset($_POST['y']))  
		    $y=trim($_POST['y']); 
		else $y=""; 

        $mang = "";
        $mangmoi = "";

        function replace($arr, $x, $y){
            $mangMoiChuoi ="";
            foreach($arr as $key => $value){
                if($value == $x){
                    $arr[$key] = $y;
                }
            }
            foreach($arr as $value){
                $mangMoiChuoi .= "$value ";
            }
            return $mangMoiChuoi;
        }

		if(isset($_POST['xuLy'])){
            if ($daySo != "")  {
                $mangSo = explode(",",$daySo);
                foreach($mangSo as $value){
                    $mang .= "$value ";
                }
                $mangmoi =  replace($mangSo,$x,$y);
            }
            else echo "Vui lòng nhập dãy số";
        }
		
	?>
	<form action="" method="post">
		<table border="0" cellpadding="0">
			<th colspan="2"><h2>THAY THẾ</h2></th>
            <tr>
                <td>Nhập dãy số: </td>
                <td><input type="text" name="daySo" size="50" value="<?php echo $daySo;?>"></td>
            </tr>
            <tr>
                <td>Giá trị cần thay thế: </td>
                <td><input type="text" name="x" size="30" value="<?php echo $x;?>"></td>
            </tr>
            <tr>
                <td>Giá trị thay thế: </td>
                <td><input type="text" name="y" size="30" value="<?php echo $y;?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="xuLy"  size="20" value="Thay thế"/></td>
            </tr>
            <tr>
                <td>Mảng cũ: </td>
                <td><input type="text" disabled="disabled" name="mang" size="50" value="<?php echo $mang;?>"></td>
            </tr>
            <tr>
                <td>Mảng sau khi thay thế: </td>
                <td><input type="text" disabled="disabled" name="$mangmoi" size="50" value="<?php echo $mangmoi;?>"></td>
            </tr>
            <tr>
                <td colspan="2">(*) Các số được nhập cách nhau bằng dấu ","</td>
            </tr>
		</table>

        
	</form>
</body>
</html>
<?php $this->end(); ?>