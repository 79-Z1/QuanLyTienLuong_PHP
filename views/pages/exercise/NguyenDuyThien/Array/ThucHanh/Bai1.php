<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Thao tac tren mang</title>

<style type="text/css">
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
    function tao_mang($n){
        $arr = array();
            for($i = 0; $i < $n; $i++){
                $arr[$i] = rand(100,100000);
            }
        return $arr;
    }
    function hien_thi_mang($arr){
        for($i = 0; $i < count($arr); $i++){
            echo "$arr[$i]  ";
        }
    }
    function dem_so_chan($arr){
        $dem = 0;
        for($i = 0; $i < count($arr); $i++)
            if($arr[$i] % 2 == 0)
               $dem++;
        return $dem;
    }
    function be_hon_mottram($arr){
        $dem = 0;
        for($i = 0; $i < count($arr); $i++)
            if($arr[$i] < 100)
            $dem++;
        return $dem;
    }
    function tong_so_am($arr){
        $tong = 0;
        for($i = 0; $i < count($arr); $i++)
            if($arr[$i] < 0)
            $tong += $arr[$i];
        return $tong;
    }
    function vi_tri_0_ke_cuoi($arr){
        $str = "";
        for($i = 0; $i < count($arr); $i++){
            if( $arr[$i] % 100 >= 0 && $arr[$i] % 100 < 9){
                $str .= "\nSo $arr[$i] o vi tri $i";
            }
        }
        return $str;
    }
    function sap_xep($arr){
        $a = array();
        for($i = 0; $i < count($arr); $i++){
            if($arr[$i] % 100 >= 0 && $arr[$i] % 100 < 10){
                $a[$i] = $arr[$i];
            }
        }
        sort($a);
        $str = implode(' ', $a);
        return $str;
    }
    if(isset($_POST['n']))
    $n = trim($_POST['n']);
    else
    $n = 0;

    $ketqua = "";

    if(isset($_POST['tinh']) && $n > 0 && is_numeric($n)){
            $a = tao_mang($n);
            $str = implode(' ', $a);
            $ketqua = "Mang duoc tao ra la:" . $str;
            $ketqua .= "\nSo phan tu chan trong mang la:";
            $ketqua .= dem_so_chan($a);
            $ketqua .= "\nSo phan tu be hon 100 trong mang la:";
            $ketqua .= be_hon_mottram($a);
            $ketqua .= "\nTong cac so am trong mang la:";
            $ketqua .= tong_so_am($a);
            $ketqua .= vi_tri_0_ke_cuoi($a);
            $ketqua .= "\nSap xep tang dan cac so co so ke cuoi la 0 trong mang la:";
            $ketqua .= sap_xep($a);
        }
    else 
?>

<form action="" method="post">

<fieldset>

	<legend>Các thao tác trên mảng</legend>

	<table border="0" cellpadding="0">

    <tr>
        <td>Nhập n:</td>
        <td><input type="text" name="n" size= "70" value="<?php echo $n;?>"/></td>
    </tr>
    <tr>
        <td>Kết quả: </td>
        <td>
        <textarea name="ketqua" rows = "8" cols = "70" ><?php echo $ketqua;?></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input class="btn btn-success" type="submit" name="tinh"  size="20" value="Xử lý"/></td>
    </tr>
</table>

</fieldset>

</form>
<form action="" method="get">
<input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>

</body>

</html>
<?php $this->end(); ?>