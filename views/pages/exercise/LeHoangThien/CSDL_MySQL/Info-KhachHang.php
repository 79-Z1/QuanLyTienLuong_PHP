<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<style>
    tr:nth-child(even) {
        background-color: #dddddd;
    }

    th {
        color: blueviolet;
    }

    img {
        width: 50px;
        height: 50px;
        border-radius: 100%;
    }
</style>
<?php
if (isset($_GET['maKH'])) {
    $maKH = trim($_GET['maKH']);
} else $maKH = "";

$conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
    or die('Could not connect to MySQL: ' . mysqli_connect_error());
$sql = 'select Ma_khach_hang,Ten_khach_hang,Phai,Dia_chi,Dien_thoai,Email from khach_hang';
$result = mysqli_query($conn, $sql);
?>


    <table class="table table-hover table-nowrap">
        <thead>
            <tr>
                <th width="50">STT</th>
                <th width="100">Mã KH</th>
                <th width="800">Tên khách hàng</th>
                <th width="200">Phái</th>
                <th width="1000">Địa chỉ</th>
                <th width="200">Điện thoại</th>
                <th width="200">Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) <> 0) {
                $stt = 1;
                while ($rows = mysqli_fetch_array($result)) {
                    if ($rows['Phai'] == 0) $gt = "Nữ";
                        else $gt = "Nam";
                    echo "<tr>
                    <td>$stt</td>
                    <td>{$rows['Ma_khach_hang']}</td>
                    <td>{$rows['Ten_khach_hang']}</td>
                    <td> {$gt}</td> 
                    <td>{$rows['Dia_chi']}</td>
                    <td>{$rows['Dien_thoai']}</td>
                    <td>{$rows['Email']}</td>
                    <td>
                        <a href='index.php?page=LHT-CSDL_MySQL-edit-KhachHang&maKH={$rows['Ma_khach_hang']}'><i style='color:blue' class='bi bi-pencil-square'></i></a>
                        <a href='index.php?page=LHT-CSDL_MySQL-delete-KhachHang&maKH={$rows['Ma_khach_hang']}'><i style='color:red' class='bi bi-person-x'></i></a>
            </td>
                    </tr>";
                    $stt+=1;
                }
            }
            ?>
        </tbody>
    </table>
<?php $this->end(); ?>