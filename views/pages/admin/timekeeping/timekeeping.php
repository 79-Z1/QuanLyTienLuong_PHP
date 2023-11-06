<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

if (isset($_GET['maCong']))
    $maCong = $_GET['maCong'];
else $maCong = "";

    if (isset($_GET['maNV']))
    $maNV = trim($_GET['maNV']);
else $maNV = "";

if (isset($_GET['tinhTrang']))
    $tinhTrang = $_GET['tinhTrang'];
else $tinhTrang = "";

if (isset($_GET['ngay']))
    $ngay = $_GET['ngay'];
else $ngay = "";

if (isset($_GET['nghiHL']))
    $nghiHL = $_GET['nghiHL'];
else $nghiHL = "";

$rowsPerPage = 8; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset = ($_GET['p'] - 1) * $rowsPerPage;

$sqlTimKiem =
    "select * from cham_cong
    where  1
    ";
    
    
    if (isset($_GET['timkiem'])) {
        if ($maCong != "") {
        $sqlTimKiem .= "and MaCong = '$maCong'";
    }
    if ($maNV != "") {
        $sqlTimKiem .= "and MaNV = '$maNV'";
    }
    if ($tinhTrang != "") {
        $sqlTimKiem .= "and TinhTrang = '$tinhTrang'";
    }
    if ($ngay != "") {
        $sqlTimKiem .= "and Ngay = '$ngay'";
    }
    if ($nghiHL !=  "") {
        $sqlTimKiem .= "and NghiHL = '$nghiHL'";
    }
    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
    $sqlTimKiem .= "order by MaCong";
    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
    $numRows = mysqli_num_rows($resultTimKiem);
    $sqlTimKiem .= " LIMIT $offset,$rowsPerPage";
    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);

       //tổng số trang
                $maxPage = ceil($numRows / $rowsPerPage);
}else{
    $sqlTimKiem;
    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
}



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
                                <p>Mã công</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maCong" value="<?php echo $maCong; ?>"></td>
                            
                            <td>
                                <p>Mã nhân viên</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maNV" value="<?php echo $maNV; ?>"></td>
                        </tr>

                        <tr>
                            <td>
                                <p>Tình trạng</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="tinhTrang" value="<?php echo $tinhTrang; ?>"></td>
                            
                            <td>
                                <p>Nghỉ hưởng lương</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="nghiHL" value="<?php echo $nghiHL; ?>"></td>
                        </tr>

                        <tr >
                            <td >
                                <p>Ngày</p> 
                            </td>
                            <td><input class="form-control me-2 search-input" type="date" name="ngay" value="<?php echo $ngay; ?>"></td>
                        </tr>
                           
               
                        <tr>
                            <td align="center" margin="5%" colspan="5" >
                                <input class="btn btn-outline-success search-btn" name="timkiem" type="submit" value="Tìm kiếm" />
                                <input type="text" name="page" value="admin-timekeeping" style="display: none">
                            </td>
                        </tr>
                        
                        <tr>
                        <td id="no_color" colspan="5" align="center">
                            
                            <!-- <a href="index.php?page=admin-department-add"> 
                                <input type="submit" value="Thêm" id='them' name="them" class="btn btn-outline-purple themnhanvien-btn w-60" />
                            </a> -->
                            
                            <a class="btn" href="index.php?page=admin-timekeeping-add">Thêm</a>
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
                    <th scope="col">mã công</th>
                    <th scope="col">mã nhân viên</th>
                    <th scope="col">tình trạng</th>
                    <th scope="col">ngày</th>
                    <th scope="col">nghỉ hưởng lương</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                <?php

             
                if (mysqli_num_rows($resultTimKiem) <> 0) {

                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                        echo "<tr>
                            <td >{$rows['MaCong']}</td>
                            <td >{$rows['MaNV']} </td>
                            <td >{$rows['TinhTrang']} </td>
                            <td >{$rows['Ngay']} </td>
                            <td >{$rows['NghiHL']} </td>
                            <td>
                            <a href='index.php?page=admin-timekeeping-edit&MaCong={$rows['MaCong']}'><i style='color:blue' class='bi bi-pencil-square'></i></a>
                            <a href='index.php?page=admin-timekeeping-delete&MaCong={$rows['MaCong']}'><i style='color:red' class='bi bi-person-x'></i></a>
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
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-timekeeping&maCong=$maCong&maNV=$maNV&tinhTrang=$tinhTrang&nghiHL=$nghiHL&ngay=$ngay&timkiem=Tìm+kiếm&page=admin-timekeeping&p=" . (1) . ">Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-timekeeping&maCong=$maCong&maNV=$maNV&tinhTrang=$tinhTrang&nghiHL=$nghiHL&ngay=$ngay&timkiem=Tìm+kiếm&page=admin-timekeeping&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>'; //trang hiện tại sẽ được bôi đậm
    } else
        echo "<a class='pagination-link'  href=" . $_SERVER['PHP_SELF'] . "?page=admin-timekeeping&maCong=$maCong&maNV=$maNV&tinhTrang=$tinhTrang&nghiHL=$nghiHL&ngay=$ngay&timkiem=Tìm+kiếm&page=admin-timekeeping&p=" . $i . ">" . $i . "</a> ";
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-timekeeping&maCong=$maCong&maNV=$maNV&tinhTrang=$tinhTrang&nghiHL=$nghiHL&ngay=$ngay&timkiem=Tìm+kiếm&page=admin-timekeeping&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-timekeeping&maCong=$maCong&maNV=$maNV&tinhTrang=$tinhTrang&nghiHL=$nghiHL&ngay=$ngay&timkiem=Tìm+kiếm&page=admin-timekeeping&p=" . ($maxPage) . ">Về cuối</a> ";
echo "</div>";
?>
<?php $this->end(); ?>