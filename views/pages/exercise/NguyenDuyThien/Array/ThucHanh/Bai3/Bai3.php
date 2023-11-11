<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tinh nam am lich</title>
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
    if(isset($_POST['namduong'])){
        $namduong = trim($_POST['namduong']);
    }
    else $namduong = 0;

    $nam_al = "";

    $mang_can = array("Quy","Giap","At","Binh", "Dinh", "Mau","Ky","Canh","Tan","Nham");
    $mang_chi = array("Hoi", "Ti", "Suu","Dan","Mao","Thin","Ty","Ngo","Mui","Than","Dau","Tuat");
    $mang_hinh = array("hoi.jpg","ti.jpg","suu.jpg","dan.jpg","meo.jpg","thin.jpg","ty.jpg","ngo.jpg","mui.jpg","than.jpg","dau.jpg","tuat.jpg",);

    if(isset($_POST['tinh'])){
    $nam = $namduong - 3;
    $can = $nam % 10;
    $chi = $nam % 12;
    $nam_al = $mang_can[$can];
    $nam_al = $nam_al . " " .$mang_chi[$chi];
    $hinh = $mang_hinh[$chi];
    $hinh_anh = "<img src='/QuanLyTienLuong_PHP/views/pages/exercise/NguyenDuyThien/Array/ThucHanh/Bai3/img/$hinh'>";
    }
?>
    <form align='center' action="" method="post">
        <table>
            <thead>
                <th colspan="8" align="center">
                    <h3>TINH NAM AM LICH</h3>
                </th>
            </thead>
            <tr align="center">
                <td>nhap nam duong lich:</td>
                <td></td>
                <td>nam am lich: </td>
            </tr>
            <tr align="center">
                <td><input type="text" name="namduong" value="<?php echo $namduong;?> " /></td>
                <td align="center"><input type="submit" value="=>" name="tinh" /></td>
                <td><input name="nam_al" rows = "2" cols = "50" value="<?php echo $nam_al;?>" ></td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo $hinh_anh; ?></td>
                <td></td>
            </tr>
        </table>
    </form>
    <form action="" method="get">
    <input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
</body>
</html>
<?php $this->end(); ?>