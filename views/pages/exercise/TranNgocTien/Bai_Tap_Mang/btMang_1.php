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
		else $n=0;            

		$kq = "";

		if(isset($_POST['xuLy']))
		if (is_numeric($n) && $n > 0)  {
			$matrix = array();
			for ($i=0; $i < $n ; $i++) { 
				$matrix[$i] =  rand(-200,200);
			}

			function showArray($arr){
				$kp = "Ma trận có độ dài n là: \n";
				 
				echo "<h2>Ma trận có độ dài n là: </h2>";
				echo '<table border="1">';
				echo "<tr>";
				foreach ($arr as $value) {
					echo "<td>$value</td>";
				}
				echo "</tr>";
				echo "</table>";
			}

			function countSoChan($arr){
				$count = 0;
				foreach ($arr as $value) {
					if($value%2==0){
						$count++;
					}
				}
				return $count;
			}

			function countBeHon100($arr){
				$count = 0;
				foreach ($arr as $value) {
					if($value<100){
						$count++;
					}
				}
				return $count;
			}

			function sumAm($arr){
				$sum = 0;
				foreach ($arr as $value) {
					if($value<0){
						$sum+=$value;
					}
				}
				return $sum;
			}

			function showIndex0KeCuoi($arr){
				echo "<h2>Vị trí các phần tử có số 0 kề cuối là: </h2>";
                echo '<table border="1">';
				echo "<tr>";
				foreach ($arr as $key => $value) {
					if($value >=10 || $value <= -10){
                        $value=(int)($value/10);
                        $tach = $value%10;
                        if($tach == 0){
                            echo "<td>$key</td>";
                        }
                    }
				}
                echo "</tr>";
				echo "</table>";
			}

            function sortArray($arr){
                sort($arr);
				echo "<h2>Ma trận sau khi sắp xếp theo thứ tự tăng dần là: </h2>";
				echo '<table border="1">';
				echo "<tr>";
				foreach ($arr as $value) {
					echo "<td>$value</td>";
				}
				echo "</tr>";
				echo "</table>";
			}


			showArray($matrix);
			echo "<h2>Số lượng phần tử là số chẵn có trong mảng là: " . countSoChan($matrix) ."</h2>";
			echo "<h2>Số lượng phần tử là số nhỏ hơn 100 là: " . countBeHon100($matrix) ."</h2>";
			echo "<h2>Tổng các phần tử là số âm là: " . sumAm($matrix) ."</h2>";
			showIndex0KeCuoi($matrix);
            sortArray($matrix);

		}
		else {
		$matrix = array();
		echo "<font color='red'>Vui lòng nhập vào số > 0</font>"; 
		}
	?>
	<form action="" method="post">
		<table border="0" cellpadding="0">
			<th colspan="2"><h2>Một số thao tác trên mảng</h2></th>
			<tr>
				<td>
					Nhập n 
				</td>
				<td>
					<input type="text" name="n" size="30" value="<?php echo $n;?>">
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="xuLy"  size="20" value="Xử lý"/></td>
			</tr>
			<tr>
				<td colspan="2"><textarea cols="100" rows="10" name="ketqua"> <?php echo $kq?></textarea></td>
			</tr>
		</table>
	</form>
</body>
</html>
