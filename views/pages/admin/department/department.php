<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

if (isset($_GET['maPhong']))
    $maPhong = trim($_GET['maPhong']);
else $maPhong = "";

if (isset($_GET['tenPhong']))
    $tenPhong = trim($_GET['tenPhong']);
else $tenPhong = "";

$rowsPerPage = 11; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
$offset = ($_GET['p'] - 1) * $rowsPerPage;
$sqlTimKiem =
    "select * from phong_ban where 1";


if (isset($_GET['timkiem'])) {
    if ($maPhong != "") {
        $sqlTimKiem .= " and MaPhong like '%$maPhong%'";
    }

    if ($tenPhong != "") {
        $sqlTimKiem .= " and TenPhong like '%$tenPhong%'";
    }

    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
}
$sqlTimKiem .= " order by MaPhong";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);
$numRows = mysqli_num_rows($resultTimKiem);
$sqlTimKiem .= " LIMIT $offset,$rowsPerPage";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);

if(mysqli_num_rows($resultTimKiem) == 0){
    echo "<script type='text/javascript'>
            toastr.error('Không tìm thấy phòng ban này');
            toastr.options.timeOut = 3000;
        </script>";
}
?>
<style>
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

.form-select{
    padding: 0.375rem 2.25rem 0.375rem 0.75rem;
}
.card .navbar {
    padding: 0;
    border-radius: 10px;
}

.larger-text {
    font-size: 20px;
    margin-right: 20px;
}

.form-control {
    height: 30px;
}

a {
    text-decoration: none;
    color: blue;
    font-size: 16px;
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
                                <p>Mã phòng</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maPhong" value="<?php echo $maPhong; ?>"></td>
                            <td>
                                <p>Phòng</p>
                            </td>
                            
                            <td><input class="form-control me-2 search-input" type="text" name="tenPhong" value="<?php echo $tenPhong; ?>"></td>
                              
                            <td colspan="4"  align="center"  >
                                <input class="btn btn-outline-success search-btn me-3" name="timkiem" type="submit" value="Tìm kiếm" /> 
                                <input type="text" name="page" value="admin-department" style="display: none">
                                <a href="index.php?page=admin-department-add" class="btn btn-outline-purple themnhanvien-btn w-60">Thêm</a>
                                </td>
                        </tr>
                       
                            
                        
                    </table>
                </form>
            </nav>
        </div>
    </div>
</div>

<div style="height: 605px">

    <div class="card shadow border-0 mb-3">
        <table class="table table-hover table-nowrap">
            <thead>
                <tr>
                    <th scope="col">mã phòng</th>
                    <th scope="col">tên phòng</th>
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
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-department&maPhong=$maPhong&tenPhong=$tenPhong&p=1 >Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-department&maPhong=$maPhong&tenPhong=$tenPhong&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>'; //trang hiện tại sẽ được bôi đậm
    } else
        echo "<a class='pagination-link'  href=" . $_SERVER['PHP_SELF'] . "?page=admin-department&maPhong=$maPhong&tenPhong=$tenPhong&p=" . $i . ">" . $i . "</a> ";
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-department&maPhong=$maPhong&tenPhong=$tenPhong&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-department&maPhong=$maPhong&tenPhong=$tenPhong&p=" . ($maxPage) . ">Về cuối</a> ";
echo "</div>";
?>
<?php $this->end(); ?>