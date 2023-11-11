<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<style>
    form {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

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
<?php
function isThuanNghich($num): bool
{
    $soĐaoNguoc = strrev($num);
    return $num == $soĐaoNguoc ? true : false;
}
?>
<?php
$n = isset($_POST['n']) ? $_POST['n'] : "";
$str = "";
if (isset($_POST['xuly']) && is_numeric($n)) {
    if ($n >= 10) {
        $arr = [];
        for ($i = 10; $i <= $n; $i++) {
            if (isThuanNghich($i)) {
                $arr[] = $i;
            }
        }
        $kq = implode(" ", $arr);
        $str = "Các số thuận nghịch là: " . $kq;
    } else echo "Nhập vào số > 10";
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
            <tr>
                <td><a class="mt-5" href="index.php">Quay lại</a></td>
            </tr>
        </table>
    </fieldset>
</form>
<?php $this->end(); ?>