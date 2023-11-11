<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>iNFO</title>
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
    if(isset($_POST['hoten']))  
        $sothunhat=trim($_POST['hoten']); 
    else $hoten="";
    if(isset($_POST['diachi'])) 
        $diachi=trim($_POST['diachi']); 
    else $diachi="";
    if(isset($_POST['sodienthoai'])) 
        $sodienthoai=trim($_POST['sodienthoai']); 
    else $sodienthoai="";
    if(isset($_POST['ghichu'])) 
        $ghichu=trim($_POST['ghichu']); 
    else $ghichu="";
?>
    <form align='center' action="index.php?page=TKH-form-xulythongtin" method="post">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h3>PHIẾU THÔNG TIN</h3>
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
                <td><input type="text" name="sodienthoai" value="<?php  echo $sodienthoai;?> " /></td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td style="display: flex;">
                    <input style="margin-right: 5px;" type="radio" name="radGT" value="Nam"
                        <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nam') echo 'checked="checked"';?>
                        checked />Nam<br>
                    <input style="margin-right: 5px;" type="radio" name="radGT" value="Nu"
                        <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nu') echo 'checked="checked"';?> />Nữ<br>
                </td>
            </tr>
            <tr>
                <td>Quốc tịch:</td>
                <td>
                    <select name="quoctich">
                        <option value="Việt Nam"
                            <?php if(isset($_POST['quoctich'])&& $_POST['quoctich']=='Việt Nam') echo 'selected';?>>
                            Việt Nam
                        </option>
                        <option value="USA"
                            <?php if(isset($_POST['quoctich'])&& $_POST['quoctich']=='USA') echo 'selected';?>>
                            USA
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Các môn đã học:</td>
                <td style="display: flex;">
                    <input type="checkbox" name="chk1" value="PHP&MySQL"
                        <?php if(isset($_POST['chk1'])&& $_POST['chk1']=='PHP&MySQL') echo 'checked'; else echo ""?> />PHP & My SQL
                    <br>
                    <input type="checkbox" name="chk2" value="C#"
                        <?php if(isset($_POST['chk2'])&& $_POST['chk2']=='C#') echo 'checked'; else echo ""?> />C#
                    <br>
                    <input type="checkbox" name="chk3" value="XML"
                        <?php if(isset($_POST['chk3'])&& $_POST['chk3']=='XML') echo 'checked'; else echo ""?> />XML
                    <br>
                    <input type="checkbox" name="chk4" value="Python"
                        <?php if(isset($_POST['chk4'])&& $_POST['chk4']=='Python') echo 'checked'; else echo ""?> />Python
                    <br>
                </td>
            </tr>
            <tr>
                <td>Ghi chú:</td>
                <td>
                   <textarea name="ghichu" rows="3" cols="40"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Gửi" name="gui" />
                    <input type="reset" value="Hủy" name="huy"  />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>