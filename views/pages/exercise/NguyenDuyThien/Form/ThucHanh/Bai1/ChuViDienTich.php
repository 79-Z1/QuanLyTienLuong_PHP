<?php
    $a = rand(1,4);
    $b = rand(10,100);
    echo "a = $a, b = $b <br>";
    switch($a){
        case 1: echo "Chu vi hinh vuong canh do dai bang $b la: " . 4*$b;
                echo "<br> Dien hinh vuong canh do dai bang $b la: " . $b*$b;
                break;
        case 2: define("PI", 3.1415);
                echo "Chu vi hinh tron ban kinh $b la: " . 2*PI*$b;
                echo "<br> Dien tich hinh tron ban kinh $b la: " . round(PI*pow($b,2),2);
                break;
        case 3: $p = ($b * 3)/2;
                echo "Chu vi tam giac deu do danh canh $b la: " . $b*3;
                echo "<br> Dien tich tam giac deu do danh canh $b la: " . sqrt($p*3*($p-$b));
                break;
        case 4: echo "Chu vi hinh chu nhat canh do dai bang $b la: " . ($a + $b) * 2;
                echo "<br> Chu vi hinh chu nhat canh do dai bang $b la: " . $a * $b;
    }
?>