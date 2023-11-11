<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <style type="text/css">
    body {
        background-color: #d24dff;
    }

    table {
        background: #ffd94d;
        border: 0 solid yellow;
    }

    thead {
        background: #fff14d;
    }

    td {
        color: blue;
    }

    h3 {
        font-family: verdana;
        text-align: center;
        /* text-anchor: middle; */
        color: #ff8100;
        font-size: medium;
    }
    </style>
</head>

<body>
    <?php 
        function tinh_nam_am_lich($nam) {
            if(($nam % 4 == 0 && $nam % 100 != 0)|| $nam % 400 == 0) {
                return true;
            }
            return false;
        }
    ?>
    <?php 
    if(isset($_POST['namduonglich']))  
        $namduonglich=trim($_POST['namduonglich']); 
    else $namduonglich="";
    if(isset($_POST['namamlich']))  
        $namamlich=trim($_POST['namamlich']); 
    else $namamlich="";
   $mang_can = array("Quý", "Giáp", "Ất", "Bính", "Đinh", "Mậu", "Kỷ", "Canh", "Tân", "Nhâm");
   $mang_chi = array("Hợi", "Tý","Sửu", "Dần","Mão", "Thìn", "Tỵ", "Ngọ", "Mùi", "Thân", "Dậu", "Tuất");
   $mang_hinh = array("hoi.jpg", "ty.jpg", "suu.jpg", "dan.jpg", "mao.jpg", "thin.gif", "ran.jpg", "ngo.jpg", "mui.jpg", "than.jpg", "dau.jpg");

    if(isset($_POST['xuly'])) {
        if (is_numeric($namduonglich) && $namduonglich >= 3){
            $nam = $namduonglich-3;
            $can = $nam%10;
            $chi = $nam % 12;
            $namamlich = $mang_can[$can];
            $namamlich = $namamlich . " ".$mang_chi[$chi];
            $hinh = $mang_hinh[$chi];

        }  else {
            echo "<font color='red'>Vui lòng nhập vào số và >= 3! </font>"; 
        }
    }
?>
    <form align='center' action="" method="post">
        <table>
            <thead>
                <th colspan="8" align="center">
                    <h3>TÍNH NĂM ÂM LỊCH</h3>
                </th>
            </thead>
                <tr align="center">
                    <td>Năm dương lịch: </td>
                    <td></td>
                    <td>Năm âm lịch</td> 
                </tr>
                <tr align="center">
                    <td><input type="text" name="namduonglich" value="<?php  echo $namduonglich;?> " /></td>
                    <td><input type="submit" value="=>" name="xuly" /></td>
                    <td><input type="text" name="namamlich" value="<?php  echo $namamlich;?> " /></td>
                </tr>
            <tr>
                <td></td>
                <td><img src="/QuanLyTienLuong_PHP/views/pages/exercise/TruongKhanhHoa/images/<?php echo $hinh ?>" alt=""></td>
                <td></td>
            </tr>
        </table>
    </form>

</body>

</html>