<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">

	table{

		color: #ffff00;

		background-color: gray;     

	}

	table th{

		background-color: blue;

		font-style: vni-times;

		color: yellow;

	}

	</style>
</head>
<body>
	<?php 
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

        if(isset($_POST['name']))  
		    $name=trim($_POST['name']); 
		else $name="";   
        if(isset($_POST['rank']))  
		    $rank=trim($_POST['rank']); 
		else $rank="";            

        $danhSach = "";

        function tongDay($arr){
            $tong = 0;
            foreach($arr as $value){
                $tong += $value;
            }
            return $tong;
        }

		if(isset($_POST['them'])){
            if ($name != "" && $rank != "")  {
               $music[$rank] = $name;
            }
            
            else echo "Vui lòng nhập đầy đủ";
        }

        if(isset($_POST['hienThi'])){
            if ($name != "" && $rank != "")  {
                $music[$rank] = $name;
             }
            ksort($music);
            foreach($music as $Rank => $baiHat){
                $danhSach .= "$Rank: $baiHat\n";
            }
        }
		
	?>
	<form action="" method="post">
		<table border="0" cellpadding="0">
			<th colspan="2"><h2>Xếp hạng bài hát</h2></th>
            <tr align="center">
                <td>Tên bài hát: </td>
                <td><input type="text" name="name" size="30" value="<?php echo $name;?>"></td>
            </tr>
            <tr align="center">
                <td>Rank: </td>
                <td><input type="text" name="rank" size="30" value="<?php echo $rank;?>"></td>
            </tr>
            <tr align="center">
                <td colspan="2">
                    <input type="submit" name="them"  size="20" value="Thêm bài hát"/>
                    <input type="submit" name="hienThi"  size="20" value="Hiển thị danh sách"/>
                </td>
            </tr>
            <tr align="center">
                <td>Danh sách bài hát: </td>
                <td><textarea name="danhSach" cols="50" rows="15"><?php echo $danhSach;?></textarea></td>
            </tr>
		</table>

        
	</form>
    <p align="left"><a href="?page=">Quay lại</a></p>
</body>
</html>
<?php $this->end(); ?>