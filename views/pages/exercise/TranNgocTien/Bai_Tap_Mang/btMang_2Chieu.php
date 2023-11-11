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
		
        if(isset($_POST['m']))  
		    $m=trim($_POST['m']); 
		else $m=""; 
        if(isset($_POST['n']))  
		    $n=trim($_POST['n']); 
		else $n=""; 
        
        $kq = "";

        function showArray($matran){
            $ketqua = "";
            foreach($matran as $hang){
                $ketqua .=  "\n";
                foreach($hang as $cot){
                    $ketqua .= "$cot ";
                }
            }
            return $ketqua;
        }

        function dongChanCotLe($arr){
            $ketqua = "";
            foreach($arr as $soHang => $hang){
                if($soHang %2 == 0){
                    foreach($hang as $soCot => $cot){
                        if($soCot %2 != 0 ){
                            $ketqua .= "$cot ";
                        }
                    }
                }
            }
            return $ketqua;
        }

        function tongBoiCua10($arr){
            $ketqua = 0;
            foreach($arr as $soHang => $hang){
                foreach($hang as $soCot => $cot){
                    if($cot %10 == 0 ){
                        $ketqua += $cot;
                    }
                }
            }
            return $ketqua;
        }

		if(isset($_POST['xuLy'])){
            if(is_numeric($m) && is_numeric($n)){
                $matrix = array();
                for ($i=0; $i < $m; $i++) { 
                    for ($j=0; $j < $n; $j++) { 
                        $matrix[$i][$j] = rand(-1000,1000);
                    }
                }
                $kq .= showArray($matrix);
                $kq .= "\nPhần tử ở dòng chẵn cột lẻ: " . dongChanCotLe($matrix);
                $kq .= "\nTổng các phần tử là bội của 10: " . tongBoiCua10($matrix);

            }
            else echo "Vui lòng nhập đúng";
        }
		
	?>
	<form action="" method="post">
		<table border="0" cellpadding="0">
			<th colspan="2"><h2>Mảng 2 chiều</h2></th>
            <tr>
                <td>Nhập m:</td>
                <td><input type="text" name="m" size="5" value="<?php echo $m;?>"></td>
            </tr>
            <tr>
                <td>Nhập n:</td>
                <td><input type="text" name="n" size="5" value="<?php echo $n;?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="xuLy"  size="20" value="Thực hiện"/></td>
            </tr>
            <tr>
                <td>Kết quả: </td>
                <td><textarea name="kq" id="" cols="30" rows="10"><?php echo $kq?></textarea></td>
            </tr>
		</table>

        
	</form>
    <p align="left"><a href="?page=">Quay lại</a></p>

</body>
</html>
<?php $this->end(); ?>