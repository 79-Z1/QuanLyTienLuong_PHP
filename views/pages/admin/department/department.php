<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

if (isset($_GET['maNV']))
    $maNV = trim($_GET['maNV']);
else $maNV = "";

if (isset($_GET['hoTen']))
    $hoTen = trim($_GET['hoTen']);
else $hoTen = "";

if (isset($_GET['phong']))
    $maPhong = $_GET['phong'];
else $maPhong = "";

if (isset($_GET['chucVu']))
    $maChucVu = $_GET['chucVu'];
else $maChucVu = "";

if (isset($_GET['radGT']))
    $gioiTinh = $_GET['radGT'];
else $gioiTinh = "";



$rowsPerPage = 5; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset = ($_GET['p'] - 1) * $rowsPerPage;
//lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset

// $sqlTimKiem =
//     "select *, TenPhong, TenChucVu from nhan_vien, chuc_vu, phong_ban
//             where nhan_vien.MaPhong = phong_ban.MaPhong 
//             and nhan_vien.MaChucVu = chuc_vu.MaChucVu
//         ";

// if (isset($_GET['timkiem'])) {

//     if ($maPhong != "") {
//         $sqlTimKiem .= "and phong_ban.MaPhong = '$maPhong'";
//     }
//     if ($tenPhong != "") {
//         $sqlTimKiem .= "and phong_ban.TenPhong = '$tenPhong'";
//     }




//     $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
// }
// $sqlTimKiem .= "order by MaNV";
// $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
// $numRows = mysqli_num_rows($resultTimKiem);
// $sqlTimKiem .= " LIMIT $offset,$rowsPerPage";
// $resultTimKiem = mysqli_query($conn, $sqlTimKiem);

$sqlPhong = 'select * from phong_ban';
$resultPhong = mysqli_query($conn, $sqlPhong);

$sqlPhongBan = "SELECT * FROM phong_ban";
$resultPhongBan = mysqli_query($conn, $sqlPhongBan);
?>

<!-- Card stats -->
<div class="g-6 mb-3 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 d-flex">
            <nav class="navbar navbar-light bg-light d-flex justify-content-center py-1">
                <form action="" method="get">
                    <table>
                        <tr>
                            <td>
                                <p>Mã phòng</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maNV" value="<?php echo $maNV; ?>"></td>
                            <td>
                                <p>Phòng</p>
                            </td>
                            <td>

                                <select name="phong" class="form-select search-option" id="inputGroupSelect02">
                                    <option value="">Trống</option>
                                    <?php
                                    if (mysqli_num_rows($resultPhong) <> 0) {

                                        while ($rows = mysqli_fetch_array($resultPhong)) {
                                            echo "<option value='$rows[MaPhong]'";
                                            if (isset($_GET['phong']) && $_GET['phong'] == $rows['MaPhong']) echo "selected";
                                            echo ">$rows[TenPhong]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" margin="5%" colspan="5" >
                                <input class="btn btn-outline-success search-btn" name="timkiem" type="submit" value="Tìm kiếm" />
                            </td>
                        </tr>
                    </table>

                </form>
            </nav>
        </div>
    </div>
</div>

<div style="height: 480px">

    <div class="card shadow border-0 mb-3">
        <table class="table table-hover table-nowrap">
            <thead>
                <tr>
                    <th scope="col">mã phòng</th>
                    <th scope="col">tên phòng</th>
                </tr>
            </thead>

            <tbody>
                <?php

                //tổng số trang
                // $maxPage = floor($numRows / $rowsPerPage) + 1;
                if (mysqli_num_rows($resultPhongBan) <> 0) {

                    while ($rows = mysqli_fetch_array($resultPhongBan)) {
                        echo "<tr>
                            <td >{$rows['MaPhong']}</td>
                            <td >{$rows['TenPhong']} </td>
                            <td>
                            <a href='index.php?page=admin-department-edit&MaPhong={$rows['MaPhong']}'><i style='color:blue' class='bi bi-pencil-square'></i></a>
                            <a href='index.php?page=admin-department-delete&MaPhong={$rows['MaPhong']}'><i style='color:red' class='bi bi-person-x'></i></a>
                            </td>
                            </tr>";
                    }
                }

                ?>
            </tbody>
            <tr>
                <td id="no_color" colspan="5" align="center">
                    <input type="submit" value="Thêm" id='them' name="them" class="btn btn-outline-purple themnhanvien-btn w-60" />
                </td>
            </tr>
        </table>
    </div>
</div>
</div>
<?php
// echo '<div align="center">';
// echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&radGT=$gioiTinh&p=" . (1) . ">Về đầu</a> ";
// echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&radGT=$gioiTinh&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
// for ($i = 1; $i <= $maxPage; $i++) {
//     if ($i == $_GET['p']) {
//         echo '<a class="pagination-link active">' . $i . '</a>'; //trang hiện tại sẽ được bôi đậm
//     } else
//         echo "<a class='pagination-link'  href=" . $_SERVER['PHP_SELF'] . "?maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&radGT=$gioiTinh&p=" . $i . ">" . $i . "</a> ";
// }
// echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&radGT=$gioiTinh&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
// echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&radGT=$gioiTinh&p=" . ($maxPage) . ">Về cuối</a> ";
// echo "</div>";
?>
<?php $this->end(); ?>