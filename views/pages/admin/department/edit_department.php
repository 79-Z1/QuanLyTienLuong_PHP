<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

    $maP = $_GET["MaPhong"];
    $getPh= "select * from phong_ban
    where MaPhong='$maP'";   
    $resultPh = mysqli_query($conn, $getPh);
    $ph = mysqli_fetch_array($resultPh);


    $err = array();

    $allowed = array('image/jpeg','image/png');

    // connect mysql

    $getPhongBan = "select MaPhong, TenPhong from phong_ban";

    $resultPhongBan = mysqli_query($conn, $getPhongBan);
?>
<style>
    .form-control.form-select{
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;
        
    }
    .form-select{
        width: 100%;
        padding-left: 20px;
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
                <h5 class="mb-0">THÊM NHÂN VIÊN</h5>
            </div>
            <div class="table-responsive">
            <form align='center' action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <tr>
                    <td>Mã Phòng</td>
                        <td>
                            <select class="form-select py-2" name="chucVu">
                                <?php
                                    if(mysqli_num_rows($resultPhongBan)<>0){
                                        while($rows=mysqli_fetch_array($resultPhongBan)){
                                            echo "<option value='$rows[MaPhong]'";
                                            if(isset($_POST['chucVu'])&& $_POST['phong']==$rows['MaPhong'] || $rows['MaPhong']==$ph['MaPhong']) echo 'selected';
                                            echo ">$rows[MaPhong]</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </td>

                        <td>Phòng</td>
                        <td>
                        <select class="form-select py-2" name="phong">
                            <?php
                                if(mysqli_num_rows($resultPhongBan)<>0){
                                    while($rows=mysqli_fetch_array($resultPhongBan)){
                                        echo "<option value='$rows[TenPhong]'";
                                        if(isset($_POST['phong'])&& $_POST['phong']==$rows['MaPhong'] || $rows['TenPhong']==$ph['TenPhong']) echo 'selected';
                                        echo ">$rows[TenPhong]</option>";
                                    }
                                }
                            ?>
                        </select>
                        </td>
                        
                    </tr>
                   
                    <tr>
                        <td id="no_color" colspan="4" align="center">
                        <input type="submit" value="Thêm" name="them" class="btn btn-outline-purple themnhanvien-btn mb-5 w-25"/>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<?php $this->end(); ?>