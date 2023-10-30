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


$sqlChamCong = "SELECT * FROM `cham_cong`";
$resultChamCong = mysqli_query($conn, $sqlChamCong);

// $sqlTimKiem =
//     "select *, TenPhong, TenChucVu from nhan_vien, chuc_vu, phong_ban
//             where nhan_vien.MaPhong = phong_ban.MaPhong 
//             and nhan_vien.MaChucVu = chuc_vu.MaChucVu
//         ";

// if (isset($_GET['timkiem'])) {
//     if ($maCong != "") {
//         $sqlTimKiem .= "and MaCong = '$maCong'";
//     }
//     if ($maNV != "") {
//         $sqlTimKiem .= "and concat(HoNV,' ',TenNV) like '%$hoTen%'";
//     }
//     if ($maPhong != "") {
//         $sqlTimKiem .= "and nhan_vien.MaPhong = '$maPhong'";
//     }
//     if ($maChucVu != "") {
//         $sqlTimKiem .= "and nhan_vien.MaChucVu = '$maChucVu'";
//     }
//     if ($gioiTinh != "-1" && $gioiTinh != "") {
//         $sqlTimKiem .= "and GioiTinh = '$gioiTinh'";
//     }



//     $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
// }
// $sqlTimKiem .= "order by MaNV";
// $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
// $numRows = mysqli_num_rows($resultTimKiem);
// $sqlTimKiem .= " LIMIT $offset,$rowsPerPage";
// $resultTimKiem = mysqli_query($conn, $sqlTimKiem);

?>
<style>
    .form-control{
     
        padding-left: 50px;
    }
    td{
        padding: 5px;
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
                            <td><input class="form-control me-2 search-input" type="text" name="ngay" value="<?php echo $ngay; ?>"></td>
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

                //tổng số trang
                // $maxPage = floor($numRows / $rowsPerPage) + 1;
                if (mysqli_num_rows($resultChamCong) <> 0) {

                    while ($rows = mysqli_fetch_array($resultChamCong)) {
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
<?php $this->end(); ?>