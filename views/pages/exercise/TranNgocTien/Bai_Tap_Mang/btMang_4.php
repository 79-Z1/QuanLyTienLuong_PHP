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

        $tong = "";

        function tongDay($arr){
            $tong = 0;
            foreach($arr as $value){
                $tong += $value;
            }
            return $tong;
        }

		if(isset($_POST['xuLy'])){
            if ($daySo != "")  {
                $mangSo = explode(",",$daySo);
                $tong = tongDay($mangSo);
            }
            else echo "Vui lòng nhập dãy số";
        }
		
	?>
	<form action="" method="post">
		<table border="0" cellpadding="0">
			<th colspan="2"><h2>Nhập và tính trên dãy số</h2></th>
            <tr align="center">
                <td>Nhập dãy số: </td>
                <td><input type="text" name="daySo" size="30" value="<?php echo $daySo;?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="xuLy"  size="20" value="Tổng dãy số"/></td>
            </tr>
            <tr align="center">
                <td>Tổng dãy số: </td>
                <td><input type="text" disabled="disabled" name="tong" size="30" value="<?php echo $tong;?>"></td>
            </tr>
            <tr align="center" >
                <td colspan="2">(*) Các số được nhập cách nhau bằng dấu ","</td>
            </tr>
		</table>

        
	</form>
</body>
</html>
