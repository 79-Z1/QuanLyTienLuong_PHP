<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php
    $n = rand(-50,50);
    echo $n;
    if($n != 0){
        $n =  -$n;
    }
    echo "<br>$n";

    for($i = 0; $i < $n ; $i++){
        $array[$i] = rand(-100,100);
    }
    echo "<br>In mang";
    foreach($array as $key => $value){
        echo "<br>$value";
    }
    foreach($array as $key => $value){
        if($key%2 != 0){
            $tong = $tong + $value;
        }
    }
    echo "<br>Tong = $tong";
?>
<form action="" method="get">
<input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
<?php $this->end(); ?>