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


$sqlNV = 'select * from nhan_vien';
$resultNV = mysqli_query($conn, $sqlNV);

$sqlTimKiem =
    "select * from cham_cong where  1 ";
    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
    
    if (isset($_GET['timkiem'])) {
        if ($maCong != "") {
        $sqlTimKiem .= "and MaCong = '$maCong'";
    }
    if ($maNV != "") {
        $sqlTimKiem .= "and MaNV like '%$maNV%'";
    }
    if ($tinhTrang != -1) {
        $sqlTimKiem .= "and TinhTrang = '$tinhTrang'";
    }
    if ($ngay != "") {
        $sqlTimKiem .= "and Ngay = '$ngay'";
    }
    if ($nghiHL !=  -1) {
        $sqlTimKiem .= "and NghiHL = '$nghiHL'";
    }
    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);

    $sqlTimKiem .= "order by MaCong";
    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
    $numRows = mysqli_num_rows($resultTimKiem);
         
}
if(mysqli_num_rows($resultTimKiem) == 0){
    echo "<script type='text/javascript'>
            toastr.error('Không tìm thấy chấm công');
            toastr.options.timeOut = 3000;
        </script>";
}
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
                                <p>Mã công</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maCong" value="<?php echo $maCong; ?>"></td>
                            
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
                                <p>Ngày</p> 
                            </td>
                            <td><input class="form-control me-2 search-input" type="date" name="ngay" value="<?php echo $ngay; ?>"></td>
                        </tr>

                        <tr>
                            <td>
                                <p>Tình trạng</p>
                            </td>
                            <td>
                                <select name="tinhTrang" class="form-select search-option">
                                    <option value="-1" <?php if (isset($_GET['nghiHL']) && $_GET['nghiHL'] == '-1') echo " selected"; ?>>Trống</option>
                                    <option value="0" <?php if (isset($_GET['tinhTrang']) && $_GET['tinhTrang'] == '0') echo " selected"; ?>>Nghỉ</option>
                                    <option value="1" <?php if (isset($_GET['tinhTrang']) && $_GET['tinhTrang'] == '1') echo " selected"; ?>>Đi làm</option>
                                </select>    
                            </td>
                            
                            <td>
                                <p>Nghỉ hưởng lương</p>
                            </td>
                            <td>
                                <select name="nghiHL" class="form-select search-option">
                                    <option value="-1" <?php if (isset($_GET['nghiHL']) && $_GET['nghiHL'] == '-1') echo " selected"; ?>>Trống</option>
                                    <option value="0" <?php if (isset($_GET['nghiHL']) && $_GET['nghiHL'] == '0') echo " selected"; ?>>Không hưởng lương</option>
                                    <option value="1" <?php if (isset($_GET['nghiHL']) && $_GET['nghiHL'] == '1') echo " selected"; ?>>Có hưởng lương</option>
                                    
                                </select>
                            </td>

                            <td >
                                <input class="btn btn-outline-success search-btn w-30" name="timkiem" type="submit" value="Tìm kiếm" />
                                <input type="text" name="page" value="admin-timekeeping" style="display: none">

                            </td>
                            <td >
                                <a href="index.php?page=admin-timekeeping-add" class="btn btn-outline-purple search-btn w-100">Thêm</a>
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
                    <th class="text-center" scope="col">mã công</th>
                    <th class="text-center" scope="col">mã nhân viên</th>
                    <th class="text-center" scope="col">tình trạng</th>
                    <th class="text-center" scope="col">ngày</th>
                    <th class="text-center" class="text-center" scope="col">nghỉ hưởng lương</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                <?php

             
                if (mysqli_num_rows($resultTimKiem) <> 0) {

                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                        if($rows['TinhTrang'] == 0){
                            $tt = "Nghỉ";
                        }else{
                         $tt = "Đi làm";
                        }

                        if($rows['NghiHL'] == 0){
                            $offHL = "<i  style='color:red' class='bi-icon bi-x-circle'></i>";
                        }else{
                         $offHL = " <i style='color:green' class='bi-icon bi-check-circle'></i>";
                        }
                        echo "<tr>
                            <td align='center'>{$rows['MaCong']}</td>
                            <td align='center' >{$rows['MaNV']} </td>
                            <td align='center' >{$tt} </td>
                            <td align='center'>{$rows['Ngay']} </td>
                            <td align='center' >{$offHL} </td>
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