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


$rowsPerPage = 8; //số mẩu tin trên mỗi trang, giả sử là 8

if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
$sqlTangCa = 'select * from tang_ca ORDER BY MaTC ASC';
$resultTangCa = mysqli_query($conn, $sqlTangCa);

$sqlNhanVien = 'select * from nhan_vien';
$resultNhanVien = mysqli_query($conn, $sqlNhanVien);

$dsTC = [];
if (mysqli_num_rows($resultTangCa) <> 0) {

    while ($row = mysqli_fetch_array($resultTangCa)) {
        $dsTC = array(
            'MaTC' => $row['MaTC'],
            'MaNV' => $row['MaNV'],
            'NgayTC' => $row['NgayTC'],
            'LoaiTC' => $row['LoaiTC']
        );
    }
}

$numRows = mysqli_num_rows($resultTangCa);
$offset = ($_GET['p'] - 1) * $rowsPerPage;

$sql = 'SELECT * FROM tang_ca LIMIT ' . $offset . ', ' . $rowsPerPage;
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
                                <p>Mã tăng ca</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maTC" value="<?php echo $maTC; ?>"></td>
                            <td>
                                <p>Mã nhân viên</p>
                            </td>
                            <td>
                                <select name="maNV" class="form-select search-option">
                                    <option value="">Trống</option>
                                </select>
                            </td>



                        </tr>
                        <tr>
                            <td>
                                <p>Ngày tăng ca</p>
                            </td>
                            <td>
                                <input class="form-control me-2 search-input" type="date" name="maNV" value="<?php echo $ngayTC; ?>">
                            </td>
                            <td>
                                <p>Loại tăng ca</p>
                            </td>
                            <td>
                                <input class="form-control me-2 search-input" type="text" name="ngayTC" value="<?php echo $ngayTC; ?>">
                            </td>
                        </tr>
                        <tr align="center" colspan="4">
                            <td align="end" colspan="2">
                                <input class="btn btn-outline-success search-btn w-50" name="timkiem" type="submit" value="Tìm kiếm" />
                            </td>
                            <td align="start" colspan="2">
                                <a href="index.php?page=admin-overtime-add-overtime" class="btn btn-outline-success search-btn w-50">Thêm</a>
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
                $maxPage = floor($numRows / $rowsPerPage) + 1;
                if (mysqli_num_rows($result) <> 0) {

                    while ($rows = mysqli_fetch_array($result)) {
                        echo "<tr>
                            <td >{$rows['MaTC']}</td>
                            <td >{$rows['MaNV']}</td>
                            <td >{$rows['NgayTC']}</td>
                            <td >{$rows['LoaiTC']}</td>
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
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-overtime&p=1>Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-overtime&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>';
    } else {
        echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-overtime&p=" . $i . ">" . $i . "</a> ";
    }
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-overtime&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-overtime&p=" . $maxPage . ">Về cuối</a> ";
echo "</div>";
?>
<?php $this->end(); ?>