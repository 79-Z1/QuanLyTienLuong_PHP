<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

if (isset($_GET['maNV']))
    $maNV = trim($_GET['maNV']);
else $maNV = "";

if (isset($_GET['phong']))
    $maPhong = $_GET['phong'];
else $maPhong = "";

$rowsPerPage = 8; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
$sqlPhong = 'select * from phong_ban';
$resultPhong = mysqli_query($conn, $sqlPhong);

// $sqlPhongBan = 'SELECT * FROM phong_ban';
// $resultPhongBan = mysqli_query($conn, $sqlPhongBan);


//vị trí của mẩu tin đầu tiên trên mỗi trang
$numRows = mysqli_num_rows($resultPhong);
$offset = ($_GET['p'] - 1) * $rowsPerPage;

$sql = 'SELECT * FROM phong_ban LIMIT ' . $offset . ',' . $rowsPerPage;
$result = mysqli_query($conn, $sql);


?>
<style>
.pagination-link {
    display: inline-block;
    padding: 3px 5px;
    margin: 1PX ;
    border: 1px solid #ccc;
    text-decoration: none;
    color: #333;
    font-size: 12px;
    border-radius: 15px;
}

.pagination-link.active {
    background-color: #333;
    color: #fff;

}

.pagination-link:not(.active) {
    font-weight: 400;
    font-size: 12px;
    color: #666;
}
</style>
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

                                <!-- <select name="phong" class="form-select search-option" id="inputGroupSelect02">
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
                                </select> -->
                            </td>
                        </tr>
                        <tr  >
                            <td colspan="4"  align="center"  >
                                <input class="btn btn-outline-success search-btn me-3" name="timkiem" type="submit" value="Tìm kiếm" /> 
                                <a href="index.php?page=admin-department-add" class="btn btn-outline-purple themnhanvien-btn w-60">Thêm</a>
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
                $maxPage = floor($numRows / $rowsPerPage) + 1;
                if (mysqli_num_rows($result) <> 0) {

                    while ($rows = mysqli_fetch_array($result)) {
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
        </table>
    </div>
</div>
</div>
<?php
echo '<div align="center">';
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-department&p=1 >Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-department&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>'; //trang hiện tại sẽ được bôi đậm
    } else
        echo "<a class='pagination-link'  href=" . $_SERVER['PHP_SELF'] . "?page=admin-department&p=" . $i . ">" . $i . "</a> ";
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-department&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-department&p=" . ($maxPage) . ">Về cuối</a> ";
echo "</div>";
?>
<?php $this->end(); ?>