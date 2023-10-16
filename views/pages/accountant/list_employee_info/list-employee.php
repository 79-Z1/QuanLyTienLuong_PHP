<?php $this->layout('layout') ?>
<?php $this->section('content'); ?>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    td {
        padding: 10px;
        font-size: 20px;
    }

    p {
        font-size: 20px;
        font-weight: bold;
    }

    input[type="radio"] {
        transform: scale(1.6);
        margin-right: 5px;
        margin-left: 10px;
    }

    .larger-text {
        font-size: 20px;
        /* Điều chỉnh kích thước chữ theo nhu cầu */
        margin-right: 20px;
        /* Điều chỉnh khoảng cách giữa nút radio và văn bản */
    }

    h3 {
        font-weight: bold;
        font-size: 26px;
    }

    .search-btn {
        width: 100%;
    }
</style>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'quan_ly_tien_luong')

    or die('Could not connect to MySQL: ' . mysqli_connect_error());

$sqlChucVu = 'select MaChucVu, TenChucVu from chuc_vu';

$resultChucVu = mysqli_query($conn, $sqlChucVu);

$sqlPhong = 'select MaPhong, TenPhong from phong_ban';

$resultPhong = mysqli_query($conn, $sqlPhong);

if (isset($_POST['maNV']))
    $maNV = trim($_POST['maNV']);
else $maNV = "";

if (isset($_POST['hoTen']))
    $hoTen = trim($_POST['hoTen']);
else $hoTen = "";
$maPhong = $_POST['phong'];
$maChucVu = $_POST['chucVu'];
$gioiTinh = $_POST['radGT'];
if (isset($_POST['timkiem'])) {
    $sqlTimKiem =
        "select *, TenPhong, TenChucVu from nhan_vien, chuc_vu, phong_ban
            where nhan_vien.MaPhong = phong_ban.MaPhong 
            and nhan_vien.MaChucVu = chuc_vu.MaChucVu
        ";
        if($maNV!=""){
            $sqlTimKiem .= "and MaNV = '$maNV'";
        }
        if($maPhong!=""){
            $sqlTimKiem .= "and nhan_vien.MaPhong = '$maPhong'";
        }
        if($maChucVu!=""){
            $sqlTimKiem .= "and nhan_vien.MaChucVu = '$maChucVu'";
        }
        if($gioiTinh!="-1"){
            $sqlTimKiem .= "and GioiTinh = '$gioiTinh'";
        }

    $sqlTimKiem .= "order by MaNV";
    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
}

?>
<!-- Card stats -->
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 d-flex">
            <nav class="navbar navbar-light bg-light d-flex ">
                <form action="" method="post">
                    <table>
                        <thead>
                            <th colspan="12">
                                <h3>TÌM KIẾM NHÂN VIÊN</h3>
                            </th>
                        </thead>
                        <tr>
                            <td>
                                <p>Mã nhân viên</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maNV" value="<?php echo $maNV; ?>"></td>
                            <td>
                                <p>Phòng</p>
                            </td>
                            <td>

                                <select name="phong" class="form-select search-option" id="inputGroupSelect02">
                                    <option value="">Trống</option>
                                    <?php
                                    if (mysqli_num_rows($resultPhong) <> 0) {

                                        while ($rows = mysqli_fetch_array($resultPhong)) {
                                            echo '<option value="' . $rows['MaPhong'] . '">' . $rows['TenPhong'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td align="center" rowspan="3">

                                <input class="btn btn-outline-success search-btn" name="timkiem" type="submit" value="Tìm kiếm" />
                                <input class="btn btn-outline-success search-btn" name="reset" type="reset" value="Reset" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Họ tên nhân viên</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="hoTen" value="<?php echo $hoTen; ?>"></td>
                            <td>
                                <p>Chức vụ</p>
                            </td>
                            <td>

                                <select name="chucVu" class="form-select search-option" id="inputGroupSelect02">
                                <option value="">Trống</option>
                                    <?php
                                    if (mysqli_num_rows($resultChucVu) <> 0) {

                                        while ($rows = mysqli_fetch_array($resultChucVu)) {
                                            echo '<option value="' . $rows['MaChucVu'] . '">' . $rows['TenChucVu'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>

                        </tr>
                        <tr>

                            <td align="center" colspan="4">
                                <p style="display: inline-block">Giới tính</p>
                                <label for="nam">
                                    <input type="radio" name="radGT" id="nam" value="1" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == "1") echo "checked" ?>> <span class="larger-text">Nam</span>
                                </label>
                                <label for="nu">
                                    <input type="radio" name="radGT" id="nu" value="0" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == "0") echo "checked" ?>> <span class="larger-text">Nữ</span>
                                </label>
                                <label for="none">
                                    <input type="radio" name="radGT" id="nam" value="-1" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == "-1") echo "checked" ?>> <span class="larger-text">Không</span>
                                </label>
                            </td>

                        </tr>
                    </table>

                </form>
            </nav>
        </div>
    </div>

</div>
<div class="card shadow border-0 mb-7">
    <div class="card-header">
        <h5 class="mb-0">THÔNG TIN NHÂN VIÊN</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-nowrap">
            <thead class="thead-light">
                <tr>
                    <th scope="col">mã nhân viên</th>
                    <th scope="col">họ tên</th>
                    <th scope="col">chức vụ</th>
                    <th scope="col">phòng</th>
                    <th scope="col">ngày sinh</th>
                    <th scope="col">giới tính</th>
                    <th scope="col">địa chỉ</th>
                    <th scope="col">số tài khoản</th>
                    <th scope="col">cccd</th>
                    <th scope="col">số con</th>
                    <th scope="col">hình đại diện</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <td>123456</td>
                    <td>Nguyễn Duy Thiên</td>
                    <td>Chủ tịch</td>
                    <td>Chủ tịch</td>
                    <td>Nam</td>
                    <td>0906420744</td>
                    <td>123456</td>
                    <td>Nguyễn Duy Thiên</td>
                    <td>Chủ tịch</td>
                    <td>Chủ tịch</td>
                    <td>Nam</td>
            
                    <td class="text-end">
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr> -->
                <?php
                if (mysqli_num_rows($resultTimKiem) <> 0) {

                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                        if($rows['GioiTinh']==0) $gt = "Nữ";
                        else $gt = "Nam";
                        echo "<tr>
                        <td>{$rows['MaNV']}</td>
                        <td>{$rows['HoNV']} {$rows['TenNV']}</td>
                        <td>{$rows['TenChucVu']}</td>
                        <td>{$rows['TenPhong']}</td>
                        <td>{$rows['NgaySinh']}</td>
                        <td>{$gt}</td>
                        <td>{$rows['DiaChi']}</td>
                        <td>{$rows['STK']}</td>
                        <td>{$rows['CCCD']}</td>
                        <td>{$rows['SoCon']}</td>
                        <td>{$rows['Hinh']}</td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php $this->end(); ?>