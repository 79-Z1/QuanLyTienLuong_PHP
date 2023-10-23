<?php $this->layout('layout_manager') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

if(!isset($_POST["ngay"])){
    $_POST["ngay"] = date('Y-m-d');
}
function TaoMaCong($i,$date){
    if($i < 10){
        return "C".  $date . "00" . $i;
    }
    elseif($i < 100){
        return "C".  $date . "0" . $i;
    }
    else{
        return "C".  $date . $i;
    }
}

function TaoMaTangCa($i,$date){
    if($i < 10){
        return "TC".  $date . "00" . $i;
    }
    elseif($i < 100){
        return "TC".  $date . "0" . $i;
    }
    else{
        return "TC".  $date . $i;
    }
}

$sql =
    "select MaNV, HoNV, TenNV, TenPhong, TenChucVu from nhan_vien, chuc_vu, phong_ban
     where nhan_vien.MaPhong = phong_ban.MaPhong
     and nhan_vien.MaChucVu = chuc_vu.MaChucVu
     order by MaNV
    ";
$result = mysqli_query($conn, $sql);

if(isset($_POST["xacNhan"])){
    $date = str_replace("-", "", $_POST["ngay"]);
    for($i = 1; $i <= mysqli_num_rows($result); $i++){
        // tạo mã nhân viên
        if($i < 10){
            $maNV = "NV00".$i;
        }
        elseif($i < 100){
            $maNV = "NV0".$i;
        }
        else{
            $maNV =  "NV".$i;
        }
        // lấy dữ liệu của nghỉ hưởng lương
        if(isset($_POST["nghiHL$maNV"])){
            $nghiHL = $_POST["nghiHL$maNV"];
        }
        else $nghiHL = 0;

        // tạo câu insert vào bản chấm công

        $sqlInsertCC = "INSERT INTO cham_cong(MaCong, MaNV, TinhTrang, Ngay, NghiHL) 
                        VALUES ('". TaoMaCong($i,$date) ."','$maNV'," . $_POST["tinhTrang$maNV"] . ",'$_POST[ngay]',$nghiHL);";
        $resultInsertCC = mysqli_query($conn, $sqlInsertCC);


        // kiểm tra nếu có chọn tăng ca thì gán thêm câu insert tăng ca vào 
        if($_POST["tangCa$maNV"]!="-1"){
            $sqlInsertTC = "INSERT INTO tang_ca(MaTC, MaNV, NgayTC, LoaiTC) 
            VALUES ('". TaoMaTangCa($i,$date) ."','$maNV','$_POST[ngay]','" . $_POST["tangCa$maNV"] . "');";
            $resultInsertTC = mysqli_query($conn, $sqlInsertTC);
        }
    }
}
?>
<style>
    td, th{
        padding: 15px !important;
    }
    .ct{
        text-align: center;
    }
    .form-select{
        padding: .375rem 2.25rem .375rem .75rem !important;
    }
    tbody{
        height: 200px;
        overflow-y: scroll;
    }
    .button {
            display: inline-block;
            padding: 8px 20px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #03C03C;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #97ed8a;
        }

        .button:hover {
            background-color: #157806;
        }

        .button:active {
            background-color: #157806;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
</style>
<form action="" method="post">

<div class="single-item ">
    <div class="card shadow border-0 mb-7 mt-5 ">
        <div class="card-header d-flex justify-content-between">
            <div class="mr-auto p-2">
                <h5 >BẢNG CHẤM CÔNG</h5>
            </div>
            <div>
                <input style="font-size: 20px; padding-right: 20px; width:49%" type="date" name="ngay" value="<?= $_POST["ngay"] ?>">
                <input class="button p-2" style="margin-left: 20px;" type="submit" name="xacNhan" value="Xác nhận">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th class="ct" scope="col">mã <br> nhân viên</th>
                        <th scope="col">họ tên</th>
                        <th scope="col">phòng</th>
                        <th scope="col">chức vụ</th>
                        <th scope="col">tình trạng</th>
                        <th class="ct" scope="col">nghỉ <br> hưởng <br> lương</th>
                        <th class="ct" scope="col">tăng ca</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (mysqli_num_rows($result) <> 0) {

                            while ($rows = mysqli_fetch_array($result)) {
                                echo "
                                    <tr>
                                    <td>$rows[MaNV]</td>
                                    <td>$rows[HoNV] $rows[TenNV]</td>
                                    <td>$rows[TenPhong]</td>
                                    <td>$rows[TenChucVu]</td>
                                    <td>
                                        <select name='tinhTrang$rows[MaNV]' class='form-select search-option'>
                                            <option value='1'>Đi làm</option>
                                            <option value='0'>Nghỉ</option>
                                        </select>
                                    </td>
                                    <td class='ct'>
                                        <input name='nghiHL$rows[MaNV]' type='checkbox' class='xx-larger' value='1'>
                                    </td>
                                    <td>
                                        <select name='tangCa$rows[MaNV]' class='form-select search-option'>
                                            <option value='-1'>Không Tăng Ca</option>
                                            <option value='0'>Ngày Thường</option>
                                            <option value='1'>Nghỉ Hằng Tuần</option>
                                            <option value='2'>Nghỉ Lễ</option>
                                        </select>
                                    </td>
                                </tr>
                                ";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</form>

<script>
    $('capnhat-btn').click(function() {
        alert('Cập nhật thành công');
    });
</script>
<?php $this->end(); ?>