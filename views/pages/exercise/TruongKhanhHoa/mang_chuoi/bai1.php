<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Tinh chu vi va dien tich</title>
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
    function tao_mang($n) {
        $arr = array();
        for ($i=0; $i < $n; $i++) { 
            $arr[] = rand(-100, 200);
        }
        return $arr;
    } 
    function dem_chan($arr) {
        $dem = 0;
        foreach ($arr as $value) {
            if($value % 2 == 0) $dem++;
        }
        return $dem;
    }

    function dem_nho_hon_100($arr) {
        $dem = 0;
        foreach ($arr as $value) {
            if($value < 100) $dem++;
        }
        return $dem;
    }

    function viTriKeCuoiLa0($mang) {
        $arr = array();
        for ($i=0; $i < count($mang); $i++) { 
            if(count($mang[$i]) > 2) {
                $string = strval($mang[$i]);
                if(substr($string,strlen($string)-2, strlen($string)-2) == 0) {
                    $arr[] = $i;
                }
            }
        }
        return $arr;
    }
?>
<?php
    $ketqua = "";
    if (isset($_POST['so'])) 
        $so = $_POST['so'];
    else $so = "";
    if(isset($_POST['xuly'])) {
        if (is_numeric($so)) {
            $arr = tao_mang($so);
            $str = implode(" ", $arr);
            $ketqua = "Mảng được tạo ra là: " . $str;        
            $ketqua .= "\nSố lượng số chẵn: " . dem_chan($arr);        
            $ketqua .= "\nSố lượng số < 100: " . dem_nho_hon_100($arr);        
        } else {
            echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
            $so=0;
        }
    }
?>
<form action="" method="post">
<fieldset>
	<legend>Bài 1</legend>
	<table border='0'>
		<tr>
			<td>Nhập số:</td>
			<td><input type="text"  name="so" value="<?php if(isset($_POST['so'])) echo $_POST['so'];?>"/></td>
		</tr>
		<tr><td>Kết quả:</td>
			<td><textarea name="ketqua" cols="70" rows="4" disabled="disabled"><?php echo $ketqua;?></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="xuly" value="Xử lý"/></td>
		</tr>
	</table>
</fieldset>
</form>
</body>
</html>