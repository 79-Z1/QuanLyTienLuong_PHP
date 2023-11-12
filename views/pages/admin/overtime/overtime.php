<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

if (isset($_GET['maTC']))
    $maTC = trim($_GET['maTC']);
else $maTC = "";
if (isset($_GET['maNV']))
    $maNV = trim($_GET['maNV']);
else $maNV = "";
if (isset($_GET['ngayTC']))
    $ngayTC = trim($_GET['ngayTC']);
else $ngayTC = "";

if (isset($_GET['loaiTC']))
    $loaiTC = $_GET['loaiTC'];
else $loaiTC = "";


$rowsPerPage = 10;

if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}

$sqlNhanVien = 'select * from nhan_vien';
$resultNhanVien = mysqli_query($conn, $sqlNhanVien);

$offset = ($_GET['p'] - 1) * $rowsPerPage;
$sqlTimKiem =
    "select * from tang_ca where 1 ";

if (isset($_GET['timkiem'])) {
    if ($maTC != "") {
        $sqlTimKiem .= "and MaTC like '%$maTC%' ";
    }
    if ($maNV != "") {
        $sqlTimKiem .= "and MaNV = '$maNV' ";
    }
    if ($ngayTC != "") {
        $sqlTimKiem .= "and NgayTC = '$ngayTC' ";
    }
    if ($loaiTC != "") {
        $sqlTimKiem .= "and LoaiTC = '$loaiTC' ";
    }

    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
    if(mysqli_num_rows($resultTimKiem) == 0){
        echo "<script type='text/javascript'>
                toastr.error('Không tìm thấy phiếu tăng ca này');
                toastr.options.timeOut = 3000;
            </script>";
    }
}

$sqlTimKiem .= " order by MaTC";
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
                                <p>Mã tăng ca</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maTC" value="<?php echo $maTC; ?>"></td>
                            <td>
                                <p>Mã nhân viên</p>
                            </td>
                            <td>
                                <select name="maNV" class="form-select search-option">
                                    <option value="">Trống</option>
                                    <?php
                                    if (mysqli_num_rows($resultNhanVien) <> 0) {

                                        while ($rows = mysqli_fetch_array($resultNhanVien)) {
                                            echo "<option ";
                                            if (isset($_GET['maNV']) && $_GET['maNV'] == $rows['MaNV']) echo "selected";
                                            echo ">$rows[MaNV]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td >
                                <input class="btn btn-outline-success search-btn" name="timkiem" type="submit" value="Tìm kiếm" />
                                <input type="text" name="page" value="admin-overtime" style="display: none">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Ngày tăng ca</p>
                            </td>
                            <td>
                                <input class="form-control me-2 search-input" type="date" name="ngayTC" value="<?php echo $ngayTC; ?>">
                            </td>
                            <td>
                                <p>Loại tăng ca</p>
                            </td>
                            <td>
                                <select name="loaiTC" class="form-select search-option">
                                    <option value="">Trống</option>
                                    <option value="0" <?php if (isset($_GET['loaiTC']) && $_GET['loaiTC'] == '0') echo " selected"; ?>>Ngày thường</option>
                                    <option value="1" <?php if (isset($_GET['loaiTC']) && $_GET['loaiTC'] == '1') echo " selected"; ?>>Nghỉ hàng tuần</option>
                                    <option value="2" <?php if (isset($_GET['loaiTC']) && $_GET['loaiTC'] == '2') echo " selected"; ?>>Nghỉ lễ</option>
                                </select>
                            </td>
                            <td >
                                <a href="index.php?page=admin-overtime-add-overtime" class="btn btn-outline-purple search-btn ">Thêm</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </nav>
        </div>
    </div>
</div>

<div style="height: 74%">
    <div class="card shadow border-0 mb-3">
        <table class="table table-hover table-nowrap">
            <thead>
                <tr>
                    <th scope="col">Mã tăng ca</th>
                    <th scope="col">Mã nhân viên</th>
                    <th scope="col">Ngày tăng ca</th>
                    <th scope="col">Loại tăng ca</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                //tổng số trang
                $maxPage = ceil($numRows / $rowsPerPage);
                if (mysqli_num_rows($resultTimKiem) <> 0) {

                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                        if ($rows['LoaiTC'] == 0) {
                            $LoaiTC = "Ngày thường";
                        } else if ($rows['LoaiTC'] == 1) {
                            $LoaiTC = "Nghỉ hàng tuần";
                        } else $LoaiTC = "Nghỉ lễ";
                        echo "<tr>
                            <td >{$rows['MaTC']}</td>
                            <td >{$rows['MaNV']}</td>
                            <td >{$rows['NgayTC']}</td>
                            <td >{$LoaiTC}</td>
                            <td >
                                <a href='index.php?page=admin-overtime-edit-overtime&maTC={$rows['MaTC']}'><i style='color:blue' class='bi bi-pencil-square'></i></a>
                                <a href='index.php?page=admin-overtime-delete-overtime&maTC={$rows['MaTC']}'><i style='color:red' class='bi bi-person-x'></i></a>
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
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-overtime&maTC=$maTC&maNV=$maNV&ngayTC=$ngayTC&loaiTC=$loaiTC&timkiem=Tìm+kiếm&p=1>Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-overtime&maTC=$maTC&maNV=$maNV&ngayTC=$ngayTC&loaiTC=$loaiTC&timkiem=Tìm+kiếm&page=admin-overtime=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>';
    } else {
        echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-overtime&maTC=$maTC&maNV=$maNV&ngayTC=$ngayTC&loaiTC=$loaiTC&timkiem=Tìm+kiếm&p=" . $i . ">" . $i . "</a> ";
    }
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-overtime&maTC=$maTC&maNV=$maNV&ngayTC=$ngayTC&loaiTC=$loaiTC&timkiem=Tìm+kiếm&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-overtime&maTC=$maTC&maNV=$maNV&ngayTC=$ngayTC&loaiTC=$loaiTC&timkiem=Tìm+kiếm&p=" . $maxPage . ">Về cuối</a> ";
echo "</div>";
?>
<?php $this->end(); ?>