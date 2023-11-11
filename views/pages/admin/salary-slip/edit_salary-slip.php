<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

        $conn = mysqli_connect ('localhost', 'root', '', 'quan_ly_tien_luong') 
        OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
    $maPhieu = $_GET["MaPhieu"];
    $getPhieuUngLuong= "select * from phieu_ung_luong where MaPhieu='$maPhieu'";   
    $resultPhieuUngLuong = mysqli_query($conn, $getPhieuUngLuong);
    $row = mysqli_fetch_array($resultPhieuUngLuong, MYSQLI_ASSOC);

    $getmanv = "SELECT MaNV FROM `nhan_vien` 
    order by MaNV";
    $resultmanv = mysqli_query($conn, $getmanv);

    if (isset($_POST['maPhieu']))
    $maPhieu = $_POST['maPhieu'];
    else $maPhieu = $row['MaPhieu'];

    if (isset($_POST['MaNV']))
    $MaNV = $_POST['MaNV'];
    

    if (isset($_POST['ngayUng']))
    $ngayUng = trim($_POST['ngayUng']);
    else $ngayUng = $row['NgayUng'];

    if (isset($_POST['lyDo']))
    $lyDo = trim($_POST['lyDo']);
    else $lyDo = $row['LyDo'];

    if (isset($_POST['soTien']))
    $soTien = trim($_POST['soTien']);
    else $soTien = $row['SoTien'];

    if (isset($_POST['duyet']))
    $duyet = trim($_POST['duyet']);
    else $duyet = $row['Duyet'];

    if (isset($_POST['edit'])) {
        $err = array();
        
        if (empty($MaNV)) {
            $err[] = "Vui lòng nhập tên chức vụ";
        }
        if (empty($ngayUng)) {
            $err[] = "Vui lòng nhập tên chức vụ";
        }
        if (empty($lyDo)) {
            $err[] = "Vui lòng nhập tên chức vụ";
        }
        if (empty($soTien)) {
            $err[] = "Vui lòng nhập hệ số lương";
        } elseif (!is_numeric($duyet)) {
            $err[] = "Hệ số lương phải là một số";
        }
    
        if (empty($err)) {
            $sqlupdate = "UPDATE `phieu_ung_luong` SET `MaNV`='$MaNV',`NgayUng`='$ngayUng',`LyDo`='$lyDo', `SoTien`=$soTien ,`Duyet`=$duyet
            WHERE MaPhieu='$maPhieu'";
            $resultupdate = mysqli_query($conn, $sqlupdate);
            $MaNV = $_POST['MaNV'];
            $ngayUng = $_POST['ngayUng'];
            $lyDo = $_POST['lyDo'];
            $soTien = $_POST['soTien'];
            $duyet = $_POST['duyet'];
            echo "<script type='text/javascript'>toastr.success('Sửa phiếu ứng lương thành công'); toastr.options.timeOut = 3000;</script>";
        } else {
            echo "<script>";
            foreach ($err as $error) {
                echo "<script type='text/javascript'>toastr.error('$error'); toastr.options.timeOut = 3000;</script>";
            }
           
        }
    }
?>

<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">CHỈNH SỬA PHIẾU ỨNG LƯƠNG</h5>
            </div>
            <div class="table-responsive">
            <form align='center' action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <tr>
                    <td>Mã Phiếu</td>                    
                    <td> 
                        <input class="form-control py-2" type="text" size="20" name="maPhieu" value="<?php echo $row["MaPhieu"]; ?> "disabled/></td>
                    </td>
                    <td>Mã Nhân Viên</td>
                    <td>            
                        <select name="MaNV" class="form-select search-option">
                                <option value="">Trống</option>
                                <?php
                                if (mysqli_num_rows($resultmanv ) <> 0) {

                                    while ($rows = mysqli_fetch_array($resultmanv )) {
                                        echo "<option value='$rows[MaNV]'";
                                        if (isset($_POST['MaNV']) && $_POST['MaNV'] == $rows['MaNV'] || $rows['MaNV']==$row['MaNV'] ) echo "selected";
                                        echo ">$rows[MaNV]</option>";
                                    }
                                }
                                ?>
                            </select>
                    </td>
                        
                    </tr>
                    <tr>
                            <td>
                                <p>Số tiền</p>
                            </td>
                            <td class="<?php if($soTien == "") echo 'required'; ?>">
                            <input class="td-control py-2" type="text" size="20" name="soTien" value="<?php echo $soTien; ?>">VND</td>
                            
                            
                            <td>
                                <p>Duyệt</p>
                            </td>
                            <td class="<?php if($duyet == "") echo 'required'; ?>">
                                
                            
                            <select name="duyet" class="form-select search-option">
                                    <option value="0" <?php if($duyet == '0') echo " selected"; ?>>Chưa duyệt</option>
                                    <option value="1" <?php if($duyet == '1') echo " selected"; ?>>Đã duyệt</option>
                            </select>   
                            </td>
                        </tr>

                        <tr>
                            <td>Lý do</td>
                            <td id="no_color">
                                <div class="input-group input-group-lg">
                                 <textarea class="form-control" name="lyDo"  rows="2" maxlength="300" > <?php echo $lyDo;?></textarea>
                                </div>
                            </td>

                            <td>Ngày ứng</td>
                            <td class="<?php if($ngayUng == "") echo 'required'; ?>">
                            <input class="form-date-control py-2" type="date" name="ngayUng" value="<?php echo $ngayUng; ?>" /></td>
                        </tr>
                    <tr>
                    
                        <td id="no_color" colspan="5" align="center">
                        <input type="submit" value="Chỉnh sửa" name="edit" class="btn btn-outline-purple editSalarySlip-btn mb-5 w-25"/>
                        <a class="btn btn-outline-purple editSalarySlip-btn mb-5 w-25"
                                    href="index.php?page=admin-salary-slip"> Quay Lại</a>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<?php $this->end(); ?>