
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>tinh dien tich HCN</title>
	    <style type="text/css">
	        body {  
	            background-color: #d24dff;
	        }
	        table{
	            background: #ffd94d;
	            border: 0 solid yellow;
	        }
	        thead{
	            background: #fff14d;    

	        }
	        td {
	            color: blue;

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
		if(isset($_POST['a']))  
		    $a=trim($_POST['a']); 
		else $a="";
		if(isset($_POST['b'])) 
		    $b=trim($_POST['b']); 
		else $b="";		            
		?>
		<form align='center' action="" method="post">
			<table>
			    <thead>
			        <th colspan="2" align="center"><h3>TÍNH CHU VI DIỆN TÍCH CÁC HÌNH HỌC CƠ BẢN</h3></th>
			    </thead>
			    <tr><td>Nhập a:</td>
			     <td><input type="text" name="a" value="<?php  echo $a;?> "/></td>
			    </tr>
			    <tr><td>Nhập b:</td>
			     <td><input type="text" name="b" value="<?php  echo $b;?> "/></td>
			    </tr>
			    <tr>
			     <td  colspan="2" align="center"><input type="submit" value="Xử lý" name="tinh" /></td>
			    </tr>
			</table>
		</form>
		<?php 
			if(isset($_POST['tinh']))
	        if (is_numeric($a) && is_numeric($b))  {
	        	switch ($a) {
					case 1:
						echo "Chu vi hình vuông cạnh độ dài $b là: " . 4*$b;
						echo "<br>Diện tích hình vuông cạnh độ dài $b là: " . $b*$b;
						break;
					case 2:
						define("PI", 3.1415);
						echo "Chu vi hình tròn bán kính $b là: " . 2*PI*$b;
						echo "<br>Diện tích hình tròn bán kính $b là: " . round(PI*pow($b,2),2);
						break;
					case 3:
						$p = ($b*3)/2;
						echo "Chu vi hình tam giác đều độ dài cạnh $b là: " . $b*3;
						echo "<br>Diện tích hình tam giác đều độ dài cạnh $b là: " . round(sqrt($p*3*($p-$b)),2);
						break;
					case 4:
						$p = ($b*3)/2;
						echo "Chu vi hình chữ nhật có độ dài 2 cạnh $a và $b là: " . ($a+$b)*2;
						echo "<br>Diện tích hình chữ nhật có độ dài 2 cạnh $a và $b là: " . $a*$b;
						break;
				}
	        }
		?>
	</body>
</html>
