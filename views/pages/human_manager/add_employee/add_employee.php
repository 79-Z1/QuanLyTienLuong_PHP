<?php $this->layout('layout_manager') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1]."/models/NhanVien.php");
include_once($_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1]."/connect.php"); 
    if (isset($_POST['hoNV']))
        $hoNV = trim($_POST['hoNV']);
    else $hoNV = "";

    if (isset($_POST['tenNV']))
        $tenNV = trim($_POST['tenNV']);
    else $tenNV = "";

    if (isset($_POST['soCon']))
        $soCon = trim($_POST['soCon']);
    else $soCon = "0";

    if (isset($_POST['ngaySinh']))
        $ngaySinh = trim($_POST['ngaySinh']);
    else $ngaySinh = "";


    if (isset($_POST['cccd']))
        $cccd = trim($_POST['cccd']);
    else $cccd = "";

    if (isset($_POST['stk']))
        $stk = trim($_POST['stk']);
    else $stk = "";

    if (isset($_POST['soDienThoai']))
        $sdt = trim($_POST['soDienThoai']);
    else $sdt = "";

    if (isset($_POST['diaChi']))
        $diaChi = trim($_POST['diaChi']);
    else $diaChi = "";

    if (isset($_POST['phong']))
        $phong = trim($_POST['phong']);
    else $phong = "";

    if (isset($_POST['chucVu']))
        $chucVu = trim($_POST['chucVu']);
    else $chucVu = "";

    $err = array();

    // connect mysql

    function LayMaNhanVien($conn){
        $sql = "select MaNV from nhan_vien";

        $result = mysqli_query($conn, $sql);

        $rows = mysqli_num_rows($result);
        return $rows > 99 ? 'NV' . $rows + 1 : 'NV0' . $rows + 1;
    }

    	
    $maNV = LayMaNhanVien($conn);

    $getPhongBan = "select MaPhong, TenPhong from phong_ban";

    $resultPhongBan = mysqli_query($conn, $getPhongBan);

    $getChucVu = "select MaChucVu, TenChucVu from chuc_vu";

    $resultChucVu = mysqli_query($conn, $getChucVu);


    if (isset($_POST['them'])) {
        $gt = $_POST['radGT'];
        // $nv = new NhanVien(
        //     $maNV,
        //     $hoNV,
        //     $tenNV,
        //     $gt,
        //     $ngaySinh,
        //     $diaChi,
        //     $stk,
        //     $cccd,
        //     $soCon,
        //     $phong,
        //     $chucVu,
        //     $sdt,
        //     $hinh
        // );
        // require('connect.php');
        if($stk == ""){
            $err[] = "Vui lòng nhập số tài khoản";
        }
        if($diaChi == ""){
            $err[] = "Vui lòng nhập địa chỉ";
        }
        if($sdt == ""){
            $err[] = "Vui lòng nhập số điện thoại";
        }
        if($cccd == ""){
            $err[] = "Vui lòng nhập căn cước công dân";
        }
        if($ngaySinh == ""){
            $err[] = "Vui lòng chọn ngày sinh";
        }
        if($tenNV == ""){
            $err[] = "Vui lòng nhập tên nhân viên";
        }
        if($hoNV == ""){
            $err[] = "Vui lòng nhập họ nhân viên";
        }
        if($hoNV != "" && $tenNV != "" && $ngaySinh != "" && $cccd != "" && $sdt != "" && $diaChi != "" && $stk != ""){
            $insert = "insert into nhan_vien(MaNV, HoNV, TenNV, GioiTinh, NgaySinh, DiaChi, MaPhong, STK, CCCD, MaChucVu, SoCon, Hinh, SDT) 
                values('$maNV','$hoNV','$tenNV',$gt,'$ngaySinh','$diaChi','$phong','$stk','$cccd','$chucVu','$soCon','dsa',$sdt)";
            $result = mysqli_query($conn, $insert);
            echo "<script type='text/javascript'>toastr.success('Thêm nhân viên thành công'); toastr.options.timeOut = 3000;</script>";
        }
        else{
            foreach($err as $lois){
                echo "<script type='text/javascript'>toastr.error('$lois'); toastr.options.timeOut = 3000;</script>";
            }
        }

    }
