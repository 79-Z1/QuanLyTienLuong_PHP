<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php
	$a = rand(1,4);
	$b = rand(10,1000);
	echo "a = $a , b = $b <br>";
	switch ($a) {
		case 1: echo "Chu vi hình vuông có độ dài cạnh $b là: " . 4*$b;
				echo "Diện tích hình vuông có độ dài cạnh $b là: " . $b *$b;
				break;
		case 2: define("PI", 3.1415);
				echo "Chu vi hình tròn có độ dài có bán kính là $b: " . 2*PI*$b;
				echo "<br> Diện tích hình tròn có bán kính là $b: " . round(PI*pow($b,2)*2);
				break;
		case 3: $p = ($b*3 / 2);
				echo "Chu vi hình tam giác có cạnh bằng $b: " . $b *3;
				echo "Diện tích hình tam giác có cạnh bằng $b: " . sqrt($p*($p - $b)*3);
				break;
		case 4: echo "Chu vi hình chử nhật có cạnh $a và $b là: " . ($a + $b) *2;
				echo "Diện tích hình chử nhật có cạnh $a và $b là" . $a *$b;
	}
	?>
<?php $this->end(); ?>