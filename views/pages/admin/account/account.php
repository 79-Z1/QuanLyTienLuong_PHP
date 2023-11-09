<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

if (isset($_GET['tenTK']))
    $tenTK = trim($_GET['tenTK']);
else $tenTK = "";

if (isset($_GET['loaiTK']))
    $loaiTK = $_GET['loaiTK'];
else $loaiTK = "";

if (isset($_GET['maNV']))
    $maNV = $_GET['maNV'];
else $maNV = "";

$sqlNV = 'select * from nhan_vien';
$resultNV = mysqli_query($conn, $sqlNV);

$sqlTK = 'select * from tai_khoan';
$resultTK = mysqli_query($conn, $sqlTK);
$rowsPerPage = 8; //số mẩu tin trên mỗi trang, giả sử là 8

if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
$offset = ($_GET['p'] - 1) * $rowsPerPage;

$sqlTimKiem =
    "SELECT * FROM tai_khoan
            WHERE 1";

if (isset($_GET['timkiem'])) {
    if ($tenTK != "") {
        $sqlTimKiem .= " AND TenTK LIKE '%$tenTK%'";
    }
    if ($loaiTK != "") {
        $sqlTimKiem .= " AND LoaiTK = '$loaiTK'";
    }
    if ($maNV != "") {
        $sqlTimKiem .= " AND MaNV = '$maNV'";
    }
    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
}

$sqlTimKiem .= " ORDER BY TenTK";
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
                                <p>Loại tài khoản</p>
                            </td>
                            <td>
                                <select class="form-select search-option" name="loaiTK">
                                    <optgroup>
                                        <option value="">Trống</option>
                                        <option value="AD">Người Quản Trị</option>
                                        <option value="QL">Quản Lí</option>
                                        <option value="KT">Kế Toán</option>
                                        <option value="NV">Nhân viên</option>
                                    </optgroup>
                                </select>
                            </td>
                            <td>
                                <p>Mã nhân viên</p>
                            </td>
                            <td>
                                <select name="maNV" class="form-select me-10 search-option" id="inputGroupSelect02">
                                    <option value="">Trống</option>
                                    <?php
                                    if (mysqli_num_rows($resultNV) <> 0) {

                                        while ($rows = mysqli_fetch_array($resultNV)) {
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
                                <p>Tên tài khoản</p>
                            </td>
                            <td>
                                <input class="form-control me-2 search-input" type="text" name="tenTK" value="<?php echo $tenTK; ?>">
                            </td>
                            <td colspan="2" align="center">
                                <input style="width: 45%;" class="btn btn-outline-success search-btn me-5" name="timkiem" type="submit" value="Tìm kiếm" />
                                <input name="page" value="admin-account" style="display: none">
                                <a href="index.php?page=admin-account-add" class="btn btn-outline-purple search-btn"  style="width: 45%;" >Thêm</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </nav>
        </div>
    </div>
</div>

<div style="height: 450px">
    <div class="card shadow border-0 mb-3">
        <table class="table table-hover table-nowrap">
            <thead>
                <tr>
                    <th scope="col">Tên tài khoản</th>
                    <th scope="col">Mật khẩu</th>
                    <th scope="col">Loại tài khoản</th>
                    <th scope="col">Mã nhân viên</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                //tổng số trang
                $maxPage = ceil($numRows / $rowsPerPage);
                if (mysqli_num_rows($resultTimKiem) <> 0) {

                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                        echo "<tr>
                            <td>{$rows['TenTK']}</td>
                            <td>{$rows['MatKhau']}</td>
                            <td >{$rows['LoaiTK']}</td>
                            <td>{$rows['MaNV']}</td>
                            <td>
                                <a href='index.php?page=admin-account-edit&TenTK={$rows['TenTK']}'><i style='color:blue' class='bi bi-pencil-square'></i></a>
                                <a href='index.php?page=admin-account-delete&TenTK={$rows['TenTK']}'><i style='color:red' class='bi bi-person-x'></i></a>
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
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-account&tenTK=$tenTK&loaiTK=$loaiTK&maNV=$maNV&p=1>Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-account&tenTK=$tenTK&loaiTK=$loaiTK&maNV=$maNV&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>';
    } else {
        echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-account&tenTK=$tenTK&loaiTK=$loaiTK&maNV=$maNV&p=" . $i . ">" . $i . "</a> ";
    }
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-account&tenTK=$tenTK&loaiTK=$loaiTK&maNV=$maNV&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-account&tenTK=$tenTK&loaiTK=$loaiTK&maNV=$maNV&p=" . $maxPage . ">Về cuối</a> ";
echo "</div>";
?>

<?php $this->end(); ?>