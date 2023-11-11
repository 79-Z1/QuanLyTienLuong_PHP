<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
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
    function kt_nam_nhuan($nam)
    {
        if (($nam % 4 == 0 && $nam % 100 != 0) || $nam % 400 == 0) {
            return true;
        }
        return false;
    }
    ?>
    <?php
    if (isset($_POST['nambehon2000']))
        $nambehon2000 = trim($_POST['nambehon2000']);
    else $nambehon2000 = "";
    if (isset($_POST['namlonhon2000']))
        $namlonhon2000 = trim($_POST['namlonhon2000']);
    else $namlonhon2000 = "";
    $mangbehon2000 = array();
    $manglonhon2000 = array();
    $kqbehon2000 = "";
    $kqlonhon2000 = "";

    if (isset($_POST['xuly'])) {
        if (is_numeric($namlonhon2000)) {
            if($namlonhon2000 > 2000) {
                for ($i = 2000; $i < $namlonhon2000; $i++) {
                    if (kt_nam_nhuan($i)) {
                        $manglonhon2000[] = $i;
                    }
                }
            }
        } else echo "<font color='red'>Vui lòng nhập vào số! </font>";
        if (is_numeric($nambehon2000)) {
            if( $nambehon2000 < 2000) {
                for ($i = $nambehon2000; $i <= 2000; $i++) {
                    if (kt_nam_nhuan($i)) {
                        $mangbehon2000[] = $i;
                    }
                }
            }
        } else echo "<font color='red'>Vui lòng nhập vào số! </font>";
        $a = implode(" ", $mangbehon2000);
        $b = implode(" ", $manglonhon2000);
        if ($a != "") {
            $kqbehon2000 .= $a . " là năm nhuận";
        } else $kqbehon2000 .= "Không có năm nhuận";
        if ($b != "") {
            $kqlonhon2000 .= $b . " là năm nhuận";
        } else $kqlonhon2000 .= "Không có năm nhuận";
    }
    ?>
    <form align='center' action="" method="post">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h3>TÌM NĂM NHUẬN < 2000</h3>
                </th>
            </thead>
            <tr>
                <td>Năm nhập < 2000:</td>
                <td><input type="text" name="nambehon2000" value="<?php echo $nambehon2000; ?> " /></td>
            </tr>
            <tr>
                <td></td>
                <td><textarea name="behon2000" rows="3" cols="40"><?php echo $kqbehon2000 ?></textarea></td>
            </tr>
            <thead>
                <th colspan="2" align="center">
                    <h3>TÌM NĂM NHUẬN > 2000</h3>
                </th>
            </thead>
            <tr>
                <td>Năm nhập > 2000:</td>
                <td><input type="text" name="namlonhon2000" value="<?php echo $namlonhon2000; ?> " /></td>
            </tr>
            <tr>
                <td></td>
                <td><textarea name="lonhon2000" rows="3" cols="40"><?php echo $kqlonhon2000 ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Xử lý" name="xuly" /></td>
            </tr>
        </table>
    </form>

</body>

</html>