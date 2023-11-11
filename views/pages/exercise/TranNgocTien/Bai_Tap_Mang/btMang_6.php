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

        $tong = "";
        $mang = "";
        $kq = "";

        function tongDay($arr){
            $tong = 0;
            foreach($arr as $value){
                $tong += $value;
            }
            return $tong;
        }
        function timX($arr, $x){
            $kq = "";
            $co = 0;
            foreach($arr as $key => $value){
                if($value == $x){
                    $co = 1;
                    $kq .= "Tìm thấy $x tại vị trí " . $key+1 . " của mảng ";
                }
            }
            if($co == 0){
                $kq = "Không tìm thấy $x";
            }
            return $kq;
            // return "Không tìm thấy $x";
        }

		if(isset($_POST['xuLy'])){
            if ($daySo != "")  {
                $mangSo = explode(",",$daySo);
                foreach($mangSo as $value){
                    $mang .= "$value, ";
                }
                $tong = tongDay($mangSo);
                $kq =  timX($mangSo,$x);
            }
            else echo "Vui lòng nhập dãy số";
        }
		
	?>
	<form action="" method="post">
		<table border="0" cellpadding="0">
			<th colspan="2"><h2>Nhập và tính trên dãy số</h2></th>
            <tr>
                <td>Nhập dãy số: </td>
                <td><input type="text" name="daySo" size="30" value="<?php echo $daySo;?>"></td>
            </tr>
            <tr>
                <td>Nhập số cần tìm: </td>
                <td><input type="text" name="x" size="30" value="<?php echo $x;?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="xuLy"  size="20" value="Tìm kiếm"/></td>
            </tr>
            <tr>
                <td>Mảng: </td>
                <td><input type="text" disabled="disabled" name="mang" size="30" value="<?php echo $mang;?>"></td>
            </tr>
            <tr>
                <td>Kết quả tìm kiếm: </td>
                <td><input type="text" disabled="disabled" name="kq" size="100" value="<?php echo $kq;?>"></td>
            </tr>
            <tr>
                <td colspan="2">(*) Các số được nhập cách nhau bằng dấu ","</td>
            </tr>
		</table>

        
	</form>
    <p align="left"><a href="?page=">Quay lại</a></p>

</body>
</html>
<?php $this->end(); ?>