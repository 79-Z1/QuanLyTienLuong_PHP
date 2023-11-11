<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<style>
    fieldset {
        background-color: #eeeeee;
    }

    legend {
        background-color: gray;
        color: white;
        padding: 5px 10px;
    }

    input {
        margin: 5px;
    }
</style>

</head>

<body>
<?php
class ThiDaiHoc
{
    const DIEM_CHUAN = 20;
    private $ly, $hoa, $toan;
    public function __set($key, $value) {
        if (property_exists($this, $key)) {
            $this->$key = $value;
        } else {
            die('Không tồn tại thuộc tính');
        }
    }

    public function __get($key) {
        if (property_exists($this, $key)) {
            return $this->$key;
        } else {
            die('Không tồn tại thuộc tính');
        }
    }

    function get_diem_chuan() {
        return self::DIEM_CHUAN;
    }

    function tinh_tong_diem() {
        return $this->toan + $this->ly + $this->hoa;
    }

    function ktra_dau_dh():string {
        if($this->toan > 0 && $this->ly > 0 && $this->hoa > 0) {
            if($this->tinh_tong_diem() >= self::DIEM_CHUAN) {
                return "Đậu";
            } return "Rớt";
        } 
        return "Rớt";
    }
}
?>
<?php

function read_from_file()
{
    $result = "";
    $lines = file('TruongKhanhHoa_62130607.dat');
    foreach ($lines as $line) {
        $result .= $line . "\n";
    }
    return $result;
}
function save_to_file($data)
{
    $myfile = fopen("TruongKhanhHoa_62130607.dat", "w") or die("Unable to open file!");
    foreach ($data as $i => $sinhvien) {
        $txt = implode(" ", $sinhvien);
        $txt .= "\n";
        fwrite($myfile, $txt);
    }
    fclose($myfile);
}
?>
<?php
if (isset($_POST['toan']))
    $toan = $_POST['toan'];
else $toan = "";
if (isset($_POST['ly']))
    $ly = $_POST['ly'];
else $ly = "";
if (isset($_POST['hoa']))
    $hoa = $_POST['hoa'];
else $hoa = "";
$thidh = new ThiDaiHoc();
$diemchuan = $thidh->get_diem_chuan();
$tongdiem = "";
$ketqua = "";
if (isset($_POST['xuly'])) {
    $thidh->toan = $toan;
    $thidh->ly = $ly;
    $thidh->hoa = $hoa;
    $tongdiem = $thidh->tinh_tong_diem();
    $ketqua = $thidh->ktra_dau_dh();    
}
?>
<form action="" method="post">
    <fieldset>
        <legend>KẾT QUẢ THI ĐẠI HỌC</legend>
        <table border='0'>
            <tr>
                <td>Toán:</td>
                <td><input type="text" name="toan" value="<?= $toan ?>" /></td>
            </tr>
            <tr>
                <td>Lý:</td>
                <td><input type="text" name="ly" value="<?= $ly ?>" /></td>
            </tr>
            <tr>
                <td>Hóa:</td>
                <td><input type="text" name="hoa" value="<?= $hoa ?>" /></td>
            </tr>
            <tr>
                <td>Điểm chuẩn:</td>
                <td><input type="text" name="diemchuan" value="<?= $diemchuan ?>" disabled /></td>
            </tr>
            <tr>
                <td>Tổng điểm:</td>
                <td><input type="text" name="tongdiem" value="<?= $tongdiem ?>" disabled /></td>
            </tr>
            <tr>
                <td>Kết quả:</td>
                <td><input type="text" name="ketqua" value="<?= $ketqua ?>" disabled /></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="xuly" value="Xem kết quả" /></td>
            </tr>
        </table>
    </fieldset>
</form>
<?php $this->end(); ?>
