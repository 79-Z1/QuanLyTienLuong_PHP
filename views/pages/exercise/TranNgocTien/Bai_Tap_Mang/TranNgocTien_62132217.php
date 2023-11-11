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
                padding: 10;
	            color: black;

	        }
	        h3{
	            font-family: verdana;
	            text-align: start;
	            /* text-anchor: middle; */
	            color: #ff8100;
	            font-size: large;
	        }
	    </style>
	</head>
	<body>
		<?php
        $SinhVien = array();
            // $SinhVien = array(
            //     "6212341" => array(
            //         "maLop" => "62.CNTT-1",
            //         "hoTen" => "Nguyễn Minh Anh",
            //         "gioiTinh" => "Nữ",
            //         "ngaySinh" => "2002-08-09",
            //     ),
            //     "6210123" => array(
            //         "maLop" => "62.CNTT-1",
            //         "hoTen" => "Trần Anh Tú",
            //         "gioiTinh" => "Nam",
            //         "ngaySinh" => "2002-05-21",
            //     ),
            //     "6211012" => array(
            //         "maLop" => "62.CNTT-3",
            //         "hoTen" => "Nguyễn Ngọc Thanh",
            //         "gioiTinh" => "Nữ",
            //         "ngaySinh" => "2002-02-30",
            //     ),
            //     "6211123" => array(
            //         "maLop" => "62.CNTT-3",
            //         "hoTen" => "Lê Phương Thảo",
            //         "gioiTinh" => "Nữ",
            //         "ngaySinh" => "2001-10-15",
            //     ),
            // );
            
            function inDSSV($arr){
                $fp = @fopen('./TranNgocTien_62132217.dat',"r");
                if(!$fp){
                    echo "Mở file không thành công";
                }
                else{
                    while(!feof($fp)){
                        $importSV = fgets($fp);
                        // $ttsv = explode(",",$importSV);
                        // $arr[$ttsv[1]] = array(
                        //     "maLop" => $ttsv[0],
                        //     "hoTen" => $ttsv[2],
                        //     "gioiTinh" => $ttsv[3],
                        //     "ngaySinh" => $ttsv[4],
                        // );
                    }
                    fclose($fp);
                }
                echo '<table border="1">
                <thead>
			        <th align="center">Mã lớp</th>
                    <th align="center">Mã SV</th>
                    <th align="center">Họ tên SV</th>
                    <th align="center">Giới tính</th>
                    <th align="center">Ngày sinh</th>
			    </thead>';
                foreach($arr as $mssv => $sinhViens){
                    echo '<tr>';
                    echo "<td>$mssv</td>";
                    foreach($sinhViens as $sv){
                        echo "<td>$sv</td>";
                    }
                    echo '</tr>';
                }
                echo '</table>';
            }
            
            function kiemTraNgaySinh($ngaySinh){
                $ns = explode("-",$ngaySinh);
                if(strlen($ns[0]) != 4 
                    || strlen($ns[1]) != 2 
                    || strlen($ns[2]) != 2 
                    || $ns[1] > 12 || $ns[1] < 1
                    || $ns[2] > 31 || $ns[1] < 1){
                    return false;
                }
                else return true;
            }

			if(isset($_POST['hoTen']))  
			    $hoTen=trim($_POST['hoTen']); 
			else $hoTen="";

			if(isset($_POST['mssv'])) 
			    $mssv=trim($_POST['mssv']); 
			else $mssv="";

			if(isset($_POST['ngaySinh'])) 
			    $ngaySinh=trim($_POST['ngaySinh']); 
			else $ngaySinh="";



			if(isset($_POST['them']))
			{
				if($mssv!="" && $hoTen!="" && $ngaySinh!="" && kiemTraNgaySinh($ngaySinh)){
                    if($_POST['radGT']=='nam') $gioiTinh = "Nam";
                        else $gioiTinh = "Nữ";
					$SinhVien["$mssv"] = array(
                        "maLop" => $_POST['maLop'],
                        "hoTen" => $hoTen,
                        "gioiTinh" => $gioiTinh,
                        "ngaySinh" => $ngaySinh,
                    );
				}
                if($mssv=="") echo "Vui lòng không để trống mã sinh viên!<br>";
                if($hoTen=="") echo "Vui lòng không để trống họ tên!<br>";
                if($ngaySinh=="") echo "Vui lòng không để trống ngày sinh!<br>";
                if(!kiemTraNgaySinh($ngaySinh)){
                    echo "Vui lòng nhập ngày sinh đúng định dạng yyyy-mm-dd !<br>";
                }
			}

            if(isset($_POST['luu'])){
                $fp = @fopen("./TranNgocTien_62132217.dat","a+");
                if(!$fp){
                    echo "Mở file không thành công";
                }
                else{
                    if($_POST['radGT']=='nam') $gioiTinh = "Nam";
                        else $gioiTinh = "Nữ";

                    $ttsv = "\n" . $_POST['maLop'] . ",";
                    $ttsv .= "$mssv,";
                    $ttsv .= "$hoTen,";
                    $ttsv .= "$gioiTinh,";
                    $ttsv .= "$ngaySinh";
                    fwrite($fp,$ttsv);
                    fclose($fp);
                }
            }
			
		?>
		<form align='center' action="" method="post">
			<table>
			    <thead>
			        <th colspan="2" align="center"><h3>NHẬP VÀO THÔNG TIN CỦA SINH VIÊN</h3></th>
			    </thead>
                <tr><td>Mã SV</td>
			     <td><input type="text" name="mssv"  value="<?php  echo $mssv;?> "/></td>
			    </tr>
			    <tr><td>Họ tên SV</td>
			     <td><input type="text" name="hoTen" value="<?php  echo $hoTen;?> "/></td>
			    </tr>
			    <tr><td>Ngày sinh</td>
			     <td><input type="text" name="ngaySinh" value="<?php  echo $ngaySinh;?> "/></td>
			    </tr>
			    <tr><td>Giới tính</td>
			     <td>
			     	<input type="radio" name="radGT" value="nam" 
						<?php if(isset($_POST['radGT'])&&$_POST['radGT']=='nam') echo 'checked="checked"';?> checked/>Nam
			     	<input type="radio" name="radGT" value="nu"
					 	<?php if(isset($_POST['radGT'])&&$_POST['radGT']=='nu') echo 'checked="checked"';?> />Nữ

			     </td>
			    </tr>
			    <tr><td>Mã lớp</td>
			     <td><select name="maLop">
						<option value="62.CNTT-1" <?php if(isset($_POST['maLop'])&& $_POST['maLop']=='62.CNTT-1') echo 'selected';?>>
                        62.CNTT-1
						</option>
						<option value="62.CNTT-2" <?php if(isset($_POST['maLop'])&& $_POST['maLop']=='62.CNTT-2') echo 'selected';?>>
                        62.CNTT-2
						</option>
						<option value="62.CNTT-3" <?php if(isset($_POST['maLop'])&& $_POST['maLop']=='62.CNTT-3') echo 'selected';?>>
                        62.CNTT-3
						</option>
					</select></td>
			    </tr>
			     <td></td>
                <td>
                    <input type="submit" value="Thêm SV" name="them" />
					<input type="submit" value="Lưu SV vào file" name="luu" />
				</td>
			    </tr>
			</table>
            <h3>Danh sách sinh viên</h3>
            <?php echo inDSSV($SinhVien);?>
		</form>
	</body>
</html>

<?php
    
?>
<?php $this->end(); ?>