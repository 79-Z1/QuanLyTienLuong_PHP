<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Mang tim kiem va thay the</title>

    <style type="text/css">
        table {
            color: #ffff00;
            background-color: gray;
            border: 2px solid black;
            margin: 30px 20px;
        }

        table th {
            padding: 20px;
            background-color: aqua;
            font-style: vni-times;
            color: yellow;
        }

        table td {
            padding: 10px;
        }

        textarea {
            width: 100%;
            height: 200px;
        }
    </style>
</head>

<body>
    <?php
    if(isset($_POST['nam'])){
        $nam = $_POST['nam'];
    } else $nam ='';
    if(isset($_POST['nam2'])){
        $nam2 = $_POST['nam2'];
    } else $nam2 ='';

    if (isset($_POST['namLonHon2000'])) {
        function nam_nhuan($nam)
        {
            if ($nam % 400 == 0 || ($nam % 4 == 0 && $nam % 100 != 0)) {
                return true;
            }
            return false;
        }

        $ketqua = array();
        foreach (range(2000, $nam) as $y) {
            if (nam_nhuan($y)) {
                $ketqua[] = $y;
            }
        }

        if (!empty($ketqua)) {
            $result = implode(", ", $ketqua) . " là năm nhuận";
        } else {
            $result = "Không có năm nhuận từ năm 2000 đến $nam";
        }
    }
    if(isset($_POST['namBeHon2000'])) {
        function nam_nhuan($nam2){
            if($nam2 % 400 == 0 || ($nam2 % 4 == 0 && $nam2 % 100 != 0)){
                return true;
            }
            return false;
        }

        $ketqua = array();
        foreach(range($nam2, 2000) as $y2){
            if(nam_nhuan($y2)){
                $ketqua2[] = $y2;
            }
        }

        if(!empty($ketqua2)){
            $result2 = implode(", ", $ketqua2);
        } else {
            $result2 = "Không có năm nhuận từ năm $nam2 đến 2000";
        }
    }
    ?>

    <form action="" method="post">
        <div class="d-flex">
            <table border="0" cellpadding="0">
                <h2>Năm nhập vào lớn hơn 2000 </h2>
                <th colspan="2">
                    <h2>TÌM NĂM NHUẬN</h2>
                </th>
                <tr>
                    <td>Năm: </td>
                    <td><input type="text" name="nam" size="30" value="<?php echo $nam; ?> " /></td>
                </tr>
                <tr>
                    <td>Kết quả tìm kiếm:</td> <br>
                    <td>
                        <textarea disabled><?php echo isset($result) ? $result : ''; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="namLonHon2000" size="20" value="Tìm Năm Nhuận" /></td>
                </tr>
            </table>
            <table border="0" cellpadding="0">
                <h2>Năm nhập vào bé hơn 2000 </h2>
                <th colspan="2">
                    <h2>TÌM NĂM NHUẬN</h2>
                </th>
                <tr>
                    <td>Năm: </td>
                    <td><input type="text" name="nam2" size="30" value="<?php echo $nam2; ?> " /></td>
                </tr>
                <tr>
                    <td>Kết quả tìm kiếm:</td> <br>
                    <td>
                        <textarea disabled><?php echo isset($result2) ? $result2 : ''; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="namBeHon2000" size="20" value="Tìm Năm Nhuận" /></td>
                </tr>
            </table>
        </div>

    </form>
</body>

</html>
<?php $this->end(); ?>