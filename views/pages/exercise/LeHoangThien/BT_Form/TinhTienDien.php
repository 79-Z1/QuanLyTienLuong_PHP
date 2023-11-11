<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>THANH TOÁN TIỀN ĐIỆN</title>

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
    if (isset($_POST['tinhTien'])) {
        $chiSoCu = trim($_POST['chiSoCu']);
        $chiSoMoi = trim($_POST['chiSoMoi']);
        $donGia = trim($_POST['donGia']);

        if (is_numeric($chiSoCu) && is_numeric($chiSoMoi) && is_numeric($donGia)) {
            $soTienThanhToan = ($chiSoMoi - $chiSoCu) * $donGia;
        } else {
            echo "<font color='red'>Vui lòng nhập vào số! </font>";
        }
    }
    ?>

    <form align='center' action="" method="post">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h3>THANH TOÁN TIỀN ĐIỆN</h3>
                </th>
            </thead>
            <tr>
                <td>Tên chủ hộ:</td>
                <td><input type="text" id="tenChuHo" name="tenChuHo" required /></td>
            </tr>
            <tr>
                <td>Chỉ số cũ:</td>
                <td><input type="text" id="chiSoCu" name="chiSoCu" required /></td>
            </tr>
            <tr>
                <td>Chỉ số mới:</td>
                <td><input type="text" id="chiSoMoi" name="chiSoMoi" required /></td>
            </tr>
            <tr>
                <td>Đơn giá:</td>
                <td><input type="text" id="donGia" name="donGia" value="20000" readonly />
            </tr>
            <tr>
                <td>Số tiền thanh toán:</td>
                <td><input type="text" name="soTienThanhToan" disabled="disabled" value="<?php echo isset($soTienThanhToan) ? $soTienThanhToan . " VND" : ''; ?>" readonly /></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><button type="submit" name="tinhTien">Tính</button></td>
            </tr>
        </table>
    </form>
</body>

</html>
<?php $this->end(); ?>