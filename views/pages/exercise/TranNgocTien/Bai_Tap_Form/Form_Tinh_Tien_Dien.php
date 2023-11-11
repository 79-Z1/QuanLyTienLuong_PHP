
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
			if(isset($_POST['tenCH']))  
			    $tenCH=trim($_POST['tenCH']); 
			else $tenCH="";
			if(isset($_POST['chiSoCu'])) 
			    $chiSoCu=trim($_POST['chiSoCu']); 
			else $chiSoCu="";	
			if(isset($_POST['chiSoMoi'])) 
			    $chiSoMoi=trim($_POST['chiSoMoi']); 
			else $chiSoMoi="";
			if(isset($_POST['donGia'])) 
			    $donGia=trim($_POST['donGia']); 
			else $donGia=20000;
			if(isset($_POST['tinh']))
		        if (is_numeric($chiSoCu) && is_numeric($chiSoMoi) && is_numeric($donGia) )  {
		        	 $tienTT = ($chiSoMoi - $chiSoCu) * $donGia; 
		        }
		        else {
                echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
                $tienTT="";
            	}
			else $tienTT=0;  
		?>
		<form align='center' action="" method="post">
			<table>
			    <thead>
			        <th colspan="2" align="center"><h3>THANH TOÁN TIỀN ĐIỆN</h3></th>
			    </thead>
			    <tr><td>Tên chủ hộ:</td>
			     <td><input type="text" name="tenCH" value="<?php  echo $tenCH;?> "/></td>
			    </tr>
			    <tr><td>Chỉ số cũ:</td>
			     <td><input type="text" name="chiSoCu" value="<?php  echo $chiSoCu;?> "/> (Kw)</td>
			    </tr>
			    <tr><td>Chỉ số mới:</td>
			     <td><input type="text" name="chiSoMoi" value="<?php  echo $chiSoMoi;?> "/> (Kw)</td>
			    </tr>
			    <tr><td>Đơn giá:</td>
			     <td><input type="text" name="donGia" value="<?php  echo $donGia;?> "/> (VNĐ)</td>
			    </tr>
			    <tr><td>Số tiền thanh toán:</td>
			     <td><input type="text" name="tienTT" disabled="disable" value="<?php  echo $tienTT;?> "/> (VNĐ)</td>
			    </tr>
			    <tr>
			     <td  colspan="2" align="center"><input type="submit" value="Tính" name="tinh" /></td>
			    </tr>
			</table>
		</form>
	</body>
</html>

