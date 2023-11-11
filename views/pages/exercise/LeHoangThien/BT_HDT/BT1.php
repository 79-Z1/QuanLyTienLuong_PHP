<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php

// Lớp Người
class Nguoi {
    public $hoTen;
    public $diaChi;
    public $gioiTinh;

    public function __construct($hoTen, $diaChi, $gioiTinh) {
        $this->hoTen = $hoTen;
        $this->diaChi = $diaChi;
        $this->gioiTinh = $gioiTinh;
    }
}

// Lớp Sinh viên kế thừa từ lớp Người
class SinhVien extends Nguoi {
    public $lopHoc;
    public $nganhHoc;

    public function __construct($hoTen, $diaChi, $gioiTinh, $lopHoc, $nganhHoc) {
        // parent::__construct($hoTen, $diaChi, $gioiTinh);
        $this->lopHoc = $lopHoc;
        $this->nganhHoc = $nganhHoc;
    }

    public function tinhDiemThuong() {
        if ($this->nganhHoc == "CNTT") {
            return 1;
        } elseif ($this->nganhHoc == "Kinh tế") {
            return 1.5;
        } else {
            return 0;
        }
    }
}

// Lớp Giảng viên kế thừa từ lớp Người
class GiangVien extends Nguoi {
    public $trinhDo;
    const LUONG_CO_BAN = 1500000;

    public function __construct($hoTen, $diaChi, $gioiTinh, $trinhDo) {
        parent::__construct($hoTen, $diaChi, $gioiTinh);
        $this->trinhDo = $trinhDo;
    }

    public function tinhLuong() {
        if ($this->trinhDo == "Cử nhân") {
            return self::LUONG_CO_BAN * 2.34;
        } elseif ($this->trinhDo == "Thạc sĩ") {
            return self::LUONG_CO_BAN * 3.67;
        } elseif ($this->trinhDo == "Tiến sĩ") {
            return self::LUONG_CO_BAN * 5.66;
        } else {
            return 0;
        }
    }
}

// Xử lý thông tin người dùng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hoTen = $_POST['hoTen'];
    $diaChi = $_POST['diaChi'];
    $gioiTinh = $_POST['gioiTinh'];
    $lopHoc = $_POST['lopHoc'];
    $nganhHoc = $_POST['nganhHoc'];
    $trinhDo = $_POST['trinhDo'];

    if ($_POST['role'] == 'sinhVien') {
        $sinhVien = new SinhVien($hoTen, $diaChi, $gioiTinh, $lopHoc, $nganhHoc);
        $diemThuong = $sinhVien->tinhDiemThuong();

        // Tạo mảng dữ liệu
    $data = array(
        array($hoTen, $diaChi, $gioiTinh, $lopHoc, $nganhHoc, $diemThuong)
    );
    
    // Tạo bảng HTML
    echo '<table >';
    echo '<tr><th>Họ và tên</th><th>Địa chỉ</th><th>Giới tính</th><th>Lớp học</th><th>Ngành học</th><th>Điểm Thưởng</th></tr>';

    // Duyệt qua mảng dữ liệu và tạo các hàng
    foreach ($data as $row) {
        echo '<tr>';
        foreach ($row as $cell) {
            echo '<td>' . $cell . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    } else if ($_POST['role'] == 'giangVien') {
        $giangVien = new GiangVien($hoTen, $diaChi, $gioiTinh, $trinhDo);
        $luong = $giangVien->tinhLuong();

        echo "Thông tin giảng viên:<br>";
        echo "Họ tên: " . $giangVien->hoTen . "<br>";
        echo "Địa chỉ: " . $giangVien->diaChi . "<br>";
        echo "Giới tính: " . $giangVien->gioiTinh . "<br>";
        echo "Trình độ: " . $giangVien->trinhDo . "<br>";
       echo "Lương: " . $luong;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Giao diện</title>
    <style>
table, th, td {
  border:1px solid black;
}
</style>
</head>
<body>
    <h1>Nhập thông tin</h1>
    <form method="POST" action="">
        <label for="role">Vai trò:</label>
        <select name="role">
            <option value="sinhVien">Sinh viên</option>
            <option value="giangVien">Giảng viên</option>
        </select>
        <br><br>
        <label for="hoTen">Họ tên:</label>
        <input type="text" name="hoTen" required>
        <br><br>
        <label for="diaChi">Địa chỉ:</label>
        <input type="text" name="diaChi" required>
        <br><br>
        <label for="gioiTinh">Giới tính:</label>
        <input type="radio" id="gioiTinh" name="gioiTinh" value="Nam" required> Nam
        <input type="radio" id="gioiTinh" name="gioiTinh" value="Nữ" required> Nữ
        <br><br>
        <label for="lopHoc">Lớp học:</label>
        <input type="text" name="lopHoc">
        <br><br>
        <label for="nganhHoc">Ngành học:</label>
        <select name="nganhHoc" id="nganhHoc">
            <option value="CNTT">CNTT</option>
            <option value="Kinh tế">Kinh Tế</option>
        </select>
        <br><br>
        <label for="trinhDo">Trình độ:</label>
        <select name="trinhDo" >
            <option value="Cử nhân">Cử nhân</option>
            <option value="Thạc Sĩ">Thạc Sĩ</option>
            <option value="Tiến Sĩ">Tiến Sĩ</option>
        </select>
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php $this->end(); ?>