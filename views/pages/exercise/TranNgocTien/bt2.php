
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>tinh dien tich HCN</title>
	    <style type="text/css">
	        /*body {  
	            background-color: #d24dff;
	        }*/
	        table{
				text-align: center;
	            background: #ffd94d;
	            border: 0 solid yellow;
				border-collapse: collapse;
	        }
	        thead{
	            background: #fff14d;    

	        }
	        td {
	            color: black;

	        }
	        h3{
	            font-family: verdana;
	            text-align: center;
	            /* text-anchor: middle; */
	            color: #ff8100;
	            font-size: medium;
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
		?>
		<form align='center' action="" method="post">
			<table>
			    <thead>
			        <th colspan="2" align="center"><h3>Bài 2</h3></th>
			    </thead>
			    <tr><td>M</td>
			     <td><input type="text" name="m" value="<?php  echo $m;?> "/></td>
			    </tr>
			    <tr><td>N</td>
			     <td><input type="text" name="n" value="<?php  echo $n;?> "/></td>
			    </tr>
			     <td  colspan="2" align="center"><input type="submit" value="Tính" name="tinh" /></td>
			    </tr>
			</table>
			
		</form>
		<?php
			if(isset($_POST['tinh']))
			if (is_numeric($m) && is_numeric($n) && $m > 1  && $m < 6 && $n > 1  && $n < 6 )  {
				$matrix = array();
				for ($i=0; $i < $m; $i++) { 
					for ($j=0; $j < $n ; $j++) { 
						$matrix[$i][$j] =  rand(-100,100);
					}
				}
				echo "<h2>Ma trận có M hàng và N cột là: </h2>";
				echo '<table border="1" width="200" height="200">';
				foreach ($matrix as $hangs => $hang) {
					echo "<tr>";
					foreach ($hang as $cots => $cot) {
						echo "<td>$cot</td>";
					}
					echo "</tr>";
				}
				echo "</table>";

				for ($i=0; $i < $m; $i++) { 
					for ($j=0; $j < $n ; $j++) { 
						if($matrix[$i][$j] < 0){
							$matrix[$i][$j] =  0;
						}
					}
				}

				echo "<h2>Ma trận trên sau khi thay các phần tử âm thành 0: </h2>";
				echo '<table border="1" width="200" height="200">';
				foreach ($matrix as $hangs => $hang) {
					echo "<tr>";
					foreach ($hang as $cots => $cot) {
						echo "<td>$cot</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
			}
			else {
			$matrix = array();
			echo "<font color='red'>Vui lòng nhập vào số từ 2->5 </font>"; 
			}
		?>
	</body>
</html>

