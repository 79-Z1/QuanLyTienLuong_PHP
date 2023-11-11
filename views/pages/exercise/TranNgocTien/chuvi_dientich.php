<?php
	$a = rand(1,4);
	$b = rand(10,100);
	echo "a = $a, b = $b <br>";
	switch ($a) {
		case 1:
			echo "Chu vi hình vuông cạnh độ dài $b là: " . 4*$b;
			echo "<br>Diện tích hình vuông cạnh độ dài $b là: " . $b*$b;
			break;
		case 2:
			define("PI", 3.1415);
			echo "Chu vi hình tròn bán kính $b là: " . 2*PI*$b;
			echo "<br>Diện tích hình tròn bán kính $b là: " . round(PI*pow($b,2),2);
			break;
		case 3:
			$p = ($b*3)/2;
			echo "Chu vi hình tam giác đều độ dài cạnh $b là: " . $b*3;
			echo "<br>Diện tích hình tam giác đều độ dài cạnh $b là: " . round(sqrt($p*3*($p-$b)),2);
			break;
		case 4:
			echo "Chu vi hình chữ nhật có độ dài 2 cạnh $a và $b là: " . ($a+$b)*2;
			echo "<br>Diện tích hình chữ nhật có độ dài 2 cạnh $a và $b là: " . $a*$b;
			break;
	}
?>