<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Kết quả phép tính</title>
</head>
<body>
  <h2>Kết quả phép tính</h2>
  
  <?php
  // Kiểm tra nếu các giá trị được truyền từ form
  if (isset($_GET["pheptinh"]) && isset($_GET["so1"]) && isset($_GET["so2"])) {
    $pheptinh = $_GET["pheptinh"];
    $so1 = $_GET["so1"];
    $so2 = $_GET["so2"];
    
    // Kiểm tra và thực hiện phép tính
    if (is_numeric($so1) && is_numeric($so2)) {
      $ketqua = 0;
      $pheptinh_text = "";
      
      switch ($pheptinh) {
        case "cong":
          $ketqua = $so1 + $so2;
          $pheptinh_text = "Cộng";
          break;
        case "tru":
          $ketqua = $so1 - $so2;
          $pheptinh_text = "Trừ";
          break;
        case "nhan":
          $ketqua = $so1 * $so2;
          $pheptinh_text = "Nhân";
          break;
        case "chia":
          if ($so2 != 0) {
            $ketqua = $so1 / $so2;
            $pheptinh_text = "Chia";
          } else {
            echo "Lỗi: Số thứ nhì không được là 0";
          }
          break;
        default:
          echo "Lỗi: Phép tính không hợp lệ";
          break;
      }
      
      // Hiển thị kết quả nếu không có lỗi
      if ($pheptinh_text != "") {
        echo "<p>Phép tính: $pheptinh_text</p>";
        echo "<p>Số 1: $so1</p>";
        echo "<p>Số 2: $so2</p>";
        echo "<p>Kết quả: $ketqua</p>";
      }
    } else {
      echo "Lỗi: Số thứ nhất và Số thứ nhì phải là số";
    }
  } else {
    echo "Lỗi: Thiếu thông tin phép tính";
  }
  ?>
  <a href="javascript:window.history.back(-1);">Trở về trang trước</a>
</body>
</html>
<?php $this->end(); ?>