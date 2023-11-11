<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Phép tính trên 2 số</title>
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
			else $a=0;
			if(isset($_POST['b'])) 
			    $b=trim($_POST['b']); 
			else $b=0;
	        if (is_numeric($a) && is_numeric($a) && isset($_POST['radPT']))  {
				switch ($_POST['radPT']) {
					case "cong":
						$ketqua = $a+$b;
						$phepTinh = "Cộng";
						break;
					case "tru":
						$ketqua = $a-$b;
						$phepTinh = "Trừ";
						break;
					case "nhan":
						$ketqua = $a*$b;
						$phepTinh = "Nhân";
						break;
					case "chia":
						$ketqua = $a/$b;
						$phepTinh = "Chia";
						break;
				}
			}
		    else {
		    	$phepTinh = "";
		    	$ketqua = "";
                echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
            }
		?>
		<form align='center' action="ketquapheptinh.php" method="post">
			<table>
			    <thead>
			        <th colspan="2" align="center"><h3>PHÉP TÍNH TRÊN HAI SỐ</h3></th>
			    </thead>
			    <tr><td>Chọn phép tính:</td>
			     <td>
			     	<?php echo $phepTinh;?>
			     </td>
			    </tr>
			    <tr><td>Số thứ nhất:</td>
			     <td><input type="text" name="a" value="<?php  echo $a;?> "/></td>
			    </tr>
			    <tr><td>Số thứ hai:</td>
			     <td><input type="text" name="b" value="<?php  echo $b;?> "/></td>
			    </tr>
			    <tr><td>Kết quả:</td>
			     <td><input type="text" name="ketqua" value="<?php  echo $ketqua;?> "/></td>
			    </tr>
			     <td  colspan="2" align="center"><a href="javascript:window.history.back(-1);">Quay lại trang trước</a></td>
			    </tr>
			</table>
		</form>
		<p align="left"><a href="?page=">Quay lại</a></p>
	</body>
</html>
<?php $this->end(); ?>