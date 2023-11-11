<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<style type="text/css">

table {
    background: #ffd94d;
    border: 0 solid yellow;
}

thead {
    background: #fff14d;
}

td {
    color: blue;
}

h3 {
    font-family: verdana;
    text-align: center;
    /* text-anchor: middle; */
    color: #ff8100;
    font-size: medium;
}
</style>
<?php 
    function taoMang($dodai) {
        $randomArr = array();
        for ($i=0; $i < $dodai; $i++) { 
            $randomArr[] = rand(-100, 200);
        }
        return $randomArr;
    }
    function demSoChan($mang) {
        $dem = 0;
        for ($i=0; $i < count($mang); $i++) { 
            if($mang[$i] % 2 === 0) {
                $dem++;
            }
        }
        return $dem;
    }
    
    function demSoNhoHon100($mang) {
        $dem = 0;
        for ($i=0; $i < count($mang); $i++) { 
            if($mang[$i] < 100) {
                $dem++;
            }
        }
        return $dem;
    }
    function tongSoAm($mang) {
        $tong = 0;
        for ($i=0; $i < count($mang); $i++) { 
            if($mang[$i] < 0) {
                $tong += $mang[$i];
            }
        }
        return $tong;
    }

    function viTriKeCuoiLa0($mang) {
        $arr = array();
        for ($i=0; $i < count($mang); $i++) { 
            if($mang[$i] >= 100) {
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
if(isset($_POST['n']))  
    $n=trim($_POST['n']); 
else $n=0;
if(isset($_POST['sochan']))  
    $sochan=trim($_POST['sochan']); 
else $sochan=0;
if(isset($_POST['sonhohon100']))  
    $sonhohon100=trim($_POST['sonhohon100']); 
else $sonhohon100=0;
if(isset($_POST['tongsoam']))  
    $tongsoam=trim($_POST['tongsoam']); 
else $tongsoam=0;
if(isset($_POST['vitrikecuoila0']))  
    $vitrikecuoila0=trim($_POST['vitrikecuoila0']); 
else $vitrikecuoila0= array();
if(isset($_POST['mang']))  
    $mang=trim($_POST['mang']); 
else $mang=array();
if(isset($_POST['xuly']))
        if (is_numeric($n)){
            $mang = taoMang($n);
            $sochan = demSoChan($mang);
            $sonhohon100 = demSoNhoHon100($mang);
            $tongsoam = tongSoAm($mang);
            $vitrikecuoila0 = viTriKeCuoiLa0($mang);
        } 
        else {
            echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
            $n=0;
        }
else $n=0;
?>
<form align='center' action="" method="post">
    <table>
        <thead>
            <th colspan="2" align="center">
                <h3>MẢNG SỐ NGUYÊN</h3>
            </th>
        </thead>
        <tr>
            <td>Nhập n:</td>
            <td><input type="text" name="n" value="<?php  echo $n;?> " /></td>
        </tr>
        <tr>
            <td>Kết quả:</td>
            <td>
                    <?php 
                        for ($i=0; $i < count($mang); $i++) { 
                            echo $mang[$i] . " ";
                        } 
                    ?>
            </td>
        </tr>
        <tr>
            <td>Đếm số chẵn:</td>
            <td><input type="text" name="sochan" value="<?php  echo $sochan;?> " /></td>
        </tr>
        <tr>
            <td>Đếm số < 100:</td>
            <td><input type="text" name="sonhohon100" value="<?php  echo $sonhohon100;?> " /></td>
        </tr>
        <tr>
            <td>Tổng số âm:</td>
            <td><input type="text" name="tongsoam" value="<?php  echo $tongsoam;?> " /></td>
        </tr>
        <tr>
            <td>Vị trí kề cuối là 0:</td>
            <td><input type="text" name="vitrikecuoila0" value="<?php  
                for ($i=0; $i < count($vitrikecuoila0); $i++) { 
                    echo $vitrikecuoila0[$i] . " ";
                } 
            ?> " /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Xử lý" name="xuly" /></td>
        </tr>
    </table>
</form>
<?php $this->end(); ?>
