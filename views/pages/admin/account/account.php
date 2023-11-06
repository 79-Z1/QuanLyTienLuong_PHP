<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

if (isset($_GET['tenTK']))
    $tenTK = trim($_GET['tenTK']);
else $tenTK = "";

if (isset($_GET['matKhau']))
    $matKhau = trim($_GET['matKhau']);
else $matKhau = "";

if (isset($_GET['loaiTK']))
    $loaiTK = $_GET['loaiTK'];
else $loaiTK = "";

if (isset($_GET['maNV']))
    $maNV = $_GET['maNV'];
else $maNV = "";

$sqlNV = 'select * from nhan_vien';
$resultNV = mysqli_query($conn, $sqlNV);
$rowsPerPage = 8; //số mẩu tin trên mỗi trang, giả sử là 8

if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
$offset = ($_GET['p'] - 1) * $rowsPerPage;

$sqlTimKiem =
    "select * from tai_khoan
            where 1";

if (isset($_GET['timkiem'])) {
    if ($tenTK != "") {
        $sqlTimKiem .= " and TenTK = '$tenTK'";
    }
    if ($matKhau != "") {
        $sqlTimKiem .= " and MatKhau = '$matKhau'";
    }
    if ($loaiTK != "") {
        $sqlTimKiem .= " and LoaiTK = '$loaiTK'";
    }
    if ($maNV != "") {
        $sqlTimKiem .= " and MaNV = '$maNV'";
    }

    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
}

$sqlTimKiem .= " order by TenTK";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);
$numRows = mysqli_num_rows($resultTimKiem);
$sqlTimKiem .= " LIMIT $offset,$rowsPerPage";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);

?>
<style>
    table img {
    width: 50px;
    height: 50px;
    border-radius: 5px;
    border: 1.5px solid black;
}

table {
    border-collapse: collapse;
    width: 100%;
}
td{
    padding: 5px;
    padding-right:20px;
    
}
.table-hover tbody td {
    padding: 13px 10px 13px 25px;

}
.table-hover tbody td a i{
    font-size:22px;
    margin-right: 8px;
}

p {
    font-size: 18px;
    font-weight: bold;
    height: 30px;
}
label{
    margin-right: 5px;
}

input[type="radio"] {
    transform: scale(1.6);
    margin-right: 5px;
    margin-left: 15px;
}
.form-select{
    padding: 0.375rem 2.25rem 0.375rem 0.75rem;
}
.card .navbar {
    padding: 0;
    border-radius: 10px;
}

.larger-text {
    font-size: 20px;
    /* Điều chỉnh kích thước chữ theo nhu cầu */
    margin-right: 20px;
    /* Điều chỉnh khoảng cách giữa nút radio và văn bản */
}

.form-control {
    height: 30px;
}

a {
    text-decoration: none;
    color: blue;
    font-size: 16px;
}

.search-btn {
    width: 100%;

}

.search-btn span {
    margin-right: 5px;
}

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
                                <p>Tên tài khoản</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="tenTK" value="<?php echo $tenTK; ?>"></td>
                            <td>
                                <p>Mã nhân viên</p>
                            </td>
                            <td>
                                <select name="maNV" class="form-select search-option" id="inputGroupSelect02">
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
                                <p>Mật khẩu</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="matKhau" value="<?php echo $matKhau; ?>"></td>
                            <td>
                                <p>Loại tài khoản</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="loaiTK" value="<?php echo $loaiTK; ?>"></td>
                        </tr>
                        <tr > 
                            <td align="center" colspan="4">
                                <input class="btn btn-outline-success search-btn w-25 me-3" name="timkiem" type="submit" value="Tìm kiếm" />
                                <input type="text" name="page" value="admin-account" style="display: none">
                                <a href="index.php?page=admin-account-add" class="btn btn-outline-success search-btn w-25">Thêm</a>
                                
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
                            <td >{$rows['TenTK']}</td>
                            <td >{$rows['MatKhau']}</td>
                            <td >{$rows['LoaiTK']}</td>
                            <td >{$rows['MaNV']}</td>
                            <td >
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
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-account&tenTK=$tenTK&matKhau=$matKhau&loaiTK=$loaiTK&maNV=$maNV&p=1>Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-account&tenTK=$tenTK&matKhau=$matKhau&loaiTK=$loaiTK&maNV=$maNV&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>';
    } else {
        echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-account&tenTK=$tenTK&matKhau=$matKhau&loaiTK=$loaiTK&maNV=$maNV&p=" . $i . ">" . $i . "</a> ";
    }
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-account&tenTK=$tenTK&matKhau=$matKhau&loaiTK=$loaiTK&maNV=$maNV&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-account&tenTK=$tenTK&matKhau=$matKhau&loaiTK=$loaiTK&maNV=$maNV&p=" . $maxPage . ">Về cuối</a> ";
echo "</div>";
?>

<?php $this->end(); ?>