<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

        $conn = mysqli_connect ('localhost', 'root', '', 'quan_ly_tien_luong') 
        OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
    $macong = $_GET["MaCong"];
    $getChamCong = "select * from cham_cong where MaCong='$macong'";   
    $resultChamCong = mysqli_query($conn, $getChamCong);
    $row = mysqli_fetch_array($resultChamCong, MYSQLI_ASSOC);

    $getmanv = "SELECT MaNV FROM `nhan_vien` 
    order by MaNV";
    $resultmanv = mysqli_query($conn, $getmanv);

    if(isset($_POST["MaCong"])) {
        $macong = $_POST['MaCong'];
    }
    else $macong = $row['MaCong'];

    if(isset($_POST["MaNV"])) {
        $MaNV = $_POST['MaNV'];
    }

    if(isset($_POST["tinhTrang"])) {
        $tinhTrang = $_POST['tinhTrang'] ;
    }
    else $tinhTrang = $row['TinhTrang'];
    

    if(isset($_POST["nghiHL"])) {
        $nghiHL = $_POST['nghiHL'];
    }
    else $nghiHL = $row['NghiHL'];

    if(isset($_POST["ngay"])) {
        $ngay = $_POST['ngay'];
    }
    else $ngay = $row['Ngay'];

    if (isset($_POST['edit'])) {
        $err = array();
        if (empty($macong)) {
            $err[] = "Vui lòng nhập tên tham số";
        }
        if (empty($MaNV)) {
            $err[] = "Vui lòng nhập đơn vị tính";
        }
        if($tinhTrang != 1 && $tinhTrang != 0 ){
            $err[] = "Tình trạng chỉ có 0 và 1";
        }
        if($nghiHL != 1 && $nghiHL != 0 ){
            $err[] = "Tình trạng chỉ có 0 và 1";
        }
        if(empty($ngay)) {
            $err[] = "Vui lòng nhập ngày";
        } 
        
        if(empty($err)) {
            $sqlupdate = "UPDATE `cham_cong` SET `MaCong`='$macong',`MaNV`='$MaNV',`TinhTrang`=$tinhTrang,`NghiHL`=$nghiHL,`Ngay`='$ngay' 
            WHERE MaCong='$macong'";
            $resultupdate = mysqli_query($conn, $sqlupdate);
            echo "<script type='text/javascript'>toastr.success('Sửa chấm công thành công'); toastr.options.timeOut = 3000;</script>";
        }
        else {
            foreach ($err as $error) {
                echo "<script type='text/javascript'>toastr.error('$error'); toastr.options.timeOut = 3000;</script>";
            }
    }
}


?>
<style>
    .form-control.form-select{
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;
        
    }
    .form-select{
        width: 100%;
        padding-left: 20px;
        padding-left: 50px;
    } 
    /* tbody{
        
        font-weight: bold;
        height: 597px;
    } */
</style>

<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">CHỈNH SỬA CHẤM CÔNG</h5>
            </div>
            <div class="table-responsive">
            <form align='center' action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <tr>
                    <td>Mã Công</td>                    
                    <td> 
                        <input class="form-control py-2" type="text" size="20" name="maP" value="<?php echo $row["MaCong"]; ?> "disabled/></td>
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
                                <p>Tình trạng</p>
                            </td>
                            <td class="<?php if($tinhTrang == "") echo 'required'; ?>">
                            <select name="tinhTrang" class="form-select search-option">
                                    <option value="0" <?php if($tinhTrang == '0') echo " selected"; ?>>Nghỉ</option>
                                    <option value="1" <?php if($tinhTrang == '1') echo " selected"; ?>>Đi làm</option>
                            </select>   
                            <td>
                                <p>Nghỉ hưởng lương</p>
                            </td>
                            <td class="<?php if($nghiHL == "") echo 'required'; ?>">
                            
                            <select name="nghiHL" class="form-select search-option">
                                    <option value="0" <?php if($nghiHL == '0') echo " selected"; ?>>Không hưởng lương</option>
                                    <option value="1" <?php if($nghiHL == '1') echo " selected"; ?>>Có hưởng lương</option>
                            </select>   
                        </tr>

                        <tr>
                            <td>Ngày</td>
                            <td class="<?php if($ngay == "") echo 'required'; ?>">
                            <input class="form-date-control py-2" type="date" name="ngay" value="<?php echo $ngay; ?>" /></td>
                        </tr>
                    <tr>
                    
                        <td id="no_color" colspan="5" align="center">
                        <input type="submit" value="Chỉnh sửa" name="edit" class="btn btn-outline-purple editTimekeeping-btn mb-5 w-25"/>
                        <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25"
                                    href="index.php?page=admin-timekeeping"> Quay Lại</a>
                        
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<?php $this->end(); ?>