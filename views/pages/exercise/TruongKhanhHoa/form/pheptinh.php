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
if (isset($_POST['sothunhat']))
    $sothunhat = trim($_POST['sothunhat']);
else $sothunhat = 0;
if (isset($_POST['sothuhai']))
    $sothuhai = trim($_POST['sothuhai']);
else $sothuhai = 0;
?>
<form align='center' action="index.php?page=TKH-form-ketquapheptinh" method="post">
    <table>
        <thead>
            <th colspan="2" align="center">
                <h3>PHÉP TÍNH TRÊN HAI SỐ</h3>
            </th>
        </thead>
        <tr>
            <td>Chọn phép tính:</td>
            <td style="display: flex;">
                <input style="margin-right: 5px;" type="radio" name="radGT" value="Cong" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Cong') echo 'checked="checked"'; ?> checked />Cộng<br>
                <input style="margin-right: 5px;" type="radio" name="radGT" value="Tru" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Tru') echo 'checked="checked"'; ?> />Trừ<br>
                <input style="margin-right: 5px;" type="radio" name="radGT" value="Nhan" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Nhan') echo 'checked="checked"'; ?> />Nhân<br>
                <input style="margin-right: 5px;" type="radio" name="radGT" value="Chia" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Chia') echo 'checked="checked"'; ?> />Chia<br>
            </td>
        </tr>
        <tr>
            <td>Số thứ nhất:</td>
            <td><input type="text" name="sothunhat" value="<?php echo $sothunhat; ?> " /></td>
        </tr>
        <tr>
            <td>Số thứ hai:</td>
            <td><input type="text" name="sothuhai" value="<?php echo $sothuhai; ?> " /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input class="btn btn-primary" type="submit" value="Tính" name="tinh" /></td>
        </tr>
        <tr>
            <td><a href="index.php">Quay lại</a></td>
        </tr>
    </table>
</form>
<?php $this->end(); ?>