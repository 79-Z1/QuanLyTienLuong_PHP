<?php $this->layout('layout_accountant') ?>
<?php $this->section('content'); ?>
<?php
function money_format($tien)
{
    return number_format($tien, 0, ',', '.');
}
?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$sqlChucVu = 'select MaChucVu, TenChucVu from chuc_vu';

$resultChucVu = mysqli_query($conn, $sqlChucVu);

$sqlPhong = 'select MaPhong, TenPhong from phong_ban';

$resultPhong = mysqli_query($conn, $sqlPhong);

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

if (isset($_GET['thang']))
    $thang = $_GET['thang'];
else $thang = "";

if (isset($_GET['nam']))
    $nam = $_GET['nam'];
else $nam = "";

$rowsPerPage = 9; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset = ($_GET['p'] - 1) * $rowsPerPage;
//lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset

$sqlTimKiem =
    "SELECT *, TenPhong, TenChucVu FROM nhan_vien, chuc_vu, phong_ban,phieu_luong
            WHERE nhan_vien.MaPhong = phong_ban.MaPhong 
            AND nhan_vien.MaChucVu = chuc_vu.MaChucVu
            AND nhan_vien.MaNV = phieu_luong.MaNV
        ";

if (isset($_GET['timkiem'])) {
    if ($maNV != "") {
        $sqlTimKiem .= " AND nhan_vien.MaNV = '$maNV'";
    }
    if ($hoTen != "") {
        $sqlTimKiem .= " AND concat(HoNV,' ',TenNV) LIKE '%$hoTen%'";
    }
    if ($maPhong != "") {
        $sqlTimKiem .= " AND nhan_vien.MaPhong = '$maPhong'";
    }
    if ($maChucVu != "") {
        $sqlTimKiem .= " AND nhan_vien.MaChucVu = '$maChucVu'";
    }
    if ($thang != "") {
        $sqlTimKiem .= " AND Thang = $thang";
    }
    if ($nam != "") {
        $sqlTimKiem .= " AND Nam = $nam";
    }
    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
}
$sqlTimKiem .= " ORDER BY nhan_vien.MaNV";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);
$numRows = mysqli_num_rows($resultTimKiem);
$sqlTimKiem .= " LIMIT $offset,$rowsPerPage";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);

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
                                <p>Mã nhân viên</p>
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
                            <td> <p align="center">Tháng</p> <input class="form-control me-2 search-input" size="2"  type="text" name="thang" value="<?php echo $thang; ?>"></td>
                            <td> <p align="center">Năm</p> <input class="form-control me-2 search-input" size="4" type="text" name="nam" value="<?php echo $nam; ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Họ tên nhân viên</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="hoTen" value="<?php echo $hoTen; ?>"></td>
                            <td>
                                <p>Chức vụ</p>
                            </td>
                            <td>

                                <select name="chucVu" class="form-select search-option" id="inputGroupSelect02">
                                    <option value="">Trống</option>
                                    <?php
                                    if (mysqli_num_rows($resultChucVu) <> 0) {
                                        while ($rows = mysqli_fetch_array($resultChucVu)) {
                                            echo "<option value='$rows[MaChucVu]'";
                                            if (isset($_GET['chucVu']) && $_GET['chucVu'] == $rows['MaChucVu']) echo "selected";
                                            echo ">$rows[TenChucVu]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td align="center" colspan="2">
                                <input type="text" name="page" value="accountant-check-paycheck" style="display: none">
                                <input style="width:150" class="btn btn-outline-success search-btn" name="timkiem" type="submit" value="Tìm kiếm" />
                            </td>
                        </tr>
                    </table>
                </form>
            </nav>
        </div>
    </div>
</div>
<div style="height:503px">

    <div class="card shadow border-0 mb-3">
        <table class="table table-hover table-nowrap">
            <thead>
                <th scope="col">mã nhân viên</th>
                <th scope="col">họ tên</th>
                <th scope="col">chức vụ</th>
                <th scope="col">tiền lương tháng</th>
                <th scope="col">tổng thu nhập</th>
                <th scope="col">thực lĩnh</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </thead>

            <tbody>
                <?php

                //tổng số trang
                $maxPage = ceil($numRows / $rowsPerPage);
                if (mysqli_num_rows($resultTimKiem) <> 0) {
                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                ?>
                        <tr>
                            <td><?=$rows['MaNV']?></td>
                            <td><?=$rows['HoNV']. " " . $rows['TenNV']?></td>
                            <td><?=$rows['TenChucVu']?></td>
                            <td align="right" style="padding-right:50px;"><?=number_format($rows['TienLuongThang'])?> đ</td>
                            <td align="right" style="padding-right:50px;"><?=number_format($rows['TongThuNhap'])?> đ</td>
                            <td align="right" style="padding-right:50px;"><?=number_format($rows['ThucLinh'])?> đ</td>
                            <td><a href='index.php?page=accountant-detail-paycheck&MaPL=<?=$rows['MaPhieuLuong']?>&MaNV=<?=$rows['MaNV']?>'><i style='color:green' class='bi bi-person-lines-fill'></i></a></td>
                            <td><a href='index.php?page=accountant-edit-paycheck&MaPL=<?=$rows['MaPhieuLuong']?>&MaNV=<?=$rows['MaNV']?>'><i style='color:blue' class='bi bi-pencil-square'></i></a></td>
                        </tr>
                <?php
                    }
                } ?>
            </tbody>
        </table>
    </div>
</div>
<?php
echo '<div align="center">';
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-paycheck&maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&thang=$thang&nam=$nam&p=" . (1) . ">Đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-paycheck&maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&thang=$thang&nam=$nam&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>'; //trang hiện tại sẽ được bôi đậm
    } else
        echo "<a class='pagination-link'  href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-paycheck&maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&thang=$thang&nam=$nam&p=" . $i . ">" . $i . "</a> ";
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-paycheck&maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&thang=$thang&nam=$nam&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-paycheck&maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&thang=$thang&nam=$nam&p=" . ($maxPage) . ">Cuối</a> ";
echo "</div>";
?>
<?php $this->end(); ?>