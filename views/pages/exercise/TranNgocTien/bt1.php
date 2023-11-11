<?php 
	$n = rand(-50,50);
	echo("Số N là: $n");
	if($n>0){
		echo("<br>N là số dương");
	}
	else{
		echo("<br>N là số âm");
		$n = -$n;
		echo("<br>Số N là: $n");
	}
	
	$arr = array();
	$sum = 0;
	for($i = 0; $i<$n; $i++){
		$arr[$i] = rand(-100,100);
		if($i%2!=0){
			$sum+=$arr[$i];
		}
	}
	echo("<br>Mảng: ");
	foreach ($arr as $i) {
		echo("$i ");
	}
	echo("<br>Tổng các phần tử ở vị trí lẻ là: $sum");
	
 ?>