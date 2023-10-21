<?php $this->layout('layout_accountant') ?>
<?php $this->section('content'); ?>
<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1]."/connect.php");

	$rowsPerPage = 8; //số mẩu tin trên mỗi trang
	
	if (!isset($_GET['p'])) {
		$_GET['p'] = 1;
	}

	$offset = ($_GET['p'] - 1) * $rowsPerPage;

	$sqlTimKiem =
    "select *, TenPhong, TenChucVu from nhan_vien, chuc_vu, phong_ban 
	where nhan_vien.MaPhong = phong_ban.MaPhong 
	and nhan_vien.MaChucVu = chuc_vu.MaChucVu order by MaNV
	";
	$resultTimKiem = mysqli_query($conn, $sqlTimKiem);
	$numRows = mysqli_num_rows($resultTimKiem);
	$sqlTimKiem .= " limit $offset, $rowsPerPage";
	$resultTimKiem = mysqli_query($conn, $sqlTimKiem);

	if (isset($_POST['submit'])) {
		session_start();
		$_SESSION["MaNV"] = $row['MaNV'];
	}
?>
<div class="card shadow border-0 mb-7">
    <div class="card-header">
        <h5 class="mb-0">TÍNH LƯƠNG NHÂN VIÊN</h5>
    </div>
    <div>
        <table class="table table-hover table-nowrap">
            <thead class="thead-light">
                <tr>
                    <th scope="col">mã nhân viên</th>
                    <th scope="col">họ tên</th>
                    <th scope="col">chức vụ</th>
                    <th scope="col">phòng</th>
                    <th scope="col">tình trạng</th>
					<th scope="col">tính lương</th>
                </tr>
            </thead>

            <tbody>
                <?php
                //tổng số trang
                $maxPage = floor($numRows / $rowsPerPage) + 1;
                if (mysqli_num_rows($resultTimKiem) <> 0) {
                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                        echo "<tr>
                        <td>{$rows['MaNV']}</td>
                        <td>{$rows['HoNV']} {$rows['TenNV']}</td>
                        <td>{$rows['TenChucVu']}</td>
                        <td>{$rows['TenPhong']}</td>
						<td> Đã Tính </td>
                        <td>
						<button name='submit' type='submit' class='btn btn-primary w-100' id='submit-btn'>
							Tính lương
						</button>
						</td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
	echo "<p align = 'center'>";

	if ($_GET['p'] > 1)
	{
		echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=accountant-payroll&p=" . (1) . "> << </a> ";
		echo "<a href=" .$_SERVER['PHP_SELF']."?page=accountant-payroll&p=".($_GET['p']-1)."> < </a> "; 
	}
	
	for ($i=1 ; $i<=$maxPage ; $i++)
	{
		if ($i == $_GET['p'])
		{ 
			echo '<b>'.$i.'</b> '; //trang hiện tại sẽ được bôi đậm
		} 
		else
			echo "<a href=" .$_SERVER['PHP_SELF']. "?page=accountant-payroll&p=" .$i.">".$i."</a> ";
	}
	if ($_GET['p'] < $maxPage)
	{ 
		echo "<a href=". $_SERVER['PHP_SELF']."?page=accountant-payroll&p=".($_GET['p']+1)."> > </a>";
		echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=accountant-payroll&p=" . ($maxPage) . "> >> </a> ";
	}
	echo "</p>";
?>
<?php $this->end(); ?>