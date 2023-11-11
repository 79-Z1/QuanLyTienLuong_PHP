<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php
// Xử lý form khi có dữ liệu được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Lấy giá trị từ form
  $pheptinh = $_POST["pheptinh"];
  $so1 = $_POST["so1"];
  $so2 = $_POST["so2"];
  // Kiểm tra và chuyển hướng đến trang kết quả nếu các giá trị hợp lệ
  if (is_numeric($so1) && is_numeric($so2)) {
    header("Location: index.php?page=LHT-form-KQ_Phep_Tinh&pheptinh=$pheptinh&so1=$so1&so2=$so2");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Trang Nhập liệu</title>
  <style>
    /* CSS cho form */
    form {
      width: 300px;
      margin: 0 auto;
    }
    
    label {
      display: block;
      margin-bottom: 5px;
    }
    
    input[type="text"] {
      width: 100%;
      padding: 5px;
      margin-bottom: 10px;
    }
    
    input[type="submit"] {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h2>Phép Tính Trên Hai Số</h2>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label>Chọn phép tính:</label>
    <label><input type="radio" name="pheptinh" value="cong" checked> Cộng</label>
    <label><input type="radio" name="pheptinh" value="tru"> Trừ</label>
    <label><input type="radio" name="pheptinh" value="nhan"> Nhân</label>
    <label><input type="radio" name="pheptinh" value="chia"> Chia</label>
    <br>
    <label for="so1">Số Thứ Nhất:</label>
    <input type="text" name="so1" id="so1" required>
    <br>
    <label for="so2">Số Thứ Nhì:</label>
    <input type="text" name="so2" id="so2" required>
    <br>
    <input type="submit" value="Tính">
  </form>
</body>
</html>
<?php $this->end(); ?>