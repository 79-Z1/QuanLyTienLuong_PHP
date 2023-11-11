<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>

<style type="text/css">
    form {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
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
<?php
if (isset($_POST['a']))
    $a = trim($_POST['a']);
else $a = 0;
if (isset($_POST['b']))
    $b = trim($_POST['b']);
else $b = 0;
if (isset($_POST['hinh']))
    $hinh = trim($_POST['hinh']);
else $hinh = "";
if (isset($_POST['chu-vi']))
    $chuvi = trim($_POST['chu-vi']);
else $chuvi = 0;
if (isset($_POST['dien-tich']))
    $dientich = trim($_POST['dien-tich']);
else $dientich = 0;
if (isset($_POST['xu-ly']))
    if (is_numeric($a) && is_numeric($b))
        switch ($a) {
            case 1:
                $hinh = "vuông";
                $chuvi = 4 * $b;
                $dientich = $b * $b;
                break;
            case 2:
                $hinh = "tròn";
                define("PI", 3.1415);
                $chuvi = 2 * PI * $b;
                $dientich = round(PI * pow($b, 2), 2);
                break;
            case 3:
                $hinh = "tam giác";
                $p = ($b * 3) / 2;
                $chuvi = $b * 3;
                $dientich = round(sqrt($p * 3 * ($p - $b)), 2);
                break;
            case 4:
                $hinh = "chữ nhật";
                $chuvi = ($a + $b) * 2;
                $dientich = $a * $b;
                break;
            default:
                echo "giá trị của a chỉ từ 1-4";
        }
    else {
        echo "<font color='red'>Vui lòng nhập vào số! </font>";
        $dientich = "";
    }
else $dientich = 0;
?>
<form align='center' action="" method="post">
    <table>
        <thead>
            <th colspan="2" align="center">
                <h3>CHU VI DIỆN TÍCH CÁC HÌNH HỌC CƠ BẢN</h3>
            </th>
        </thead>
        <tr>
            <td>Nhập a:</td>
            <td><input type="text" name="a" value="<?php echo $a; ?> " /></td>
        </tr>
        <tr>
            <td>Nhập b:</td>
            <td><input type="text" name="b" value="<?php echo $b; ?> " /></td>
        </tr>
        <tr>
            <td>Hình:</td>
            <td><input type="text" name="hinh" disabled value="<?php echo $hinh; ?> " /></td>
        </tr>
        <tr>
            <td>Chu vi:</td>
            <td><input type="text" name="chu-vi" disabled value="<?php echo $chuvi; ?> " /></td>
        </tr>
        <tr>
            <td>Diện tích:</td>
            <td><input type="text" name="dien-tich" disabled value="<?php echo $dientich; ?> " /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><button type="submit" name="xu-ly">Xử lý</button></td>
        </tr>
        <tr>
            <td><a class="mt-5" href="index.php">Quay lại</a></td>
        </tr>
    </table>
</form>
<?php $this->end(); ?>