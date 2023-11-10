<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

    if (isset($_GET['maPhieu'])){
    $maPhieu = trim($_GET['maPhieu']);
    }
    else $maPhieu = "";

    if (isset($_GET['maNV'])){
    $maNV = trim($_GET['maNV']);
    }
    else $maNV = "";

    if (isset($_GET['ngayUng'])){
    $ngayUng = trim($_GET['ngayUng']);
    }
    else $ngayUng = "";

    if (isset($_GET['soTien'])){
    $soTien = trim($_GET['soTien']);
    }
    else $soTien = "";

    if (isset($_GET['duyet'])){
    $duyet = trim($_GET['duyet']);
    }
    else $duyet = "";

    $sqlNV = 'select * from nhan_vien';
    $resultNV = mysqli_query($conn, $sqlNV);

    $rowsPerPage = 10; //số mẩu tin trên mỗi trang, giả sử là 8
   
    if (!isset($_GET['p'])) {
        $_GET['p'] = 1;
    }
    $offset = ($_GET['p'] - 1) * $rowsPerPage;
    $sqlTimKiem =
    "select * from phieu_ung_luong where 1 ";

if (isset($_GET['timkiem'])) {
    if ($maPhieu != "") {
        $sqlTimKiem .= " and MaPhieu = '$maPhieu' ";
    }
    if ($maNV != "") {
        $sqlTimKiem .= " and MaNV like '%$maNV%' ";
    }
    if ($ngayUng != "") {
        $sqlTimKiem .= " and NgayUng = '$ngayUng' ";
    }
    if ($soTien != "") {
        $sqlTimKiem .= " and SoTien = '$soTien' ";
    }
    if ($duyet != "") {
        $sqlTimKiem .= " and Duyet = '$duyet' ";
    }

    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
}

    $sqlTimKiem .= " order by MaPhieu";
    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
   
    $numRows = mysqli_num_rows($resultTimKiem);
    
    $sqlTimKiem .= " LIMIT $offset,$rowsPerPage";
    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
  
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
                            <td>
                                <select name="maNV" class="form-select search-option">
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
                            <td >
                                <p>Số tiền</p> 
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="soTien" value="<?php echo $soTien; ?>"></td>
                        </tr>

                        <tr>
                            <td>
                                <p>Ngày ứng</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="date" name="ngayUng" value="<?php echo $ngayUng; ?>"></td>
                            
                           
                        
                            <td >
                                <p>Duyệt</p> 
                            </td>
                            <td>
                            <select name="duyet" class="form-select search-option">
                                    <option value="" <?php if (isset($_GET['duyet']) && $_GET['duyet'] == '') echo " selected"; ?>>Trống</option>
                                    <option value="0" <?php if (isset($_GET['duyet']) && $_GET['duyet'] == '0') echo " selected"; ?>>Chưa duyệt</option>
                                    <option value="1" <?php if (isset($_GET['duyet']) && $_GET['duyet'] == '1') echo " selected"; ?>>Đã duyệt</option>
                                </select>
                            </td>
                            <td>
                                <input class="btn btn-outline-success search-btn " name="timkiem" type="submit" value="Tìm kiếm" />
                                <input type="text" name="page" value="admin-salary-slip" style="display: none">

                            </td>
                            <td >
                                <a href="index.php?page=admin-salary-slip-add" class="btn btn-outline-purple search-btn ">Thêm</a>
                            </td>
                        </tr>
                        
                    </table>

                </form>
            </nav>
        </div>
    </div>
</div>

<div style="height: 550px">

    <div class="card shadow border-0 mb-3">
        <table class="table table-hover table-nowrap">
            <thead>
                <tr>
                    <th class="text-center" scope="col">mã phiếu</th>
                    <th class="text-center" scope="col">mã nhân viên</th>
                    <th class="text-center" scope="col">ngày ứng</th>
                    <th class="text-center" scope="col">lý do</th>
                    <th class="text-center" scope="col">số tiền</th>
                    <th class="text-center" scope="col">duyệt</th>
                    <th class="text-center" scope="col"></th>
                </tr>
            </thead>

            <tbody>
                <?php

                //tổng số trang
                $maxPage = ceil($numRows / $rowsPerPage);
                if (mysqli_num_rows($resultTimKiem) <> 0) {

                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                        if($rows['Duyet'] == 0){
                            $duyetUL = "Chưa duyệt";
                        }else{
                         $duyetUL = "Đã duyệt";
                        }
                        echo "<tr>
                            <td align='center'  >{$rows['MaPhieu']}</td>
                            <td align='center'  >{$rows['MaNV']} </td>
                            <td align='center'  >{$rows['NgayUng']} </td>
                            <td align='center'  >{$rows['LyDo']} </td>
                            <td align='center'  >{$rows['SoTien']} </td>
                            <td align='center'  >{$duyetUL} </td>
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
    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-salary-slip&maPhieu=$maPhieu&maNV=$maNV&ngayUng=$ngayUng&soTien=$soTien&duyet=$duyet&timkiem=Tìm+kiếm&p=1>Về đầu</a> ";
    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-salary-slip&maPhieu=$maPhieu&maNV=$maNV&ngayUng=$ngayUng&soTien=$soTien&duyet=$duyet&timkiem=Tìm+kiếm&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
    for ($i = 1; $i <= $maxPage; $i++) {
        if ($i == $_GET['p']) {
            echo '<a class="pagination-link active">' . $i . '</a>';
        } else {
            echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-salary-slip&maPhieu=$maPhieu&maNV=$maNV&ngayUng=$ngayUng&soTien=$soTien&duyet=$duyet&timkiem=Tìm+kiếm&p=" . $i . ">" . $i . "</a> ";
        }
    }
    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-salary-slip&maPhieu=$maPhieu&maNV=$maNV&ngayUng=$ngayUng&soTien=$soTien&duyet=$duyet&timkiem=Tìm+kiếm&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-salary-slip&maPhieu=$maPhieu&maNV=$maNV&ngayUng=$ngayUng&soTien=$soTien&duyet=$duyet&timkiem=Tìm+kiếm&p=" . $maxPage . ">Về cuối</a> ";
    echo "</div>";
?>
<?php $this->end(); ?>