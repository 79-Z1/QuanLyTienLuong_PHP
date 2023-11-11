<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Nhập Thông Tin</title>
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
			
			// if(isset($_POST['gui']))
			// {
			// 	if($sdt!="" && $hoTen!="" && $diaChi!=""){
			// 		$action = "?page=TNT-form-xu-ly-TT";
			// 	}
			// 	else{
			// 		$action = "";
			// 		echo "Vui lòng kiểm tra lại và nhập đầy đủ thông tin!";
			// 	}
			// }
			// else $action = "";
			
		?>
		<form align='center' action="?page=TNT-form-xu-ly-TT" method="post">

			<table>
			    <thead>
			        <th colspan="2" align="center"><h3>NHẬP VÀO THÔNG TIN CỦA BẠN</h3></th>
			    </thead>
			    <tr><td>Họ tên:</td>
			     <td><input type="text" name="hoTen" value="<?php  echo $hoTen;?> "/></td>
			    </tr>
			    <tr><td>Địa chỉ</td>
			     <td><input type="text" name="diaChi" value="<?php  echo $diaChi;?> "/></td>
			    </tr>
			    <tr><td>Số điện thoại</td>
			     <td><input type="text" name="sdt" value="<?php  echo $sdt;?> "/></td>
			    </tr>
			    <tr><td>Giới tính:</td>
			     <td>
			     	<input type="radio" name="radGT" value="nam" 
						<?php if(isset($_POST['radGT'])&&$_POST['radGT']=='nam') echo 'checked="checked"';?> checked/>Nam
			     	<input type="radio" name="radGT" value="nu"
					 	<?php if(isset($_POST['radGT'])&&$_POST['radGT']=='nu') echo 'checked="checked"';?> />Nữ

			     </td>
			    </tr>
			    <tr><td>Quốc tịch:</td>
			     <td><select name="quocTich">
						<option value="vn" <?php if(isset($_POST['quocTich'])&& $_POST['quocTich']=='vn') echo 'selected';?> selected>
							Việt Nam
						</option>
						<option value="usa <?php if(isset($_POST['quocTich'])&& $_POST['quocTich']=='usa') echo 'selected';?>">
							Mỹ
						</option>
						<option value="cn" <?php if(isset($_POST['quocTich'])&& $_POST['quocTich']=='cn') echo 'selected';?>>
							Tàu
						</option>
						<option value="lao" <?php if(isset($_POST['quocTich'])&& $_POST['quocTich']=='lao') echo 'selected';?>>
							Lào	
						</option>
					</select></td>
			    </tr>
			    <tr><td>Các môn đã học:</td>
			     <td>
				 <input type="checkbox" name="chk1" value="PHP & MySQL" 
					<?php if(isset($_POST['chk1'])&& $_POST['chk1']=='PHP & MySQL') echo 'checked'; else echo ""?>/>PHP & MySQL 
				<input type="checkbox" name="chk2" value="C#"
					<?php if(isset($_POST['chk2'])&& $_POST['chk2']=='C#') echo 'checked'; else echo ""?>/>C#
				<input type="checkbox" name="chk3" value="XML"
					<?php if(isset($_POST['chk3'])&& $_POST['chk3']=='XML') echo 'checked'; else echo ""?>/>XML
				<input type="checkbox" name="chk4" value="Python"
					<?php if(isset($_POST['chk4'])&& $_POST['chk4']=='Python') echo 'checked'; else echo ""?>/>Python
			     </td>
			    </tr>
			    <tr><td>Ghi chú:</td>
			     <td><textarea name="ghiChu" rows="3" cols="40"><?php echo $ghiChu;?></textarea></td>
			    </tr>
			     <td colspan="2" align="center">
					<input type="submit" value="Gửi" name="gui" />
					<input type="reset" value="Hủy" name="huy" />
				</td>
			    </tr>
			</table>
		</form>
	</body>
</html>
<?php $this->end(); ?>