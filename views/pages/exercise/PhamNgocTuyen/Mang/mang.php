<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php 
	$list = array(
			"CNTT" =>array("KTPM" => array("Hằng","Minh","Ngoan"),
							"HTTT" => array("Thúy","Ngà","Sơn","Trang"),
							"MMT" => array("Nam","Anh","Phượng")	
		),
			"NN" => array("BPD" => array("Bình","Hoa"),
							"DL" => array("Khánh, Quỳnh")
			)
	);
	foreach ($list as $khoa => $bomons) {
		echo "<ul><h2>Khoa $khoa</h2>";
		foreach($bomons as $tenbomon => $giaoviens){
			echo "<li>";
			echo "Mon ten la $tenbomon ";
			echo "<ul>";
			foreach($giaoviens as $tengv ){
				echo"<li>$tengv</li>";
			}
			echo "</ul>";
			echo "</li>";
		}
		echo "</ul>";
	}
 ?> 
<?php $this->end(); ?>
