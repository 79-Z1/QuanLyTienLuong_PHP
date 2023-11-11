<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Quản Lý Nhân Viên</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <style type="text/css">
        /*body {  
	            background-color: #d24dff;
	        }*/
        /* table{
	            background: #ffd94d;
	            
	        } */
        form {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        table,
        th,
        td {
            border: 1px solid white;
            border-collapse: collapse;
        }

        /* thead{
	            background: #fff14d;    

	        } */
        td {
            background: #ffd94d;
            color: black;
            padding-right: 20px;


        }

        #no_color {
            background: none !important;
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

    abstract class NhanVien1
    {
        protected $hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSL, $soCon;
        function __construct($hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSL, $soCon)
        {
            $this->hoTen = $hoTen;
            $this->soCon = $soCon;
            $this->gioiTinh = $gioiTinh;
            $this->ngaySinh = $ngaySinh;
            $this->ngayVaoLam = $ngayVaoLam;
            $this->heSL = $heSL;
        }
        const luongCB = 1_350_000;

        function TinhTienThuong()
        {
            $nvl = explode("/", $this->ngayVaoLam);
            return (date("Y") - $nvl[2]) * 1_000_000;
        }
        abstract function TinhTienLuong();
        abstract function TinhTroCap();
    }

    class NhanVienVanPhong1 extends NhanVien
    {
        private $soNgayVang;

        function __construct($hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSL, $soCon, $soNgayVang)
        {
            parent::__construct($hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSL, $soCon);
            $this->soNgayVang = $soNgayVang;
        }
        const dinhMucVang = 4;
        const donGiaPhat = 200_000;

        function TinhTienPhat()
        {
            if ($this->soNgayVang > self::dinhMucVang) {
                return ($this->soNgayVang - self::dinhMucVang) * self::donGiaPhat;
            }
            return 0;
        }
        function TinhTroCap()
        {
            if ($this->gioiTinh == "nu") {
                return 200_000 * $this->soCon * 1.5;
            }
            return 200_000 * $this->soCon;
        }
        function TinhTienLuong()
        {
            return self::luongCB * $this->heSL;
        }
    }

    class NhanVienSanXuat extends NhanVien
    {
        private $soSP;

        function __construct($hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSL, $soCon, $soSP)
        {
            parent::__construct($hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSL, $soCon);
            $this->soSP = $soSP;
        }
        const dinhMucSP = 20;
        const donGiaSP = 200_000;

        function TinhTienThuong()
        {
            if ($this->soSP > self::dinhMucSP) {
                return ($this->soSP - self::dinhMucSP) * self::donGiaSP * 0.03;
            }
            return 0;
        }
        public function TinhTroCap()
        {
            return 120_000 * $this->soCon;
        }
        public function TinhTienLuong()
        {
            return $this->soSP * self::donGiaSP;
        }
    }

    if (isset($_POST['hoTen']))
        $hoTen = trim($_POST['hoTen']);
    else $hoTen = "";

    if (isset($_POST['soCon']))
        $soCon = trim($_POST['soCon']);
    else $soCon = "";

    if (isset($_POST['ngaySinh']))
        $ngaySinh = trim($_POST['ngaySinh']);
    else $ngaySinh = "";

    if (isset($_POST['ngayVaoLam']))
        $ngayVaoLam = trim($_POST['ngayVaoLam']);
    else $ngayVaoLam = "";

    if (isset($_POST['heSL']))
        $heSL = trim($_POST['heSL']);
    else $heSL = "";

    if (isset($_POST['soNgayVang']))
        $soNgayVang = trim($_POST['soNgayVang']);
    else $soNgayVang = "";

    if (isset($_POST['soSP']))
        $soSP = trim($_POST['soSP']);
    else $soSP = "";

    $tienLuong = "";
    $troCap = "";
    $tienThuong = "";
    $tienPhat = "";
    $thucLinh = "";
    $disabledSNV ="";
    $disabledSSP = "";
    if (isset($_POST['radLNV']) && $_POST['radLNV'] == "vp") {

        $disabledSSP = "disabled";
    }
    if (isset($_POST['radLNV']) && $_POST['radLNV'] == "sx") {
        $disabledSNV = "disabled";
    }
    function MoneyFormat($tien)
    {
        return number_format($tien, 0, ',', '.') . " VNĐ";
    }
    if (isset($_POST['tinh'])) {
        if ($soCon != "" && $hoTen != "" && $ngaySinh != "" && $ngayVaoLam != "" && $heSL != "") {
            if ($_POST['radLNV'] == "vp") {
                if (is_numeric($soCon) && is_numeric($heSL) && is_numeric($soNgayVang)) {
                    $nhanVien =  new NhanVienVanPhong(
                        $hoTen,
                        $_POST['radGT'],
                        $ngaySinh,
                        $ngayVaoLam,
                        $heSL,
                        $soCon,
                        $soNgayVang
                    );

                    $tienLuong = $nhanVien->TinhTienLuong();
                    $troCap = $nhanVien->TinhTroCap();
                    $tienThuong = $nhanVien->TinhTienThuong();
                    $tienPhat = $nhanVien->TinhTienPhat();
                    $thucLinh = $tienLuong + $tienThuong + $troCap - $tienPhat;
                } else echo "Vui lòng nhập vào số!<br>";
            }
            if ($_POST['radLNV'] == "sx") {
                if (is_numeric($soCon) && is_numeric($heSL) && is_numeric($soSP)) {
                    $nhanVien =  new NhanVienSanXuat(
                        $hoTen,
                        $_POST['radGT'],
                        $ngaySinh,
                        $ngayVaoLam,
                        $heSL,
                        $soCon,
                        $soSP
                    );

                    $tienLuong = $nhanVien->TinhTienLuong();
                    $troCap = $nhanVien->TinhTroCap();
                    $tienThuong = $nhanVien->TinhTienThuong();
                    $thucLinh = $tienLuong + $tienThuong + $troCap;
                } else echo "Vui lòng nhập vào số!<br>";
            }
        } else {
            echo "Vui lòng kiểm tra lại và nhập đầy đủ thông tin!<br>";
        }
        if ($soCon == "") echo "Vui lòng nhập vào Số con!<br>";
        if ($hoTen == "") echo "Vui lòng nhập vào Họ tên!<br>";
        if ($ngaySinh == "") echo "Vui lòng nhập vào Ngày sinh!<br>";
        if ($ngayVaoLam == "") echo "Vui lòng nhập vào Ngày vào làm!<br>";
        if ($heSL == "") echo "Vui lòng nhập vào Hệ số lương!";
    }

    ?>
    <form align='center' action="" method="post">

        <table>
            <thead>
                <th colspan="4" align="center">
                    <h3>QUẢN LÝ NHÂN VIÊN</h3>
                </th>
            </thead>
            <tr>
                <td>Họ và tên:</td>
                <td><input type="text" size="40" name="hoTen" value="<?php echo $hoTen; ?> " /></td>
                <td>Số con:</td>
                <td><input type="text" name="soCon" value="<?php echo $soCon; ?> " /></td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td><input type="text" name="ngaySinh" value="<?php echo $ngaySinh; ?> " /></td>
                <td>Ngày vào làm:</td>
                <td><input type="text" name="ngayVaoLam" value="<?php echo $ngayVaoLam; ?> " /></td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td>
                    <input type="radio" name="radGT" value="nam" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'nam') echo 'checked="checked"'; ?> checked />Nam
                    <input type="radio" name="radGT" value="nu" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'nu') echo 'checked="checked"'; ?> />Nữ
                </td>
                <td>Hệ số lương:</td>
                <td><input type="text" name="heSL" value="<?php echo $heSL; ?> " /></td>
            </tr>
            <tr>
                <td>Loại nhân viên:</td>
                <td>
                    <input id="nvvp" type="radio" name="radLNV" value="vp" <?php if (isset($_POST['radLNV']) && $_POST['radLNV'] == 'vp') echo 'checked="checked"'; ?>/>Văn phòng

                </td>
                <td colspan="2">
                    <input id="nvsx" type="radio" name="radLNV" value="sx" <?php if (isset($_POST['radLNV']) && $_POST['radLNV'] == 'sx') echo 'checked="checked"'; ?> />Sản xuất
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Số ngày vắng: <input <?php echo $disabledSNV;?> id="snv" type="text"  name="soNgayVang" value="<?php echo $soNgayVang; ?> " /></td>
                <td colspan="2">Số sản phẩm: <input <?php echo $disabledSSP;?> id="ssp" type="text"  name="soSP" value="<?php echo $soSP; ?> " /></td>
            </tr>
            <tr>
                <td id="no_color" colspan="4" align="center">
                    <input type="submit" value="Tính lương" name="tinh" />
                </td>
            </tr>
            <tr>
                <td align="center">Tiền lương:</td>
                <td align="center"><input type="text" disabled="disabled" name="tienLuong" value="<?php if ($tienLuong != "") echo MoneyFormat($tienLuong);
                                                                                                    else echo ""; ?> " /></td>
                <td align="center">Trợ cấp:</td>
                <td><input type="text" disabled="disabled" name="troCap" value="<?php if ($troCap != "") echo MoneyFormat($troCap);
                                                                                else echo ""; ?> " /></td>
            </tr>
            <tr>
                <td align="center">Tiền thưởng:</td>
                <td align="center"><input type="text" disabled="disabled" name="tienThuong" value="<?php if ($tienThuong != "") echo MoneyFormat($tienThuong);
                                                                                                    else echo ""; ?> " /></td>
                <td align="center">Tiền phạt:</td>
                <td><input type="text" disabled="disabled" name="tienPhat" value="<?php if ($tienPhat != "" && $tienPhat > 0) echo MoneyFormat($tienPhat);
                                                                                    else echo ""; ?> " /></td>
            </tr>
            </tr>
            <td colspan="4" align="center">
                Thực lĩnh: <input type="text" disabled="disabled" name="thucLinh" value="<?php if ($thucLinh != "") echo MoneyFormat($thucLinh);
                                                                                            else echo ""; ?> " />
            </td>
            </tr>
        </table>
    </form>
    <button type="button" id="nhan">Nhấn</button>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#nvvp').click(function() {
            $('#ssp').attr('disabled','disabled');
            $('#snv').removeAttr('disabled');
        });
        $('#nvsx').click(function() {
            $('#snv').attr('disabled','disabled');
            $('#ssp').removeAttr('disabled');
        });
    });
</script>

</html>