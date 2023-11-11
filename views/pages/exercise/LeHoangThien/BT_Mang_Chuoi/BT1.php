<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Xử lý n</title>

</head>

<body>

<?php

	if(isset($_POST['n'])) $n=$_POST['n'];

	else $n=0;



	$ketqua="";

	if(isset($_POST['hthi'])) 

	{	//tạo mảng có n phần tử, các phần tử có giá trị [-100,200]

		$arr=array();

		for($i=0;$i<$n;$i++)

		{

			$x=rand(-200,200);


			$arr[$i]=$x;

		}

		//In ra mảng vừa tạo

		$ketqua="Mảng được tạo là:" .implode(" ",$arr)."&#13;&#10;";



		//Tìm và in ra các số dương chẵn trong mảng dùng hàm foreach

		$count=0;

		foreach($arr as $v){

			if($v%2==0 && $v>0 )

				$count++;

		}

		$ketqua.="Có $count số chẵn >0 trong mảng". "&#13;&#10;";



		//Tìm và in ra các số <n có chữ số cuối là số lẻ

		$ketqua .="Các số có chữ số cuối là số lẻ là: ";

		$daySo = "";

		for($i=0;$i<count($arr);$i++){

			$soCuoi = $arr[$i]%10;

			if($soCuoi %2 !=0)

				$daySo .= "$arr[$i]  ";

		}

		$ketqua .= $daySo;

		$TongSoAm = 0;
        foreach($arr as $v){
            if($v < 0){
                $TongSoAm += $v;
            }
        }		
        $ketqua .= "\nTổng số âm là: $TongSoAm"."&#13;&#10;";
        // e- In ra vị trí các phần tử có chữ số kề cuối là 0
        $daySoKeCuoi0="";
		for($i=0; $i<count($arr); $i++){
            if(  $arr[$i] > 100 && $arr[$i] % 100 > 0 && $arr[$i] % 100 < 10 ){
                $daySoKeCuoi0 .= "$i ";
            }
        }
        $ketqua .="vị trí của các thành phần trong mảng có chữ số kề cuối là 0 là: $daySoKeCuoi0"."&#13;&#10;";

        //  Sap xep tang dan chuoi
        sort($arr);
        $ketqua.="Mảng sau khi sắp xếp: " . implode(" ", $arr). "&#13;&#10;";
	}

?>

<form action="" method="post">

	Nhập n: <input type="text" name="n" value="<?php echo $n?>"/>

	<input type="submit" name="hthi" value="Hiển thị"/><br>

	Kết quả: <br>

	<textarea cols="70" rows="10" name="ketqua"> <?php echo $ketqua?></textarea>

</form>

</body>

</html>
<?php $this->end(); ?>