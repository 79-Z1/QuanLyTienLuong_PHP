<html>
    <body>
        <h2>Thông tin hãng sữa</h2>
        <table>

        </table>
    </body>
</html>
<?php
// 1. Ket noi CSDL
$conn = mysqli_connect('localhost', 'root', '', 'qlbansua') 
or die ('Không thể kết nối tới database'. mysqli_connect_error());
mysqli_set_charset($conn,'UTF8');


// 2. Chuan bi cau truy van & 3. Thuc thi cau truy van
$sql = "SELECT * FROM khach_hang";


$result = mysqli_query($conn, $sql);



// 4.Xu ly du lieu tra ve

?>

<html>
    <body>
        <h2>Thông tin hãng sữa</h2>
        <table border="1">
        <tr>    
            <td>Mã khách hàng</td>
            <td>Mã khách hàng</td>
            <td>Mã khách hàng</td>
            <td>Mã khách hàng</td>
            <td>Mã khách hàng</td>
        </tr>
        <?php
            if(mysqli_num_rows($result)!=0){

                while ($row = mysqli_fetch_array($result))
                { 
                    echo
                    "<tr>
                        <td>$row[Ma_khach_hang]</td>
                        <td>$row[Ma_khach_hang]</td>
                        <td>$row[Ma_khach_hang]</td>
                        <td>$row[Ma_khach_hang]</td>
                        <td>$row[Ma_khach_hang]</td>
                    </tr>";
                    
                }
            }
        ?>
        </table>
    </body>
</html>