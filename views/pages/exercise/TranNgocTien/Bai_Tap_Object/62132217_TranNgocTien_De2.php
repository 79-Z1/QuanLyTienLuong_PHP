<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tính Thưởng Nhân Viên</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <style type="text/css">
        body {
            background-color: #d24dff;
        }

        table {
            background: #ffd94d;
            border: 0 solid yellow;
        }

        thead {
            background: #fff14d;

        }

        td {
            color: blue;

        }

        h3 {
            font-family: verdana;
            text-align: center;
            /* text-anchor: middle; */
            color: #ff8100;
            font-size: medium;
        }
    </style>
</head>

<body>
    <?php
    abstract class NhanVienTNT1
    {
        protected $maSo, $hoTen, $ngaySinh, $gioiTinh, $bangCap;
        const mucThuongCB = 5_000_000;

        function __construct($maSo, $hoTen, $ngaySinh, $gioiTinh, $bangCap)
        {
            $this->maSo = $maSo;
            $this->hoTen = $hoTen;
            $this->ngaySinh = $ngaySinh;
            $this->gioiTinh = $gioiTinh;
            $this->bangCap = $bangCap;
        }
        function getMaSo()
        {
            return $this->maSo;
        }
        function setMaSo($maSo)
        {
            $this->maSo = $maSo;
        }
        function getHoTen()
        {
            return $this->hoTen;
        }

        function setHoTen($hoTen)
        {
            $this->hoTen = $hoTen;
        }
        function getNgaySinh()
        {
            return $this->ngaySinh;
        }

        function setNgaySinh($ngaySinh)
        {
            $this->ngaySinh = $ngaySinh;
        }
        function getGioiTinh()
        {
            return $this->gioiTinh;
        }

        function setGioiTinh($gioiTinh)
        {
            $this->gioiTinh = $gioiTinh;
        }
        function getBangCap()
        {
            return $this->bangCap;
        }
        function setBangCap($bangCap)
        {
            $this->bangCap = $bangCap;
        }
        abstract function TinhTienThuong();
    }
    class NhanVienVanPhongTNT1 extends NhanVienTNT1
    {
        private $chucVu, $phongBan, $xepLoai;
        function __construct($maSo, $hoTen, $ngaySinh, $gioiTinh, $bangCap, $chucVu, $phongBan, $xepLoai)
        {
            parent::__construct($maSo, $hoTen, $ngaySinh, $gioiTinh, $bangCap);
            $this->chucVu = $chucVu;
            $this->phongBan = $phongBan;
            $this->xepLoai = $xepLoai;
        }
        function getChucVu()
        {
            return $this->chucVu;
        }
        function setChucVu($chucVu)
        {
            $this->chucVu = $chucVu;
        }
        function getPhongBan()
        {
            return $this->phongBan;
        }
        function setPhongBan($phongBan)
        {
            $this->phongBan = $phongBan;
        }
        function getXepLoai()
        {
            return $this->xepLoai;
        }
        function setXepLoai($xepLoai)
        {
            $this->xepLoai = $xepLoai;
        }
        function TinhTienThuong()
        {
            if ($this->xepLoai == "A") {
                if ($this->chucVu == "TP") {
                    return self::mucThuongCB * 2 * 2;
                } else if ($this->chucVu == "PP") {
                    return self::mucThuongCB * 2 * 1.5;
                } else if ($this->chucVu == "CV") {
                    return self::mucThuongCB * 2 * 1.0;
                }
            }
            if ($this->xepLoai == "B") {
                if ($this->chucVu == "TP") {
                    return self::mucThuongCB * 1.5 * 2;
                } else if ($this->chucVu == "PP") {
                    return self::mucThuongCB * 1.5 * 1.5;
                } else if ($this->chucVu == "CV") {
                    return self::mucThuongCB * 1.5 * 1.0;
                }
            }
            if ($this->xepLoai == "C") {
                if ($this->chucVu == "TP") {
                    return self::mucThuongCB * 1.0 * 2;
                } else if ($this->chucVu == "PP") {
                    return self::mucThuongCB * 1.0 * 1.5;
                } else if ($this->chucVu == "CV") {
                    return self::mucThuongCB * 1.0 * 1.0;
                }
            }
        }
    }
    class NhanVienPhongThiNghiemTNT extends NhanVienTNT1
    {
        private $soSanPham, $soSangKien;
        function __construct($maSo, $hoTen, $ngaySinh, $gioiTinh, $bangCap, $soSanPham, $soSangKien)
        {
            parent::__construct($maSo, $hoTen, $ngaySinh, $gioiTinh, $bangCap);
            $this->soSanPham = $soSanPham;
            $this->soSangKien = $ngaySinh;
        }
        function getSoSanPham()
        {
            return $this->soSanPham;
        }
        function setSoSanPham($soSanPham)
        {
            $this->soSanPham = $soSanPham;
        }
        function getSoSangKien()
        {
            return $this->soSangKien;
        }
        function setSoSangKien($soSangKien)
        {
            $this->soSangKien = $soSangKien;
        }
        function TinhTienThuong()
        {
            return self::mucThuongCB + $this->soSanPham * 2_000_000 + $this->soSangKien * 3_000_000;
        }
    }
    if (isset($_POST['maSo']))
        $maSo = trim($_POST['maSo']);
    else $maSo = "";

    if (isset($_POST['hoTen']))
        $hoTen = trim($_POST['hoTen']);
    else $hoTen = "";

    if (isset($_POST['bangCap']))
        $bangCap = trim($_POST['bangCap']);
    else $bangCap = "";

    if (isset($_POST['ngaySinh']))
        $ngaySinh = trim($_POST['ngaySinh']);
    else $ngaySinh = "";

    if (isset($_POST['phongBan']))
        $phongBan = trim($_POST['phongBan']);
    else $phongBan = "";

    if (isset($_POST['soSP']))
        $soSP = trim($_POST['soSP']);
    else $soSP = "";

    if (isset($_POST['soSK']))
        $soSK = trim($_POST['soSK']);
    else $soSK = "";

    $ketqua = "";

    if (isset($_POST['them'])) {
        if (isset($_POST['radNV']) && $_POST['radNV'] == 'vp') {
            $nvvp = new NhanVienVanPhongTNT1(
                $maSo,
                $hoTen,
                $ngaySinh,
                $_POST['radGT'],
                $bangCap,
                $_POST['chucVu'],
                $phongBan,
                $_POST['xepLoai']
            );
            $fp = @fopen('62132217_TranNgocTien_De2_NVVP.txt', "a+");
            if (!$fp) {
                echo "Mở file không thành công";
            } else {
                $ttnv = "Mã số: " . $nvvp->getMaSo() . "\n";
                $ttnv .= "Họ tên: " . $nvvp->getHoTen() . "\n";
                $ttnv .= "Ngày sinh: " .$nvvp->getNgaySinh() . "\n";
                $ttnv .= "Giới tính: " . $nvvp->getGioiTinh() . "\n";
                $ttnv .= "Bằng cấp: " .$nvvp->getBangCap() . "\n";
                $ttnv .= "Chức vụ: " .$nvvp->getChucVu() . "\n";
                $ttnv .= "Phòng ban: " .$nvvp->getPhongBan() . "\n";
                $ttnv .= "Xếp loại: " .$nvvp->getXepLoai() . "\n";
                $ttnv .= "Tiền thưởng: " .$nvvp->TinhTienThuong() . "\n \n";
                fwrite($fp, $ttnv);
                fclose($fp);
            }
        } else {
            if($soSP <=3 && $soSK <=3){
                $nvtn = new NhanVienPhongThiNghiemTNT(
                    $maSo,
                    $hoTen,
                    $ngaySinh,
                    $_POST['radGT'],
                    $bangCap,
                    $soSP,
                    $soSK
                );
                $fp = @fopen('62132217_TranNgocTien_De2_NVTN.txt', "a+");
                if (!$fp) {
                    echo "Mở file không thành công";
                } else {
                    $ttnv = "Mã số: " . $nvtn->getMaSo() . "\n";
                    $ttnv .= "Họ tên: " . $nvtn->getHoTen() . "\n";
                    $ttnv .= "Ngày sinh: " .$nvtn->getNgaySinh() . "\n";
                    $ttnv .= "Giới tính: " . $nvtn->getGioiTinh() . "\n";
                    $ttnv .= "Bằng cấp: " .$nvtn->getBangCap() . "\n";
                    $ttnv .= "Số sản phẩm thực nghiệm: " .$nvtn->getSoSanPham() . "\n";
                    $ttnv .= "Số sáng kiến: " .$nvtn->getSoSangKien() . "\n";
                    $ttnv .= "Tiền thưởng: " .$nvtn->TinhTienThuong() . "\n \n";
                    fwrite($fp, $ttnv);
                    fclose($fp);
                }
            }
            if($soSP > 3) echo "Số sản phẩm thực nghiệm không được quá 3";
            if($soSK > 3) echo "Số sáng kiến không được quá 3";
        }
    }
    if (isset($_POST['hienThi'])) {
        if (isset($_POST['radNV']) && $_POST['radNV'] == 'vp') {
            $fp = @fopen('62132217_TranNgocTien_De2_NVVP.txt', 'r');
            if (!$fp) {
                echo "Mở file không thành công";
            }else{
                $ketqua = fread($fp, filesize("62132217_TranNgocTien_De2_NVVP.txt"));
            }
        }
        else{
            $fp = @fopen('62132217_TranNgocTien_De2_NVTN.txt', 'r');
            if (!$fp) {
                echo "Mở file không thành công";
            }else{
                $ketqua = fread($fp, filesize("62132217_TranNgocTien_De2_NVTN.txt"));
            }
        }
    }
    ?>
    <form align='center' action="" method="post">
        <table>
            <thead>
                <th colspan="4" align="center">
                    <h3>NHẬP THÔNG TIN NHÂN VIÊN</h3>
                </th>
            </thead>
            <tr>
                <td>Mã số</td>
                <td><input type="text" name="maSo" value="<?php echo $maSo; ?> " /></td>
                <td>Bằng cấp</td>
                <td><input type="text" name="bangCap" value="<?php echo $bangCap; ?> " /></td>
            </tr>
            <tr>
                <td>Họ tên</td>
                <td><input type="text" name="hoTen" value="<?php echo $hoTen; ?> " /></td>
                <td>Ngày sinh</td>
                <td><input type="text" name="ngaySinh" value="<?php echo $ngaySinh; ?> " /></td>
            </tr>
            <tr>
                <td>Giới tính</td>
                <td>
                    <input type="radio" name="radGT" value="Nam" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'nam') echo 'checked="checked"'; ?> checked />Nam
                    <input type="radio" name="radGT" value="Nữ" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'nu') echo 'checked="checked"'; ?> />Nữ

                </td>
            </tr>
            <tr>
                <td>Loại nhân viên</td>
                <td>
                    <input id="vp" type="radio" name="radNV" value="vp" <?php if (isset($_POST['radNV']) && $_POST['radNV'] == 'vp') echo 'checked="checked"'; ?> checked />Văn Phòng
                    <input id="tn" type="radio" name="radNV" value="tn" <?php if (isset($_POST['radNV']) && $_POST['radNV'] == 'tn') echo 'checked="checked"'; ?> />Phòng Thí Nghiệm

                </td>
            </tr>
            <tr class="nvvp">
                <td>Chức vụ</td>
                <td>
                    <select name='chucVu'>
                        <option value='TP' <?php if (isset($_POST['chucVu']) && $_POST['chucVu'] == 'TP') echo 'selected'; ?> selected>
                            Trưởng Phòng
                        </option>
                        <option value='PP' <?php if (isset($_POST['chucVu']) && $_POST['chucVu'] == 'PP') echo 'selected'; ?>>
                            Phó Phòng
                        </option>
                        <option value='CV' <?php if (isset($_POST['chucVu']) && $_POST['chucVu'] == 'CV') echo 'selected'; ?>>
                            Chuyên Viên
                        </option>
                    </select>
                </td>
                <td>Xếp loại</td>
                <td>
                    <select name='xepLoai'>
                        <option value='A' <?php if (isset($_POST['xepLoai']) && $_POST['xepLoai'] == 'A') echo 'selected'; ?> selected>
                            A
                        </option>
                        <option value='B' <?php if (isset($_POST['xepLoai']) && $_POST['xepLoai'] == 'B') echo 'selected'; ?>>
                            B
                        </option>
                        <option value='C' <?php if (isset($_POST['xepLoai']) && $_POST['xepLoai'] == 'C') echo 'selected'; ?>>
                            C
                        </option>
                    </select>
                </td>
            </tr>
            <tr class="nvvp">
                <td>Phòng ban</td>
                <td><input type='text' name='phongBan' value="<?php echo $phongBan; ?> " /></td>
            </tr>
            <tr class="nvtn">
                <td>Số sản phẩm <br> thực nghiệm</td>
                <td><input type='text' size="5" name='soSP' value="<?php echo $soSP; ?> " /></td>
                <td>Số sáng kiến</td>
                <td><input type='text' size="5" name='soSK' value="<?php echo $soSK; ?> " /></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Thêm nhân viên" name="them" /></td>
                <td colspan="2" align="center"><input type="submit" value="Hiển thị thông tin NV" name="hienThi" /></td>
            </tr>
            <tr>
                <td colspan="4"><textarea disabled="disabled" cols="79" rows="20" name="ketqua"> <?php echo $ketqua ?></textarea></td>
            </tr>
        </table>
    </form>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('.nvtn').hide();
        $('#vp').click(function() {
            $('.nvvp').show();
            $('.nvtn').hide();
        });
        $('#tn').click(function() {
            $('.nvtn').show();
            $('.nvvp').hide();
        });
    });
</script>

</html>
<?php $this->end(); ?>