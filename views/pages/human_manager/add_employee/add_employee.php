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

    $allowed = array('image/jpeg','image/png');

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

        if(!is_numeric($stk)){
            $err[] = "Vui lòng nhập số tài khoản đúng định dạng số";
        }
        if($diaChi == ""){
            $err[] = "Vui lòng nhập địa chỉ";
        }
        if(!is_numeric($sdt)){
            $err[] = "Vui lòng nhập số điện thoại đúng định dạng số";
        }
        if(!is_numeric($cccd)){
            $err[] = "Vui lòng nhập căn cước công dân đúng định dạng số";
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

        if($_FILES['imgnv']['name']== NULL ){
            $err[] = "Vui lòng chọn ảnh nhân viên";
        }else if(!in_array($_FILES['imgnv']['type'],$allowed)){
            $err[] = "Vui lòng chọn đúng định dạng ảnh";
        }

        if($hoNV != "" && $tenNV != "" && $ngaySinh != "" && is_numeric($cccd) 
            && is_numeric($sdt) && $diaChi != "" && is_numeric($stk) 
            && $_FILES['imgnv']['name']!= NULL && in_array($_FILES['imgnv']['type'],$allowed)){
            $hinh = explode(".",$_FILES['imgnv']['name']);
            $tempname = $_FILES["imgnv"]["tmp_name"];
            $hinh[0] = $maNV;
            $newhinh = implode(".",$hinh);
            $folder = $_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/imgnv/" . $newhinh;

            if(move_uploaded_file($tempname, $folder)){
                $insert = "insert into nhan_vien(MaNV, HoNV, TenNV, GioiTinh, NgaySinh, DiaChi, MaPhong, STK, CCCD, MaChucVu, SoCon, Hinh, SDT) 
                values('$maNV','$hoNV','$tenNV',$gt,'$ngaySinh','$diaChi','$phong','$stk','$cccd','$chucVu','$soCon','$newhinh','$sdt')";
                mysqli_query($conn, $insert);

                $taoTaiKhoan = "insert into tai_khoan(TenTK, MatKhau, LoaiTK, MaNV)
                    values('$maNV','$cccd','NV','$maNV')";

                mysqli_query($conn, $taoTaiKhoan);

                $getMaNV = "select MaNV from nhan_vien";
                $result = mysqli_query($conn, $getMaNV);

                $soMaNV = mysqli_num_rows($result);

                $newMaNV = "";

                $soMaNV > 99 ? $newMaNV = 'NV' . $soMaNV + 1 : $newMaNV = 'NV0' . $soMaNV + 1;

                $hoNV = "";
                $tenNV = "";
                $soCon = "0";
                $ngaySinh = "";
                $cccd = "";
                $stk = "";
                $sdt = "";
                $diaChi = "";
                $maNV = $newMaNV;
                
                echo "<script type='text/javascript'>toastr.success('Thêm nhân viên thành công'); toastr.options.timeOut = 3000;</script>";
            }else{
                echo "<script type='text/javascript'>toastr.error('Tải lên ảnh không thành công'); toastr.options.timeOut = 3000;</script>";
            }
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
            <form align='center' action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <tr>
                        <td>Mã nhân viên:</td>
                        <td><input type="text" size="20" name="maNV" value="<?php echo $maNV; ?> " disabled="disabled"/></td>
                        <td>Số con:</td>
                        <td class="<?php if($soCon == "") echo 'required'; ?>"><input type="text" name="soCon" value="<?php echo $soCon; ?> " /></td>
                    </tr>
                    <tr>
                        <td >Họ :</td>
                        <td class="<?php if($hoNV == "") echo 'required'; ?>"><input  type="text" size="20" name="hoNV" value="<?php echo $hoNV; ?> " /></td>
                        <td>Tên:</td>
                        <td class="<?php if($tenNV == "") echo 'required'; ?>"><input  type="text" name="tenNV" value="<?php echo $tenNV; ?> " /></td>
                    </tr>
                    <tr>
                        <td>Phòng:</td>
                        <td>
                        <select name="phong">
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
                            <select name="chucVu">
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
                        <td class="<?php if($ngaySinh == "") echo 'required'; ?>"><input type="date" name="ngaySinh" value="<?php echo $ngaySinh; ?>" /></td>
                        <td>CCCD:</td>
                        <td class="<?php if($cccd == "") echo 'required'; ?>"><input type="text" name="cccd" value="<?php echo $cccd; ?> " /></td>
                    </tr>
                    <tr>
                        <td>Giới tính:</td>
                        <td>
                            <input type="radio" name="radGT" value="1" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '1') echo 'checked="checked"'; ?> checked />
                            Nam
                            <input type="radio" name="radGT" value="0" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '0') echo 'checked="checked"'; ?> />
                            Nữ
                        </td>
                        <td>Số tài khoản</td>
                        <td class="<?php if($stk == "") echo 'required'; ?>"><input type="text" name="stk" value="<?php echo $stk; ?> " /></td>
                    </tr>
                    <tr>
                        <td>Số điện thoại:</td>
                        <td class="<?php if($sdt == "") echo 'required'; ?>">
                            <input type="text" name="soDienThoai" value="<?php echo $sdt; ?> " />
                        </td>
                        <td>Địa chỉ:</td>
                        <td class="<?php if($diaChi == "") echo 'required'; ?>">
                            <input type="text" name="diaChi" value="<?php echo $diaChi; ?> " />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center" class="">
                        Ảnh nhân viên
                        <input type="file" name="imgnv">
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
