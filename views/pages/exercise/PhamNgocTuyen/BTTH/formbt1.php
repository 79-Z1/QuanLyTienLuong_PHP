<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>form tính số tự nhiên</title>
    <style type="text/css">
        body {  
            background-color: #d24dff;
        }
        table{
            background: #ffd94d;
            border: 0 solid yellow;
        }
        thead{
            background: #fff14d;    
        }
        td {
            color: blue;
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
if(isset($_POST['n']))  
    $n=trim($_POST['n']); 
else $n=0;
            
?>
<form align='center' action="" method="post">
<table>
    <thead>
        <th colspan="2" align="center"><h3>Tính số tự nhiên</h3></th>
    </thead>
    <tr><td>Nhập N:</td>
     <td><input type="text" name="n" value="<?php  echo $n;?> "/></td>
    </tr>
    <tr>
     <td colspan="2" align="center"><input type="submit" value="Tính" name="tinh" /></td>
    </tr>
</table>
</form>
<?php
if(isset($_POST['tinh'])){
    if (is_numeric($n) && $n >0) {
        $sotunhien = array();
        // $sotunhien[0] = rand(-50,50); 
        // $sotunhien[1] = rand(-50,50); 
        // $sotunhien[2] = rand(-50,50); 
        // $sotunhien[3] = rand(-50,50); 
        // $sotunhien[4] = rand(-50,50); 
        for($i = 0; $i < $n;$i++){
            $sotunhien[$i] = rand(-500,500);  
        }
        foreach($sotunhien as $value){
            echo " $value";
        };
        //b dem so chan
        $dem =0;
        foreach($sotunhien as $value){
            if($value %2 == 0){
                $dem++;
            }
           
        }
        echo "<br> So phan tu chan la: " .$dem;
        //dem so nho hon 100
        $demso =0;
        foreach($sotunhien as $value){
            if($value < 100){
                $demso++;
            }
        }
        echo "<br> So phan tu be hon 100 la: " . $demso;
        //tinh tong so am
        $sum = 0;
        foreach($sotunhien as $value){
            if($value < 0){
                $sum = $sum + $value;   
            }
        }
        echo "<br> tong cac so am: ".$sum;
        //sap xep tang dan
        sort($sotunhien);
        foreach($sotunhien as $value){
            echo "<br> sap xep so tang dan: $value";
        };
    }
}
?>
</body>
</html>
<?php $this->end(); ?>