<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Thông Tin</title>
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
		<!-- <?php
			if(isset($_POST['hoTen']))  
			    $hoTen=trim($_POST['hoTen']); 
			else $hoTen="";

			if(isset($_POST['diaChi'])) 
			    $diaChi=trim($_POST['diaChi']); 
			else $diaChi="";

			if(isset($_POST['sdt'])) 
			    $sdt=trim($_POST['sdt']); 
			else $sdt="";	

			if(isset($_POST['ghiChu'])) 
			    $ghiChu=trim($_POST['ghiChu']); 
			else $ghiChu="";
			
			if(isset($_POST['gui']))
			{
				if($sdt!="" && $hoTen!="" && $diaChi!=""){
					$action = "xulyThongtin.php";
				}
				else{
					$action = "";
					echo "Vui lòng kiểm tra lại và nhập đầy đủ thông tin!";
				}
			}
			else $action = "";
			
		?> -->
			<table>
			    <thead>
			        <th colspan="2" align="center"><h3>Bạn đã đăng nhập thành công, dưới đây là những thông tin bạn nhập</h3></th>
			    </thead>
			    <tr><td>Họ tên:</td>
			     <td><?php  echo $hoTen;?></td>
			    </tr>
			    <tr><td>Địa chỉ</td>
			     <td><?php  echo $diaChi;?></td>
			    </tr>
			    <tr><td>Số điện thoại</td>
			     <td><?php  echo $sdt;?></td>
			    </tr>
			    <tr><td>Giới tính:</td>
			     <td>
                    <?php
                        if($_POST['radGT']=='nam') echo "Nam";
                        else echo "Nữ";
                    ?>
			     </td>
			    </tr>
			    <tr><td>Quốc tịch:</td>
			     <td>
                    <?php
                        switch ($_POST['quocTich']) {
                            case "vn":
                                echo "Việt Nam";
                                break;
                            case "usa":
                                echo "Mỹ";
                                break;
                            case "cn":
                                echo "Tàu";
                                break;
                            case "lao":
                                echo "Lào";
                                break;
                        }
                    ?>
                 </td>
			    </tr>
			    <tr><td>Các môn đã học:</td>
			     <td>
                    <?php
                        if(isset($_POST['chk1'])) echo $_POST['chk1'] .", ";
                        if(isset($_POST['chk2'])) echo $_POST['chk2'] .", ";
                        if(isset($_POST['chk3'])) echo $_POST['chk3'] .", ";
                        if(isset($_POST['chk4'])) echo $_POST['chk4'];
                    ?>
			     </td>
			    </tr>
			    <tr><td>Ghi chú:</td>
			     <td><?php echo $ghiChu;?></td>
			    </tr>
			     <td colspan="2" align="center">
					<a href="javascript:window.history.back(-1);">Quay lại trang trước</a>
				</td>
			    </tr>
			</table>
	</body>
</html>
