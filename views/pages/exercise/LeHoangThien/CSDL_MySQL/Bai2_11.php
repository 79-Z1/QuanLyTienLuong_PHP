<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css' rel='stylesheet' />

    <title>Insert title here</title>
</head>


<body>
    <?php
    //Ket noi CSDL
    $conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
     or die('Could not connect to MySQL: ' . mysqli_connect_error());

    // $sqlSua = 'SELECT * FROM sua';
    $sqlLoai_sua = 'SELECT * FROM loai_sua';
    $sqlHang_sua = 'SELECT * FROM hang_sua';

    // $resultSua = mysqli_query($conn, $sqlSua);
    $resultLoai_sua = mysqli_query($conn, $sqlLoai_sua);
    $resultHang_sua = mysqli_query($conn, $sqlHang_sua);

    if(isset($_POST['maSua'])){
        $maSua = trim($_POST['maSua']);
    }else $maSua ="";
    if(isset($_POST['tenSua'])){
        $tenSua = trim($_POST['tenSua']);
    }else $tenSua ="";
    if(isset($_POST['trongLuong'])){
        $trongLuong = trim($_POST['trongLuong']);
    }else $trongLuong ="";
    if(isset($_POST['donGia'])){
        $donGia = trim($_POST['donGia']);
    }else $donGia ="";
    if(isset($_POST['TPDD'])){
        $TPDD = trim($_POST['TPDD']);
    }else $TPDD ="";
    if(isset($_POST['loiIch'])){
        $loiIch = trim($_POST['loiIch']);
    }else $loiIch ="";



    $err = array();

    if(isset($_POST['them'])){

        $sqlInsert = "INSERT INTO `sua`(`Ma_sua`, `Ten_sua`, `Ma_hang_sua`, `Ma_loai_sua`, `Trong_luong`, `Don_gia`, `TP_Dinh_Duong`, `Loi_ich`, `Hinh`) 
                                VALUES ('$maSua','$tenSua','$_POST[hang_sua]','$_POST[loaiSua]','$trongLuong','$donGia','$TPDD','$loiIch','hinh.jpg')";
        $resultInsert = mysqli_query($conn,$sqlInsert);                   
    }

    ?>
    <form method="post" action="" enctype="multipart/form-data">

        <div align="center">
            <h2 style="width:45%; background-color:red; color: white;">THÊM SỮA MỚI</h2>
            <div align="left" class="card-body" style="width:45%; background-color:pink">
                <div class="row">
                    <div class="col-sm-5">
                        <h5>Mã sữa:</h5>
                    </div>
                    <div class="col-sm-7">
                        <input style="width:50%; height:60%" type="text" name="maSua" value="<?php echo $maSua;?>" id="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <h5>Tên sữa:</h5>
                    </div>
                    <div class="col-sm-7">
                        <input style="width:50%; height:60%" type="text" name="tenSua" value="<?php echo $tenSua;?>" id="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <h5>Hãng sữa:</h5>
                    </div>
                    <div class="col-sm-7">
                        <select name="hang_sua">
                            <?php
                            if (mysqli_num_rows($resultHang_sua) <> 0) {

                                while ($rows = mysqli_fetch_array($resultHang_sua)) {
                                    echo "<option value='$rows[Ma_hang_sua]'";
                                    if(isset($_POST["hang_sua"]) && $_POST["hang_sua"] == $rows['Ma_hang_sua']) echo "selected";
                                    echo ">$rows[Ten_hang_sua]</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <h5>Loại sữa:</h5>
                    </div>
                    <div class="col-sm-7">
                        <select name="loaiSua">
                            <?php
                            if (mysqli_num_rows($resultLoai_sua) <> 0) {

                                while ($rows = mysqli_fetch_array($resultLoai_sua)) {
                                    echo "<option value='$rows[Ma_loai_sua]'";
                                    if(isset($_POST["loaiSua"]) && $_POST["loaiSua"] == $rows['Ma_loai_sua']) echo "selected";
                                    echo ">$rows[Ten_loai]</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <h5>Trọng lượng:</h5>
                    </div>
                    <div class="col-sm-7">
                        <input style="width:50%; height:60%" type="text" name="trongLuong" value="<?php echo $trongLuong;?>" id="">(gr hoặc ml)
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <h5>Đơn giá:</h5>
                    </div>
                    <div class="col-sm-7">
                        <input style="width:50%; height:60%" type="text" name="donGia"  value="<?php echo $donGia;?>" id="">(VNĐ)
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <h5>Thành phần dinh dưỡng:</h5>
                    </div>
                    <div class="col-sm-7">
                        <input style="width:50%; height:60%" type="text" value="<?php echo $TPDD;?>" name="TPDD" id="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <h5>Lợi ích:</h5>
                    </div>
                    <div class="col-sm-7">
                        <input style="width:50%; height:60%" type="text" value="<?php echo $loiIch;?>" name="loiIch" id="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <h5>Hình ảnh:</h5>
                    </div>
                    <div class="col-sm-7">
                        <!-- <input type="file" name="image"> -->
                        <input style="border-radius:10px; height:30px; padding-left: 10px;" type="submit" name="them" value="Thêm">
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
<?php $this->end(); ?>