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
    $thang = $_GET['thang'];
else $thang = "";

if (isset($_GET['nam']))
    $nam = trim($_GET['nam']);
else $nam = "";

if (isset($_GET['soNgayCong']))
    $soNgayCong = trim($_GET['soNgayCong']);
else $soNgayCong = "";

if (isset($_GET['soNgayVang']))
    $soNgayVang = $_GET['soNgayVang'];
else $soNgayVang = "";
if (isset($_GET['luongTangCa']))
    $luongTangCa = trim($_GET['luongTangCa']);
else $luongTangCa = "";

if (isset($_GET['luongTamUng']))
    $luongTamUng = trim($_GET['luongTamUng']);
else $luongTamUng = "";

if (isset($_GET['thue']))
    $thue = $_GET['thue'];
else $thue = "";
if (isset($_GET['truBaoHiem']))
    $truBaoHiem = trim($_GET['truBaoHiem']);
else $truBaoHiem = "";

if (isset($_GET['troCap']))
    $troCap = trim($_GET['troCap']);
else $troCap = "";

if (isset($_GET['thuong']))
    $thuong = $_GET['thuong'];
else $thuong = "";
if (isset($_GET['phat']))
    $phat = trim($_GET['phat']);
else $phat = "";

if (isset($_GET['tienLuongThang']))
    $tienLuongThang = trim($_GET['tienLuongThang']);
else $tienLuongThang = "";

if (isset($_GET['tongThuNhap']))
    $tongThuNhap = $_GET['tongThuNhap'];
else $tongThuNhap = "";

if (isset($_GET['thucLinh']))
    $thucLinh = trim($_GET['thucLinh']);
else $thucLinh = "";

if (isset($_GET['ghiChu']))
    $ghiChu = trim($_GET['ghiChu']);
else $ghiChu = "";



$rowsPerPage = 7; //số mẩu tin trên mỗi trang, giả sử là 8

if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
$sqlPhieuLuong = 'select * from phieu_luong ';
$resultPhieuLuong = mysqli_query($conn, $sqlPhieuLuong);
// $dsPL=[];
// if (mysqli_num_rows($resultPhieuLuong) <> 0) {

//     while ($row = mysqli_fetch_array($resultPhieuLuong)) {
//        $dsCV=array(
//         'MaPhieuLuong'=> $row['MaPhieuLuong'],
//         'MaNV'=> $row['MaNV'],
//         'Thang'=> $row['Thang'],
//         'Nam'=> $row['Nam'],
//         'SoNgayCong'=> $row['SoNgayCong'],
//         'SoNgayVang'=> $row['SoNgayVang'],
//         'LuongTangCa'=> $row['LuongTangCa'],
//         'TienTamUng'=> $row['TienTamUng'],
//         'Thue'=> $row['Thue'],
//         'TruBaoHiem'=> $row['TruBaoHiem'],
//         'TroCap'=> $row['TroCap'],
//         'Thuong'=> $row['Thuong'],
//         'Phat'=> $row['Phat'],
//         'TienLuongThang'=> $row['TienLuongThang'],
//         'TongThuNhap'=> $row['TongThuNhap'],
//         'ThucLinh'=> $row['ThucLinh'],
//         'GhiChu'=> $row['GhiChu']
//        );
//     }
// }

$numRows = mysqli_num_rows($resultPhieuLuong);
$offset = ($_GET['p'] - 1) * $rowsPerPage;

$sql = 'SELECT * FROM phieu_luong LIMIT ' . $offset . ', ' . $rowsPerPage;
$result = mysqli_query($conn, $sql);

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
                                <p>Mã chức vụ</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maCV" value=""></td>
                            <td>
                                <p>Tên chức vụ</p>
                            </td>
                            <td>

                                <select name="chucVu" class="form-select search-option" id="inputGroupSelect02">
                                    <option value="">Trống</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <p>Hệ số lương</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="heSoLuong" value=""></td>
                        </tr>
                        <tr > 
                            <td align="center" colspan="4">
                                <input class="btn btn-outline-success search-btn w-25 me-3" name="timkiem" type="submit" value="Tìm kiếm" />
                                <a href="index.php?page=admin-paycheck-add-paycheck" class="btn btn-outline-success search-btn w-25">Thêm</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </nav>
        </div>
    </div>
</div>

<div>
    <div class="card shadow border-0 mb-3" style="height: 450px;">
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

                if (mysqli_num_rows($result) <> 0) {

                    while ($rows = mysqli_fetch_array($result)) {
                        echo "<tr>
                            <td>{$rows['MaPhieuLuong']}</td>
                            <td >{$rows['MaNV']}</td>
                            <td >{$rows['Thang']}</td>
                            <td >{$rows['SoNgayCong']}</td>
                            <td >{$rows['SoNgayVang']}</td>
                            <td >{$rows['TienLuongThang']}</td>
                            <td >{$rows['ThucLinh']}</td>
                            <td >
                                <a href='index.php?page=admin-paycheck-info-paycheck&maPL={$rows['MaPhieuLuong']}'><i style='color:green' class='bi bi-person-lines-fill '></i></a>
                                <a href='index.php?page=admin-paycheck-edit-paycheck&maPL={$rows['MaPhieuLuong']}'><i style='color:blue' class='bi bi-pencil-square'></i></a>
                                <a href='index.php?page=admin-paycheck-delete-paycheck&maPL={$rows['MaPhieuLuong']}'><i style='color:red' class='bi bi-person-x'></i></a>
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
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-paycheck&p=1>Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-paycheck&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>';
    } else {
        echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-paycheck&p=" . $i . ">" . $i . "</a> ";
    }
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-paycheck&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-paycheck&p=" . $maxPage . ">Về cuối</a> ";
echo "</div>";
?>

<?php $this->end(); ?>
