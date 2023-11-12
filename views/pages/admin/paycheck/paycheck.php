<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");


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
$resultMaNhanVien = mysqli_query($conn, $sqlNhanVien);

$offset = ($_GET['p'] - 1) * $rowsPerPage;

$sqlTimKiem =
    "select *, HoNV, TenNV from phieu_luong, nhan_vien where phieu_luong.MaNV = nhan_vien.MaNV ";

if (isset($_GET['timkiem'])) {
    if ($maPL != "") {
        $sqlTimKiem .= " and phieu_luong.MaPhieuLuong like '%$maPL%' ";
    }
    if ($maNV != "") {
        $sqlTimKiem .= " and phieu_luong.MaNV like '%$maNV%' ";
    }
    if ($thang != "") {
        $sqlTimKiem .= " and phieu_luong.Thang = '$thang' ";
    }
    if ($nam != "") {
        $sqlTimKiem .= " and phieu_luong.Nam = '$nam' ";
    }

    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
    if(mysqli_num_rows($resultTimKiem) == 0){
        echo "<script type='text/javascript'>
                toastr.error('Không tìm thấy phiếu lương này');
                toastr.options.timeOut = 3000;
            </script>";
    }
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

                                <select name="maNV" class="form-select search-option">
                                    <option value="">Trống</option>
                                    <?php
                                    if (mysqli_num_rows($resultMaNhanVien) <> 0) {

                                        while ($rows = mysqli_fetch_array($resultMaNhanVien)) {
                                            echo "<option ";
                                            if (isset($_GET['maNV']) && $_GET['maNV'] == $rows['MaNV']) echo "selected";
                                            echo ">$rows[MaNV]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input class="btn btn-outline-success search-btn  me-3" name="timkiem" type="submit" value="Tìm kiếm" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Tháng</p>
                            </td>
                            <td>
                                <input class="form-control me-2 search-input" type="number" min="1" max="12" name="thang" value="<?php echo $thang; ?>">
                            </td>
                            <td>
                                <p>Năm</p>
                            </td>
                            <td>
                                <input class="form-control me-2 search-input" type="number" min="2000"   name="nam" value="<?php echo $nam; ?>">
                            </td>
                            <td align="center" >
                                <a href="index.php?page=admin-paycheck-add-paycheck" class="btn btn-outline-purple search-btn ">Thêm</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </nav>
        </div>
    </div>
</div>

<div style="height: 73%;">
    <div class="card shadow border-0 mb-3" >
        <table class="table table-hover table-nowrap"  style="min-width: 100%;">
            <thead>
                <tr>
                    <th scope="col">Mã phiếu lương</th>
                    <th scope="col">Mã nhân viên</th>
                    <th scope="col">Họ Tên</th>
                    <th scope="col">Tiền lương tháng</th>
                    <th scope="col">Tổng thu nhập</th>
                    <th scope="col">Thực lĩnh</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                //tổng số trang
                $maxPage = ceil($numRows / $rowsPerPage);
                if (mysqli_num_rows($resultTimKiem) <> 0) {
                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                ?>
                       <tr>
                            <td align=''><?= $rows['MaPhieuLuong']?></td>
                            <td ><?= $rows['MaNV']?></td>
                            <td ><?= $rows['HoNV'] . " " . $rows['TenNV']?></td>
                            <td align="center" ><?= number_format($rows['TienLuongThang']) ?> VNĐ</td>
                            <td align="center" ><?= number_format($rows['TongThuNhap']) ?> VNĐ</td>
                            <td align="center" ><?= number_format($rows['ThucLinh']) ?> VNĐ</td>
                            <td style='padding: 0.5rem 0.5rem;'>
                                <a href='index.php?page=admin-paycheck-info-paycheck&maPL=<?= $rows['MaPhieuLuong'] ?>'> <i style="color:green; font-size: 20px; " class='bi bi-person-lines-fill' ></i></a>
                                <a href='index.php?page=admin-paycheck-edit-paycheck&maPL=<?= $rows['MaPhieuLuong'] ?>'> <i style="color:blue; font-size: 20px;" class='bi bi-pencil-square'></i></a>
                                <a href='index.php?page=admin-paycheck-delete-paycheck&maPL=<?= $rows['MaPhieuLuong'] ?>'> <i style="color:red; font-size: 20px;" class='bi bi-person-x'></i></a>
                            </td>
                            </tr>
                            <?php
                    }
                } ?>
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
