<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
fieldset {
  background-color: #eeeeee;
}

legend {
  background-color: gray;
  color: white;
  padding: 5px 10px;
}

input {
  margin: 5px;
}
</style>

</head>

<body>
<?php 
    function check_valid($num) {
        if($num >= 2 && $num <= 5) return true;
        return false;
    }

    function tao_ma_tran($m, $n) {
        $matrix = array();
        for ($i=0; $i < $m; $i++) { 
            for ($j=0; $j < $n; $j++) { 
                $matrix[$i][$j] = rand(-1000, 1000);
            }
        }
        return $matrix;
    } 

    function in_ma_tran($matrix) {
        $str = '';
        foreach($matrix as $hang_index => $hang) {
            foreach($hang as $cot_index => $cot) {
                $str .= "$cot ";
            }
            $str .= "\n";
        }
        return $str;
    }

    function hang_chan_cot_le($matrix) {
        $str = '';
        foreach($matrix as $hang_index => $hang) {
            foreach($hang as $cot_index => $cot) {
                if($hang_index % 2 == 0 && $cot_index % 2 != 0) {
                    $str .= "$cot ";
                }
            }
        }
        return $str;
    }
    
?>
<?php
    $ketqua = "";
    if (isset($_POST['m'])) 
        $m = $_POST['m'];
    else $m = "";
    if (isset($_POST['n'])) 
        $n = $_POST['n'];
    else $n = "";
    if(isset($_POST['xuly'])) {
        if (is_numeric($m) && is_numeric($n)) {
            if(check_valid($m) && check_valid($n)) {
                $matrix = tao_ma_tran($m, $n);
                $ketqua .= "Ma trận được tạo ra là: \n" . in_ma_tran($matrix);      
                $ketqua .= "Phàn tử tại hàng chẵn cột lẻ là: " . hang_chan_cot_le($matrix);      
            }  else {
                echo "<font color='red'>Vui lòng nhập vào 2 <= m & n <= 5 </font>"; 
            }
        } else {
            echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
            $so=0;
        }
    }
?>
<form action="" method="post">
<fieldset>
	<legend>Mảng 2 chiều</legend>
	<table border='0'>
		<tr>
			<td>Nhập số m:</td>
			<td><input type="text"  name="m" value="<?php if(isset($_POST['m'])) echo $_POST['m'];?>"/></td>
		</tr>
        <tr>
			<td>Nhập số n:</td>
			<td><input type="text"  name="n" value="<?php if(isset($_POST['n'])) echo $_POST['n'];?>"/></td>
		</tr>
		<tr><td>Kết quả:</td>
			<td><textarea name="ketqua" cols="70" rows="8" disabled="disabled"><?php echo $ketqua;?></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="xuly" value="Xử lý"/></td>
		</tr>
	</table>
</fieldset>
</form>
</body>
</html>