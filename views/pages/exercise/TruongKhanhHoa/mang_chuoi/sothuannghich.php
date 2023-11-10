<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
    function isThuanNghich($num):bool {
        $soĐaoNguoc = strrev($num);
        return $num == $soĐaoNguoc ? true : false;
    }
?>
<?php
    $n = isset($_POST['n']) ? $_POST['n'] : "";
    $str = "";
    if (isset($_POST['xuly']) && is_numeric($n)) {
        $arr = [];
        for ($i=10; $i <= 999; $i++) { 
            if(isThuanNghich($i)) {
                $arr[] = $i;
            }
        }
        $kq = implode(" ", $arr);
        $str = "Các số thuận nghịch là: ". $kq;
    }
?>
    <form action="" method="post">
        <fieldset>
            <legend>Tìm số thuận nghịch</legend>
            <table border='0'>
                <tr>
                    <td>Nhập n:</td>
                    <td><input type="text" name="n" value="<?= $n ?? '' ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="xuly" value="Xử lý" /></td>
                </tr>
                <tr>
                    <td>Kết quả:</td>
                    <td><textarea name="ketqua" cols="70" rows="4" disabled="disabled"><?= $str ?? '' ?></textarea></td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>

</html>