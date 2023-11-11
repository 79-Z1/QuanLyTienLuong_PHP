<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Tim kiem sua nang cao</title>

</head>
<style>
    table, caption, th, td {
  border:1px solid black;
}
</style>
<?php
require('connect.php');

$getloaisua = "select Ma_loai_sua, Ten_loai from loai_sua";

$resultloaisua = mysqli_query($conn, $getloaisua);

$gethangsua = "select Ma_hang_sua, Ten_hang_sua from hang_sua";

$resulthangsua = mysqli_query($conn, $gethangsua);

if (isset($_GET['hangsua'])) {
    $hangsua = $_GET['hangsua'];
} else $hangsua = "";
if (isset($_GET['loaisua'])) {
    $loaisua = $_GET['loaisua'];
} else $loaisua = "";
if (isset($_GET['tensua'])) {
    $tensua = $_GET['tensua'];
} else $tensua = "";

$rowsPerPage = 10;

if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}

$offset = ($_GET['p'] - 1) * $rowsPerPage;

$sqlTimKiem = "select *, Ten_loai, Ten_hang_sua from sua, loai_sua, hang_sua
        where sua.Ma_hang_sua = hang_sua.Ma_hang_sua
        and sua.Ma_loai_sua = loai_sua.Ma_loai_sua";

if (isset($_GET['tim'])) {

    if ($tensua != "") {
        $sqlTimKiem .= " and Ten_sua like '%$tensua%'";
    }
    if ($loaisua != "") {
        $sqlTimKiem .= " and sua.Ma_loai_sua = '$loaisua'";
    }
    if ($hangsua != "") {
        $sqlTimKiem .= " and sua.Ma_hang_sua = '$hangsua'";
    }

    $resultTK = mysqli_query($conn, $sqlTimKiem);
}
$sqlTimKiem .= " order by Ma_sua";
$resultTK = mysqli_query($conn, $sqlTimKiem);
$numRows = mysqli_num_rows($resultTK);
$sqlTimKiem .= " LIMIT $offset,$rowsPerPage";
$resultTK = mysqli_query($conn, $sqlTimKiem);


?>

<body>

    <form action="" method="get">

        <table bgcolor="#eeeeee" align="center" width="70%" border="1" cellpadding="5" cellspacing="5" style="border-collapse: collapse;">

            <tr>

                <td align="center">
                    <font color="blue">
                        <h3>TÌM KIẾM THÔNG TIN SỮA</h3>
                    </font>
                </td>

            </tr>

            <tr>

                <td align="center">Tên sữa: <input type="text" name="tensua" size="30" value="<?php echo $tensua ?>">

                </td>
            </tr>
            <tr>
                <td align="center">
                    <select name="hangsua">
                        <option value="">Trống</option>
                        <?php
                        if (mysqli_num_rows($resulthangsua) <> 0) {
                            while ($rows = mysqli_fetch_array($resulthangsua)) {
                                echo "<option value='$rows[Ma_hang_sua]'";
                                if (isset($_GET['hangsua']) && $_GET['hangsua'] == $rows['Ma_hang_sua']) echo 'selected';
                                echo ">$rows[Ten_hang_sua] </option> ";
                            }
                        }
                        ?>
                    </select>
                    <select name="loaisua">
                        <option value="">Trống</option>
                        <?php
                        if (mysqli_num_rows($resultloaisua) <> 0) {
                            while ($rows = mysqli_fetch_array($resultloaisua)) {
                                echo "<option value='$rows[Ma_loai_sua]'";
                                if (isset($_GET['loaisua']) && $_GET['loaisua'] == $rows['Ma_loai_sua']) echo 'selected';
                                echo ">$rows[Ten_loai] </option> ";
                            }
                        }
                        ?>
                    </select>
                        <input type="text" style="display:none" name="page" value="QLBSTimKiemSuaNC">
                    <input type="submit" name="tim" value="Tìm kiếm">
                </td>
            </tr>
        </table>
    </form>
    <div>
        <table align="center">
            <?php
                //tổng số trang
                $maxPage = floor($numRows / $rowsPerPage) + 1;
                $sorow = 2;
                if (mysqli_num_rows($resultTK) <> 0) {   
                    for($i = 0; $i < $sorow; $i++){
                        echo "<tr>";
                        while ($rows = mysqli_fetch_array($resultTK)) {
                                $tien = number_format($rows['Don_gia']);
                                echo "<td>
                                <h4>$rows[Ten_sua]</h4>
                                <p>$rows[Trong_luong]gr - $tien</p>
                                <img src='/QuanLyTienLuong_PHP/views/pages/exercise/NguyenDuyThien/QLBS/Hinh_sua/$rows[Hinh]' alt=''>
                                </td>";   
                                $dem ++;
                                if($dem == 5)
                                break;
                        }
                        echo "</tr>";
                    }
                    
                }  
                ?>
        </table>
    </div>
</body>
<?php
echo '<p align="center">';
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=QLBSTimKiemSuaNC&tensua=$tensua&hangsua=$hangsua&loaisua=$loaisua&timkiem=Tìm+kiếm&p=" . (1) . ">Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=QLBSTimKiemSuaNC&tensua=$tensua&hangsua=$hangsua&loaisua=$loaisua&timkiem=Tìm+kiếm&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . ">Back</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>'; //trang hiện tại sẽ được bôi đậm
    } else
        echo "<a class='pagination-link'  href=" . $_SERVER['PHP_SELF'] . "?page=QLBSTimKiemSuaNC&tensua=$tensua&phong=$hangsua&loaisua=$loaisua&timkiem=Tìm+kiếm&p=" . $i . ">" . $i . "</a> ";
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=QLBSTimKiemSuaNC&tensua=$tensua&phong=$hangsua&loaisua=$loaisua&timkiem=Tìm+kiếm&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">Next</a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=QLBSTimKiemSuaNC&tensua=$tensua&phong=$hangsua&loaisua=$loaisua&timkiem=Tìm+kiếm&p=" . ($maxPage) . ">Về cuối</a> ";
echo "</p>";
?>
<form action="" method="get">
<input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
</html>
<?php $this->end(); ?>