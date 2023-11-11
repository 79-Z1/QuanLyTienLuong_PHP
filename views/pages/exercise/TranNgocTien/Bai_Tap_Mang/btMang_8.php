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

        $tang = "";
        $giam = "";

		if(isset($_POST['xuLy'])){
            if ($daySo != "")  {
                $mangSo = explode(",",$daySo);
                asort($mangSo);
                foreach($mangSo as $value){
                    $tang .= "$value, ";
                }
                arsort($mangSo);
                foreach($mangSo as $value){
                    $giam .= "$value, ";
                }
            }
            else echo "Vui lòng nhập dãy số";
        }
		
	?>
	<form action="" method="post">
		<table border="0" cellpadding="0">
			<th colspan="2"><h2>SẮP XẾP MẢNG</h2></th>
            <tr>
                <td>Nhập dãy số: </td>
                <td><input type="text" name="daySo" size="50" value="<?php echo $daySo;?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="xuLy"  size="20" value="Sắp xếp tăng giảm"/></td>
            </tr>
            <tr>
                <td>Sau khi sắp xếp</td>
                <td></td>
            </tr>
            <tr>
                <td>Tăng dần: </td>
                <td><input type="text" disabled="disabled" name="mang" size="50" value="<?php echo $tang;?>"></td>
            </tr>
            <tr>
                <td>Giảm dần: </td>
                <td><input type="text" disabled="disabled" name="$mangmoi" size="50" value="<?php echo $giam;?>"></td>
            </tr>
            <tr>
                <td colspan="2">(*) Các số được nhập cách nhau bằng dấu ","</td>
            </tr>
		</table>

        
	</form>
</body>
</html>
