<?php 

	$list = array(
		"CNTT" => array(
			"KTPM" => array("Hằng","Minh","Ngoan","Hưng"),
			"HTTT" => array("Thúy","Ngà","Sơn","Trang"),
			"MMT" => array("Nam","Anh","Phượng"),
		),
		"NN" => array(
			"BBD" => array("Bình","Hoa"),
			"DL" => array("Khánh","Quỳnh"),
		),
	);

	foreach ($list as $khoa => $boMon) {

			echo ("Khoa: $khoa <br>");
		foreach ($boMon as $bm => $gv) {
			echo ("Bộ môn: $bm <br>");
			echo("Giáo viên: ");
			foreach ($gv as $tenGV) {
			echo (" $tenGV,");
			}
			echo("<br>");
		}
	}

	$music = array(
		 	9 => "Em của ngày hôm qua",
		 	4 => "See tình",
		 	3 => "Giá như cô ấy không xuất hiện",
		 	6 => "Tận cùng của nỗi nhớ",
		 	5 => "Quá khứ còn lại là gì",
		 	1 => "Cứ chill thôi",
		 	7 => "Vùng kí ức",
		 	10 => "Em đừng khóc",
		 	2 => "Lấy chồng sớm làm gì",
		 	8 => "Ông trời làm tội anh chưa",
	);

	

	
	krsort($music);
	
	echo("<h2>Sắp xếp tăng dần theo tên bài hát: </h2>");
	echo("<ul>");
	foreach ($music as $rank => $baiHat) {
		echo "<li>$rank: $baiHat</li>";
	}
	echo("</ul>");
	echo("<br>");
	// echo("<h2>Sắp xếp tăng dần theo xếp hạng: </h2>");
	// krsort($music);
	// echo("<ul>");
	// foreach ($music as $rank => $baiHat) {
	// 	echo("<li>$rank: $baiHat</li>");
	// }
	// echo("</ul>");
	
?>