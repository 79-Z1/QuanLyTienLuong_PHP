<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

if (isset($_GET['maCV']))
    $maCV = trim($_GET['maCV']);
else $maCV = "";

if (isset($_GET['tenChucVu']))
    $tenChucVu = trim($_GET['tenChucVu']);
else $tenChucVu = "";

if (isset($_GET['heSoLuong']))
    $heSoLuong = $_GET['heSoLuong'];
else $heSoLuong = "";


$rowsPerPage = 8; //số mẩu tin trên mỗi trang, giả sử là 8

if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
$sqlChucVu = 'select * from chuc_vu ORDER BY HeSoLuong DESC';
$resultChucVu = mysqli_query($conn, $sqlChucVu);
$dsCV=[];
if (mysqli_num_rows($resultChucVu) <> 0) {

    while ($row = mysqli_fetch_array($resultChucVu)) {
       $dsCV=array(
        'MaChucVu'=> $row['MaChucVu'],
        'TenChucVu'=> $row['TenChucVu'],
        'HeSoLuong'=> $row['HeSoLuong']
       );
    }
}

$numRows = mysqli_num_rows($resultChucVu);
$offset = ($_GET['p'] - 1) * $rowsPerPage;

$sql = 'SELECT * FROM chuc_vu LIMIT ' . $offset . ', ' . $rowsPerPage;
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
                            <td><input class="form-control me-2 search-input" type="text" name="maCV" value="<?php echo $maCV; ?>"></td>
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
                            <td><input class="form-control me-2 search-input" type="text" name="heSoLuong" value="<?php echo $heSoLuong; ?>"></td>
                        </tr>
                        <tr > 
                            <td align="center" colspan="4">
                                <input class="btn btn-outline-success search-btn w-25 me-3" name="timkiem" type="submit" value="Tìm kiếm" />
                                <a href="index.php?page=admin-position-add-position" class="btn btn-outline-success search-btn w-25">Thêm</a>
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
                    <th scope="col">Mã chức vụ</th>
                    <th scope="col">Tên chức vụ</th>
                    <th scope="col">Hệ số lương</th>
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
                            <td >{$rows['MaChucVu']}</td>
                            <td >{$rows['TenChucVu']}</td>
                            <td >{$rows['HeSoLuong']}</td>
                            <td >
                                <a href='index.php?page=admin-position-edit-position&maCV={$rows['MaChucVu']}'><i style='color:blue' class='bi bi-pencil-square'></i></a>
                                <a href='index.php?page=admin-position-delete-position&maCV={$rows['MaChucVu']}'><i style='color:red' class='bi bi-person-x'></i></a>
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
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-position&p=1>Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-position&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>';
    } else {
        echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-position&p=" . $i . ">" . $i . "</a> ";
    }
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-position&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-position&p=" . $maxPage . ">Về cuối</a> ";
echo "</div>";
?>

<?php $this->end(); ?>