<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

    if (isset($_GET['maPhieu']))
    $maPhieu = $_GET['maPhieu'];
    else $maPhieu = "";

    if (isset($_GET['maNV']))
    $maNV = trim($_GET['maNV']);
    else $maNV = "";

    if (isset($_GET['ngayUng']))
    $ngayUng = trim($_GET['ngayUng']);
    else $ngayUng = "";

    if (isset($_GET['lyDo']))
    $lyDo = trim($_GET['lyDo']);
    else $lyDo = "";

    if (isset($_GET['soTien']))
    $soTien = trim($_GET['soTien']);
    else $soTien = "";

    if (isset($_GET['duyet']))
    $duyet = trim($_GET['duyet']);
    else $duyet = "";

    $sqlPhieuUngLuong = "SELECT * FROM `phieu_ung_luong`";
    $resultPhieuUngLuong = mysqli_query($conn, $sqlPhieuUngLuong);

    $rowsPerPage = 5; //số mẩu tin trên mỗi trang, giả sử là 8

    if (!isset($_GET['p'])) {
        $_GET['p'] = 1;
    }
    $numRows = mysqli_num_rows($resultPhieuUngLuong);
    $offset = ($_GET['p'] - 1) * $rowsPerPage;

    $sql = 'SELECT * FROM phieu_ung_luong LIMIT ' . $offset . ', ' . $rowsPerPage;
    $result = mysqli_query($conn, $sql);
?>
<style>
    .form-control{
     
        padding-left: 50px;
    }
    td{
        padding: 5px;
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
<div class="g-6 mb-3 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 d-flex">
            <nav class="navbar navbar-light bg-light d-flex justify-content-center py-1">
                <form action="" method="get">
                    <table>
                        <tr>
                            <td>
                                <p>Mã phiếu</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maPhieu" value="<?php echo $maPhieu; ?>"></td>
                            
                            <td>
                                <p>Mã nhân viên</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maNV" value="<?php echo $maNV; ?>"></td>
                        </tr>

                        <tr>
                            <td>
                                <p>Ngày ứng</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="ngayUng" value="<?php echo $ngayUng; ?>"></td>
                            
                            <td>
                                <p>Lý do</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="lyDo" value="<?php echo $lyDo; ?>"></td>
                        </tr>

                        <tr >
                            <td >
                                <p>Số tiền</p> 
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="soTien" value="<?php echo $soTien; ?>"></td>
                            
                            <td >
                                <p>Duyệt</p> 
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="duyet" value="<?php echo $duyet; ?>"></td>
                        </tr>
                           
               
                        <tr>
                            <td align="center" margin="5%" colspan="5" >
                                <input class="btn btn-outline-success search-btn" name="timkiem" type="submit" value="Tìm kiếm" />
                            </td>
                        </tr>
                        
                        <tr>
                        <td id="no_color" colspan="5" align="center">
                            
                            <!-- <a href="index.php?page=admin-department-add"> 
                                <input type="submit" value="Thêm" id='them' name="them" class="btn btn-outline-purple themnhanvien-btn w-60" />
                            </a> -->
                            <a class="btn" href="index.php?page=admin-salary-slip-add">Thêm</a>
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
                    <th scope="col">mã phiếu</th>
                    <th scope="col">mã nhân viên</th>
                    <th scope="col">ngày ứng</th>
                    <th scope="col">lý do</th>
                    <th scope="col">số tiền</th>
                    <th scope="col">duyệt</th>
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
                            <td >{$rows['MaPhieu']}</td>
                            <td >{$rows['MaNV']} </td>
                            <td >{$rows['NgayUng']} </td>
                            <td >{$rows['LyDo']} </td>
                            <td >{$rows['SoTien']} </td>
                            <td >{$rows['Duyet']} </td>
                            <td>
                            <a href='index.php?page=admin-salary-slip-edit&MaPhieu={$rows['MaPhieu']}'><i style='color:blue' class='bi bi-pencil-square'></i></a>
                            <a href='index.php?page=admin-salary-slip_delete&MaPhieu={$rows['MaPhieu']}'><i style='color:red' class='bi bi-person-x'></i></a>
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
    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-salary-slip&p=1>Về đầu</a> ";
    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-salary-slip&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
    for ($i = 1; $i <= $maxPage; $i++) {
        if ($i == $_GET['p']) {
            echo '<a class="pagination-link active">' . $i . '</a>';
        } else {
            echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-salary-slip&p=" . $i . ">" . $i . "</a> ";
        }
    }
    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-salary-slip&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-salary-slip&p=" . $maxPage . ">Về cuối</a> ";
    echo "</div>";
?>
<?php $this->end(); ?>