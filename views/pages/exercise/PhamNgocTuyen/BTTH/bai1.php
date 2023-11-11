<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php
    $sotunhien = array();
    $n = 9;
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
        echo "<br> $value";
    };
?>
<?php $this->end(); ?>