<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>tinh dien tich HCN</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

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
    if (isset($_POST['hoTen']))
        $hoTen = trim($_POST['hoTen']);
    else $hoTen = "";

    if (isset($_POST['diaChi']))
        $diaChi = trim($_POST['diaChi']);
    else $diaChi = "";

    if (isset($_POST['lop']))
        $lop = trim($_POST['lop']);
    else $lop = "";

    $ketqua = "";

    // $form ="";

    // if(isset($_POST['radLa'])&&$_POST['radLa']=='gv'){
    //     $form = 
    //     "
    //     <tr><td>Trình độ</td>
    //         <td><select name='trinhDo'>
    //             <option value='cn' selected>
    //                 Cử Nhân
    //             </option>
    //             <option value='ths'>
    //                 Thạc Sĩ
    //             </option>
    //             <option value='ts'>
    //                 Tiến Sĩ
    //             </option>
    //         </select></td>
    //     </tr>
    //     ";
    // }
    // else{
    //     $form = 
    //     "
    //         <tr>
    //             <td>Lớp</td>
    //             <td><input type='text' name='lop'/></td>
    //         </tr>
    //         <tr><td>Ngành</td>
    //         <td><select name='nganh'>
    //             <option value='cntt' selected>
    //                 Công Nghệ Thông Tin
    //             </option>
    //             <option value='kt'>
    //                 Kinh Tế
    //             </option>
    //             <option value='dt'>
    //                 Điện Tử
    //             </option>
    //             <option value='xd'>
    //                 Xây dựng
    //             </option>
    //         </select></td>
    //     </tr>
    //     ";
    // }



    class Nguoi
    {
        public $hoTen;
        public $diaChi;
        public $gioiTinh;
    }

    class SinhVien extends Nguoi
    {
        public $lop;
        public $nganhHoc;

        function tinhDiemThuong()
        {
            if ($this->nganhHoc == "cntt") return 1;
            elseif ($this->nganhHoc == "kt") return 1.5;
            else return 0;
        }
    }

    class GiangVien extends Nguoi
    {
        public $trinhDo;

        const luongCoBan = 1500000;

        function tinhLuong()
        {
            switch ($this->trinhDo) {
                case "cn":
                    return self::luongCoBan * 2.34;
                case "ths":
                    return self::luongCoBan * 3.67;
                case "ts":
                    return self::luongCoBan * 5.66;
            }
        }
    }

    if (isset($_POST['nhap'])) {
        if (isset($_POST['radLa']) && $_POST['radLa'] == 'gv') {
            $gv = new GiangVien();
            $gv->hoTen = $hoTen;
            $gv->diaChi = $diaChi;
            if (isset($_POST['radGT']) && $_POST['radGT'] == 'nam') {
                $gv->gioiTinh = "Nam";
            } else $gv->gioiTinh = "Nữ";
            switch ($_POST['trinhDo']) {
                case "cn":
                    $gv->trinhDo = "cn";
                    break;
                case "ths":
                    $gv->trinhDo = "ths";
                    break;
                case "ts":
                    $gv->trinhDo = "ts";
                    break;
            }
            $ketqua = "\nThông tin của Giảng Viên vừa nhập";
            $ketqua .= "\nHọ tên: " . $gv->hoTen;
            $ketqua .= "\nGiới tính: " . $gv->gioiTinh;
            $ketqua .= "\nĐịa chỉ: " . $gv->diaChi;
            switch ($_POST['trinhDo']) {
                case "cn":
                    $ketqua .= "\nTrình độ: Cử Nhân";
                    break;
                case "ths":
                    $ketqua .= "\nTrình độ: Thạc Sĩ";
                    break;
                case "ts":
                    $ketqua .= "\nTrình độ: Tiến Sĩ";
                    break;
            }
            $ketqua .= "\nLương: " . $gv->tinhLuong();
        } else {
            $sv = new SinhVien();
            $sv->hoTen = $hoTen;
            $sv->diaChi = $diaChi;
            $sv->lop = $lop;
            if (isset($_POST['radGT']) && $_POST['radGT'] == 'nam') {
                $sv->gioiTinh = "Nam";
            } else $sv->gioiTinh = "Nữ";
            if ($_POST['nganh'] == "cntt") $sv->nganhHoc = "cntt";
            elseif ($_POST['nganh'] == "kt") $sv->nganhHoc = "kt";
            else $sv->nganhHoc = "other";
            $ketqua = "\nThông tin của Sinh Viên vừa nhập";
            $ketqua .= "\nHọ tên: " . $sv->hoTen;
            $ketqua .= "\nGiới tính: " . $sv->gioiTinh;
            $ketqua .= "\nĐịa chỉ: " . $sv->diaChi;
            $ketqua .= "\nLớp: " . $sv->lop;
            switch ($_POST['nganh']) {
                case "cntt":
                    $ketqua .= "\nNgành: Công Nghệ Thông Tin";
                    break;
                case "kt":
                    $ketqua .= "\nNgành: Kinh Tế";
                    break;
                case "dt":
                    $ketqua .= "\nNgành: Điện Tử";
                    break;
                case "xd":
                    $ketqua .= "\nNgành: Xây Dựng";
                    break;
            }
            $ketqua .= "\nĐiểm thưởng: " . $sv->tinhDiemThuong();
        }
    }

    ?>
    <form align='center' action="" method="post">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h3>NHẬP THÔNG TIN</h3>
                </th>
            </thead>
            <tr>
                <td>Họ tên</td>
                <td><input type="text" name="hoTen" value="<?php echo $hoTen; ?> " /></td>
            </tr>
            <tr>
                <td>Giới tính</td>
                <td>
                    <input type="radio" name="radGT" value="nam" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'nam') echo 'checked="checked"'; ?> checked />Nam
                    <input type="radio" name="radGT" value="nu" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'nu') echo 'checked="checked"'; ?> />Nữ

                </td>
            </tr>
            <tr>
                <td>Địa chỉ</td>
                <td><input type="text" name="diaChi" value="<?php echo $diaChi; ?> " /></td>
            </tr>
            <tr>
                <td>Là</td>
                <td>
                    <input id="gv" type="radio" name="radLa" value="gv" <?php if (isset($_POST['radLa']) && $_POST['radLa'] == 'gv') echo 'checked="checked"'; ?> />Giảng Viên
                    <input id="sv" type="radio" name="radLa" value="sv" <?php if (isset($_POST['radLa']) && $_POST['radLa'] == 'sv') echo 'checked="checked"'; ?> />Sinh Viên

                </td>
            </tr>
            <tr>

            </tr>
            <!-- <?php echo $form; ?> -->
            <tr id="giangVien">
                <td>Trình độ</td>
                <td>
                    <select name='trinhDo'>
                        <option value='cn' selected>
                            Cử Nhân
                        </option>
                        <option value='ths'>
                            Thạc Sĩ
                        </option>
                        <option value='ts'>
                            Tiến Sĩ
                        </option>
                    </select>
                </td>
            </tr>
            <tr class="sinhvien">
                <td>Lớp</td>
                <td><input type='text' name='lop' /></td>
            </tr>
            <tr  class="sinhvien">
                <td>Ngành</td>
                <td>
                    <select name='nganh'>
                        <option value='cntt' selected>
                            Công Nghệ Thông Tin
                        </option>
                        <option value='kt'>
                            Kinh Tế
                        </option>
                        <option value='dt'>
                            Điện Tử
                        </option>
                        <option value='xd'>
                            Xây dựng
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center"><input type="submit" value="Nhập" name="nhap" /></td>
            </tr>
            <tr>
                <td colspan="3"><textarea disabled="disabled" cols="50" rows="7" name="ketqua"> <?php echo $ketqua ?></textarea></td>
            </tr>
        </table>
    </form>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('.sinhVien').hide();
        $('#giangVien').hide();
        $('#gv').click(function() {
            $('#giangVien').show();
            $('.sinhVien').hide();
        });
        $('#sv').click(function() {
            $('.sinhVien').show();
            $('#giangVien').hide();
        });
    });
</script>

</html>