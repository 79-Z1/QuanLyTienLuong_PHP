<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Nhập thông tin</title>
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
    <form align='center' action="" method="GET">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h3>Phiếu thông tin</h3>
                </th>
            </thead>
            <tr>
                <td>Họ tên:</td>
                <td><input type="text" name="hoten" value="<?php  echo $hoten;?> " /></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type="text" name="diachi" value="<?php  echo $diachi;?> " /></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td><input type="text" name="sdt" value="<?php  echo $sdt;?> " /></td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td style= "display: flex">
                <input type="radio" name="radGT" value="Nam"<?php if(isset($_GET['radGT'])&&$_GET['radGT']=='Nam') echo 'checked="checked"';?> checked/>Nam<br>
	            <input type="radio" name="radGT" value="Nu" <?php if(isset($_GET['radGT'])&&$_GET['radGT']=='Nu') echo 'checked="checked"';?>/>Nữ<br>
                </td>
            </tr>
            <tr>
                <td>Quốc tịch:</td>
                <td>
                <select name="quoctich">
			        <option value="vietnam" <?php if(isset($_GET['quoctich'])&& $_GET['quoctich']=='vietnam') echo 'selected';?>>
				    Việt Nam
			        </option>
			        <option value="my" <?php if(isset($_GET['quoctich'])&& $_GET['quoctich']=='vietnam') echo 'selected';?>>
				    Mỹ
			        </option>
		        </select>
                </td>
            </tr>
            <tr>
                <td>Các môn đã học:</td>
                <td style= "display: flex">
                <input type="checkbox" name="chk1" value="php" 
		            <?php if(isset($_GET['chk1'])&& $_GET['chk1']=='php') echo 'checked'; else echo ""?>/>PHP & MySQL<br> 
	            <input type="checkbox" name="chk2" value="c#"
		            <?php if(isset($_GET['chk2'])&& $_GET['chk2']=='c#') echo 'checked'; else echo ""?>/>C#<br>
                <input type="checkbox" name="chk3" value="xml" 
		            <?php if(isset($_GET['chk3'])&& $_GET['chk3']=='xml') echo 'checked'; else echo ""?>/>XML<br> 
                <input type="checkbox" name="chk4" value="python" 
		            <?php if(isset($_GET['chk4'])&& $_GET['chk3']=='python') echo 'checked'; else echo ""?>/>Python<br> 
                </td>
            </tr>
            <tr>
                <td>Ghi chú: </td>
                <td>
                <textarea name="comment" rows="3" cols="40"><?php if(isset($_GET['comment'])) echo $_GET['comment']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="text" style="display:none" name="page" value="KQThucHanhForm4">
                    <input class="btn btn-success" type="submit" value="Gửi" name="gui" />
                </td>
            </tr>
        </table>
    </form>
    <form action="" method="get">
    <input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
</body>
<?php $this->end(); ?>