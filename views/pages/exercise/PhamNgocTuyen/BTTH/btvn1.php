<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php 
	$n = rand(-50,50);
	echo $n;
	if ($n != 0) {
			$n = - $n;
		echo "<br> số đảo của $n là: ";	
		}		
	for ($i=0 ; $i < 100 ; $i++ ) { 
		// code...
	}
 ?>
 <?php $this->end(); ?>