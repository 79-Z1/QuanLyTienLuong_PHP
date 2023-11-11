<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php 
for($j=2; $j <=10 ; $j++){
	echo "Bảng cửu chương $j \n";
	for($i=1; $i <=10 ; $i++) { 
		echo "<br> $j x $i = " . $j * $i ."</br>";
	}
}
 ?>
 <?php $this->end(); ?>