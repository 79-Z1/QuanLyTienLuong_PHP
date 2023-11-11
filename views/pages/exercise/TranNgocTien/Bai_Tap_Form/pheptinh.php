<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Phép tinh trên 2 số</title>
	    <style type="text/css">
	        /*body {  
	            background-color: #d24dff;
	        }*/
	        table{
	            background: #ffd94d;
	            border: 0 solid yellow;
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
			if(isset($_POST['a']))  
			    $a=trim($_POST['a']); 
			else $a="";
			if(isset($_POST['b'])) 
			    $b=trim($_POST['b']); 
			else $b="";	

			
		?>
		<form align='center' action="ketquapheptinh.php" method="post">
			<table>
			    <thead>
			        <th colspan="2" align="center"><h3>PHÉP TÍNH TRÊN HAI SỐ</h3></th>
			    </thead>
			    <tr><td>Chọn phép tính:</td>
			     <td>
			     	<input type="radio" name="radPT" value="cong" checked/>Cộng
			     	<input type="radio" name="radPT" value="tru" />Trừ
			     	<input type="radio" name="radPT" value="nhan" />Nhân
			     	<input type="radio" name="radPT" value="chia" />Chia
			     </td>
			    </tr>
			    <tr><td>Số thứ nhất:</td>
			     <td><input type="text" name="a" value="<?php  echo $a;?> "/></td>
			    </tr>
			    <tr><td>Số thứ hai:</td>
			     <td><input type="text" name="b" value="<?php  echo $b;?> "/></td>
			    </tr>
			     <td  colspan="2" align="center"><input type="submit" value="Tính" name="tinh" /></td>
			    </tr>
			</table>
		</form>
	</body>
</html>
