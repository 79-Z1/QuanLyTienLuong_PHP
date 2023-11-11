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
		
        if(isset($_POST['n']))  
		    $n=trim($_POST['n']); 
		else $n="";            

        $tong = "";
        $mang = "";
        $max = "";
        $min = "";

        function tongDay($arr){
            $tong = 0;
            foreach($arr as $value){
                $tong += $value;
            }
            return $tong;
        }

        function maxMang($arr){
            $max = $arr[0];
            foreach($arr as $value){
                if($value > $max){
                    $max = $value;
                }
            }
            return $max;
        }

        function minMang($arr){
            $min = $arr[0];
            foreach($arr as $value){
                if($value < $min){
                    $min = $value;
                }
            }
            return $min;
        }



		if(isset($_POST['xuLy'])){
            if (is_numeric($n) && $n > 0)  {
                $matrix = array();
                for ($i=0; $i < $n ; $i++) { 
                    $matrix[$i] =  rand(0,20);
                    $mang .= "$matrix[$i] ";
                }
                $tong = tongDay($matrix);
                $max = maxMang($matrix);
                $min = minMang($matrix);
            }
            else echo "Vui lòng nhập số lượng lớn hơn 0";
        }
		
	?>
	<form action="" method="post">
		<table border="0" cellpadding="0">
			<th colspan="2"><h2>Nhập và tính trên dãy số</h2></th>
            <tr>
                <td>Nhập số phần tử: </td>
                <td><input type="text" name="n" size="30" value="<?php echo $n;?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="xuLy"  size="20" value="Phát sinh và tính toán"/></td>
            </tr>
            <tr >
                <td>Mảng: </td>
                <td><input type="text" disabled="disabled" name="mang" size="30" value="<?php echo $mang;?>"></td>
            </tr>
            <tr >
                <td>GTLN (MAX) trong mảng: </td>
                <td><input type="text" disabled="disabled" name="mang" size="10" value="<?php echo $max;?>"></td>
            </tr>
            <tr >
                <td>GTNN (MIN) trong mảng: </td>
                <td><input type="text" disabled="disabled" name="mang" size="10" value="<?php echo $min;?>"></td>
            </tr>
            <tr >
                <td>Tổng mảng: </td>
                <td><input type="text" disabled="disabled" name="mang" size="10" value="<?php echo $tong;?>"></td>
            </tr>
            <tr  >
                <td colspan="2">Ghi chú: Các phần tử trong mảng có giá trị từ 0 đến 20</td>
            </tr>
		</table>

        
	</form>
    <p align="left"><a href="?page=">Quay lại</a></p>

</body>
</html>
<?php $this->end(); ?>