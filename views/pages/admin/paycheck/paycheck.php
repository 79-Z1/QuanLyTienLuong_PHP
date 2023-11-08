<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$sqlNhanVien = 'select * from nhan_vien ';
$resultNhanVien = mysqli_query($conn, $sqlNhanVien);

if (isset($_GET['maPL']))
    $maPL = trim($_GET['maPL']);
else $maPL = "";

if (isset($_GET['maNV']))
    $maNV = trim($_GET['maNV']);
else $maNV = "";
if (isset($_GET['thang']))
    $thang = trim($_GET['thang']);
else $thang = "";

if (isset($_GET['nam']))
    $nam = trim($_GET['nam']);
else $nam = "";



$rowsPerPage = 9; //số mẩu tin trên mỗi trang, giả sử là 8

if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}

$sqlNhanVien = 'select * from nhan_vien';
$resultChucVu = mysqli_query($conn, $sqlNhanVien);

$offset = ($_GET['p'] - 1) * $rowsPerPage;

$sqlTimKiem =
    "select * from phieu_luong where 1 ";

if (isset($_GET['timkiem'])) {
    if ($maPL != "") {
        $sqlTimKiem .= "and MaPhieuLuong like '%$maPL%' ";
    }
    if ($maNV != "") {
        $sqlTimKiem .= "and MaNV like '%$maNV%' ";
    }
    if ($thang != "") {
        $sqlTimKiem .= "and Thang = '$thang' ";
    }
    if ($nam != "") {
        $sqlTimKiem .= "and Nam = '$nam' ";
    }

    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
}

$sqlTimKiem .= " order by MaPhieuLuong";
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
                                <p>Mã phiếu lương</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maPL" value="<?php echo $maPL; ?>"></td>
                            <td>
                                <p>Mã nhân viên</p>
                            </td>
                            <td>

                                <select name="maNV" class="form-select search-option" id="inputGroupSelect02">
                                    <option value="">Trống</option>
                                    <?php
                                    if (mysqli_num_rows($resultChucVu) <> 0) {

                                        while ($rows = mysqli_fetch_array($resultChucVu)) {
                                            echo "<option ";
                                            if (isset($_GET['maNV']) && $_GET['maNV'] == $rows['MaNV']) echo "selected";
                                            echo ">$rows[MaNV]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Tháng</p>
                            </td>
                            <td>
                                <input class="form-control me-2 search-input" type="text" name="thang" value="<?php echo $thang; ?>">
                            </td>
                            <td>
                                <p>Năm</p>
                            </td>
                            <td>
                                <input class="form-control me-2 search-input" type="text" name="nam" value="<?php echo $nam; ?>">
                            </td>
                        </tr>
                        <tr > 
                            <td align="center" colspan="4">
                                <input class="btn btn-outline-purple search-btn w-25 me-3" name="timkiem" type="submit" value="Tìm kiếm" />
                                <a href="index.php?page=admin-paycheck-add-paycheck" class="btn btn-outline-success search-btn w-25">Thêm</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </nav>
        </div>
    </div>
</div>

<div style="height: 480px;">
    <div class="card shadow border-0 mb-3" >
        <table class="table table-hover table-nowrap"  style="min-width: 100%;">
            <thead>
                <tr>
                    <th scope="col">Mã phiếu lương</th>
                    <th scope="col">Mã nhân viên</th>
                    <th scope="col">Tháng</th>
                    <th scope="col">Số ngày công</th>
                    <th scope="col">Số ngày vắng</th>
                    <th scope="col">Tiền lương tháng</th>
                    <th scope="col">Thực lĩnh</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                //tổng số trang
                $maxPage = floor($numRows / $rowsPerPage) + 1;

                if (mysqli_num_rows($resultTimKiem) <> 0) {

                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                        echo "<tr>
                            <td>{$rows['MaPhieuLuong']}</td>
                            <td >{$rows['MaNV']}</td>
                            <td >{$rows['Thang']}</td>
                            <td >{$rows['SoNgayCong']}</td>
                            <td >{$rows['SoNgayVang']}</td>
                            <td >{$rows['TienLuongThang']}</td>
                            <td >{$rows['ThucLinh']}</td>
                            <td style='padding: 0.5rem 0.5rem;'>
                                <a href='index.php?page=admin-paycheck-info-paycheck&maPL={$rows['MaPhieuLuong']}'><i style='color:green; font-size: 20px; ' class='bi bi-person-lines-fill '></i></a>
                                <a href='index.php?page=admin-paycheck-edit-paycheck&maPL={$rows['MaPhieuLuong']}'><i style='color:blue; font-size: 20px;' class='bi bi-pencil-square'></i></a>
                                <a href='index.php?page=admin-paycheck-delete-paycheck&maPL={$rows['MaPhieuLuong']}'><i style='color:red; font-size: 20px;' class='bi bi-person-x'></i></a>
                            </td>
                            </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<?php
echo '<div align="center">';
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-paycheck&maPL=$maPL&maNV=$maNV&thang=$thang&nam=$nam&timkiem=Tìm+kiếm&p=1>Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-paycheck&maPL=$maPL&maNV=$maNV&thang=$thang&nam=$nam&timkiem=Tìm+kiếm&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>';
    } else {
        echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-paycheck&maPL=$maPL&maNV=$maNV&thang=$thang&nam=$nam&timkiem=Tìm+kiếm&p=" . $i . ">" . $i . "</a> ";
    }
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-paycheck&maPL=$maPL&maNV=$maNV&thang=$thang&nam=$nam&timkiem=Tìm+kiếm&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-paycheck&maPL=$maPL&maNV=$maNV&thang=$thang&nam=$nam&timkiem=Tìm+kiếm&p=" . $maxPage . ">Về cuối</a> ";
echo "</div>";
?>

<?php $this->end(); ?>