?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">THÊM NHÂN VIÊN</h5>
            </div>
            <div class="table-responsive">
            <form align='center' action="" method="post">
                <table class="table table-hover table-nowrap">
                    <tr>
                        <td>Mã nhân viên:</td>
                        <td><input class="form-control form-control-sm" type="text" size="10" name="maNV" value="<?php echo $maNV; ?> " disabled="disabled"/></td>
                        <td>Số con:</td>
                        <td class="required"><input class="form-control form-control-sm" type="text" name="soCon" value="<?php echo $soCon; ?> " /></td>
                    </tr>
                    <tr>
                        <td>Họ :</td>
                        <td class="required"><input class="form-control form-control-sm" type="text" size="10" name="hoNV" value="<?php echo $hoNV; ?> " /></td>
                        <td>Tên:</td>
                        <td class="required"><input class="form-control form-control-sm" type="text" name="tenNV" value="<?php echo $tenNV; ?> " /></td>
                    </tr>
                    <tr>
                        <td>Phòng:</td>
                        <td>
                        <select class="form-control form-control-sm" name="phong">
                            <?php
                                if(mysqli_num_rows($resultPhongBan)<>0){
                                    while($rows=mysqli_fetch_array($resultPhongBan)){
                                        echo "<option value='$rows[MaPhong]'";
                                        if(isset($_POST['phong'])&& $_POST['phong']==$rows['MaPhong']) echo 'selected';
                                        echo ">$rows[TenPhong]</option>";
                                    }
                                }
                            ?>
                        </select>
                        </td>
                        <td>Chức Vụ:</td>
                        <td>
                            <select class="form-control form-control-sm" name="chucVu">
                                <?php
                                    if(mysqli_num_rows($resultChucVu)<>0){
                                        while($rows=mysqli_fetch_array($resultChucVu)){
                                            echo "<option value='$rows[MaChucVu]'";
                                            if(isset($_POST['chucVu'])&& $_POST['chucVu']==$rows['MaChucVu']) echo 'selected';
                                            echo ">$rows[TenChucVu]</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Ngày sinh:</td>
                        <td class="required"><input type="date" name="ngaySinh" value="<?php echo $ngaySinh; ?> " /></td>
                        <td>CCCD:</td>
                        <td class="required"><input class="form-control form-control-sm" type="text" name="cccd" value="<?php echo $cccd; ?> " /></td>
                    </tr>
                    <tr>
                        <td>Giới tính:</td>
                        <td>
                            <input class="form-check-input" type="radio" name="radGT" value="1" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '1') echo 'checked="checked"'; ?> checked />
                            <label class="form-check-label" >Nam</label>
                            <input class="form-check-input" type="radio" name="radGT" value="0" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '0') echo 'checked="checked"'; ?> />
                            <label class="form-check-label" >Nữ</label>
                        </td>
                        <td>Số tài khoản</td>
                        <td class="required"><input class="form-control form-control-sm" type="text" name="stk" value="<?php echo $stk; ?> " /></td>
                    </tr>
                    <tr>
                        <td>Số điện thoại:</td>
                        <td class="required">
                            <input class="form-control form-control-sm" type="text" name="soDienThoai" value="<?php echo $sdt; ?> " />
                        </td>
                        <td>Địa chỉ:</td>
                        <td class="required">
                            <input class="form-control form-control-sm required" type="text" name="diaChi" value="<?php echo $diaChi; ?> " />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center" class="required">
                        Ảnh nhân viên
                        <input class="form-control-file" type="file" name="fileToUpload" id="fileToUpload">
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
