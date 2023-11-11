<?php 
	// $mangcb = array("Tên" => "Tuyển" 
	// 		,"Họ" => "Phạm");

	// echo "<h2>Tên Phim Hay</h2>";
 	// echo "<ul>";
 	// foreach ($mangcb as $key => $value)
 	// 	echo "$key: $value <br>"
//-----------------------mang 1 chieu --------------------------------	
	// $chucai = array();
	// $chucai["a"] = 1;
	// $chucai["b"] = 2;
	// $chucai[] = 3;
	// $chucai["f"] = 7;
	// var_export($chucai);
//------------------------mang 1 chieu co khoa'---------------------------------
	// $abcd = array(
	// 	0 => "qwert",
	// 	1 => "tyuio",
	// 	2 => "zxcvb",
	// 	3 => "tyjghj",
	// 	4 => "ghsfeew"
	// );
	// echo "bảng chử cái: " . $abcd[4];
//--------------------------mang 2 chieu ------------------------------

// $phim = array(
// 	"vietnam" => array("Ha Noi", "Khanh Hoa" => array("Cam Ranh","Nha Trang","Dien Khanh")),
// 	"My" => array("Wasinton","New York"),
// 	"Canada" => array("Ottawa","Uc"),
// ) ;
// var_export($phim)

//------------------foreach 2 chieu----------------------------------------
// $music = array(
// 	"Nhac tre" => array("1 phut","dang do"),
// 	"Nhac vang" => array("que huong","5 anh em"),
// 	"Nhac nuoc ngoai" => array("bad habits","river")
// );
// foreach ($music as $key => $value) {
// 	echo "$key: ";
// 	foreach($value as $k => $song){
// 		echo "$song ";
// 	} 
// 	echo "<br>";
// }
//------------------foreach 2 chieu----------------------------------------
	$movie = array(
		"hanhdong" => array("john wick","Kungfu Panda"),
		"vientuong" => array("transfomer","King Kong"),
		"trinhtham" => array("serlock home","Conan")
	);
	echo "<h2>Danh muc phim hay</h2><p>";
	foreach($movie as $key => $value){
		echo "<h3>$key</h3><ul>";
		foreach($value as $k => $film){
			echo "<li>$film</li>";
		}
		echo "</ul>";
	}
//----------------------------------------------------------
// $phim = array(

// 	"vietnam" => array("Ha Noi", "Khanh Hoa" => array("Cam Ranh","Nha Trang","Dien Khanh")),
// 	"My" => array("Wasinton","New York"),
// 	"Canada" => array("Ottawa","Uc"),
// ) ;
//-----------------------for dung cho key co dang so-----------------------------------

 // $mang_so = array(3,4,5,6,7,8,1);
 // $demso = count($mang_so);
 // for ($i=0; $i < $demso; $i++) 
 // 	echo "Số phần tử trong mảng là $i: " . $mang_so[$i] . "<br>";
 	
//----------------------------------------------------------	
 ?>