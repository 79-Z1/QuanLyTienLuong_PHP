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
if (isset($_POST['radGT'])){
    $pheptinh = $_POST['radGT'];
} else $pheptinh = "Bạn chưa chọn phép tính";
if(isset($_POST['sothunhat']))  
    $sothunhat=trim($_POST['sothunhat']); 
else $sothunhat=0;
if(isset($_POST['sothuhai'])) 
    $sothuhai=trim($_POST['sothuhai']); 
else $sothuhai=0;
switch ($pheptinh) {
    case 'Cong':
        $ketqua = $sothunhat + $sothuhai;
        break;
    case 'Tru':
        $ketqua = $sothunhat - $sothuhai;
        break;
    case 'Nhan':
        $ketqua = $sothunhat * $sothuhai;
        break;
    case 'Chia':
        $ketqua = $sothunhat / $sothuhai;
}
?>
<form align='center' action="" method="post">
    <table>
        <thead>
            <th colspan="2" align="center">
                <h3>KẾT QUẢ PHÉP TÍNH TRÊN HAI SỐ</h3>
            </th>
        </thead>
        <tr>
            <td>Phép tính đã chọn:</td>
            <td>
            <?php
                echo $pheptinh
            ?>
            </td>
        </tr>
        <tr>
            <td>Số thứ nhất:</td>
            <td><input type="text" disabled name="sothunhat" value="<?php  echo $sothunhat;?> " /></td>
        </tr>
        <tr>
            <td>Số thứ hai:</td>
            <td><input type="text" disabled name="sothunhat" value="<?php  echo $sothuhai;?> " /></td>
        </tr>
        <tr>
            <td>Kết quả:</td>
            <td><input type="text" disabled name="ketqua" value="<?php  echo $ketqua;?> " /></td>
        </tr>
        <tr>
            <td><a href="index.php">Quay lại trang trước</a></td>
        </tr>
    </table>
</form>
<?php $this->end(); ?>