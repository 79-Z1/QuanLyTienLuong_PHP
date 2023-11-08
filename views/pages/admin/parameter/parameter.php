<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

if (isset($_GET['maTS']))
    $maTS = trim($_GET['maTS']);
else $maTS = "";
if (isset($_GET['tenTS']))
    $tenTS = $_GET['tenTS'];
else $tenTS = "";

if (isset($_GET['DVT']))
    $DVT = $_GET['DVT'];
else $DVT = "";

if (isset($_GET['giaTri']))
    $giaTri = $_GET['giaTri'];
else $giaTri = "";
if (isset($_GET['tinhTrang']))
    $tinhTrang = $_GET['tinhTrang'];
else $tinhTrang = "";


$rowsPerPage = 8; //số mẩu tin trên mỗi trang, giả sử là 8


if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
$offset = ($_GET['p'] - 1) * $rowsPerPage;

$sqlTimKiem =
    "select * from tham_so where 1";

if (isset($_GET['timkiem'])) {
    if ($maTS != "") {
        $sqlTimKiem .= " and MaTS = '$maTS' ";
    }
    if ($tenTS != "") {
        $sqlTimKiem .= " and TenTS like '%$tenTS%' ";
    }
    if ($DVT != "") {
        $sqlTimKiem .= " and DVT like '%$DVT%' ";
    }
    if ($giaTri != "") {
        $sqlTimKiem .= " and GiaTri = '$giaTri' ";
    }
    if ($tinhTrang != "") {
        $sqlTimKiem .= " and TinhTrang = '$tinhTrang' ";
    }

    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
}

$sqlTimKiem .= " order by MaTS";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);

$numRows = mysqli_num_rows($resultTimKiem);
$sqlTimKiem .= " LIMIT $offset,$rowsPerPage";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);



?>
<!-- Card stats -->
<div class="g-6 mb-3 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 d-flex">
            <nav class="navbar navbar-light bg-light d-flex justify-content-center py-1">
                <form action="" method="get">
                    <table>
                        <tr>
                            <td>
                                <p>Mã tham số</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maTS" value="<?php echo $maTS; ?>"></td>
                            <td>
                                <p>Tên tham số</p>
                            </td>
                            <td>
                                <input class="form-control me-2 search-input" type="text" name="tenTS" value="<?php echo $tenTS; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Giá Trị</p>
                            </td>
                            <td>
                                <input class="form-control me-2 search-input" type="text" name="giaTri" value="<?php echo $giaTri; ?>">
                            </td>
                            <td>
                                <p>Tình trạng</p>
                            </td>
                            <td>
                            <select name="tinhTrang" class="form-select search-option">
                                    <option value="">Trống</option>
                                    <option value="0" <?php if (isset($_GET['tinhTrang']) && $_GET['tinhTrang'] == '0') echo " selected"; ?>>Chưa sử dụng</option>
                                    <option value="1" <?php if (isset($_GET['tinhTrang']) && $_GET['tinhTrang'] == '1') echo " selected"; ?>>Đã sử dụng</option>
                                    
                                </select>
                            </td>
                        </tr>
                        <tr >
                            <td>
                                <p>Đơn vị tính</p>
                            </td>
                            <td>
                                <input class="form-control me-2 search-input" type="text" name="DVT" value="<?php echo $DVT; ?>">
                            </td>

                        </tr>
                        <tr align="center" colspan="4">
                            <td align="end" colspan="2">
                                <input class="btn btn-outline-success search-btn w-50" name="timkiem" type="submit" value="Tìm kiếm" />
                                <input type="text" name="page" value="admin-parameter" style="display: none">

                            </td>
                            <td align="start" colspan="2">
                                <a href="index.php?page=add-parameter" class="btn btn-outline-success search-btn w-50">Thêm</a>
                            </td>
                        </tr>

                    </table>
                </form>
            </nav>
        </div>
    </div>
</div>

<div style="height: 450px">
    <div class="card shadow border-0 mb-3">
        <table class="table table-hover table-nowrap">
            <thead>
                <tr>
                    <th scope="col">Mã tham số</th>
                    <th scope="col">Tên tham số</th>
                    <th scope="col">Đơn vị tính</th>
                    <th scope="col">Giá trị</th>
                    <th scope="col">Tình trạng</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                //tổng số trang
                $maxPage = ceil($numRows / $rowsPerPage);
                if (mysqli_num_rows($resultTimKiem) <> 0) {

                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                        if ($rows['TinhTrang'] == 0) {
                            $TT = "Chưa sử dụng";
                        } else if ($rows['TinhTrang'] == 1) {
                            $TT = "Đã sử dụng";
                        }
                        echo "<tr>
                            <td >{$rows['MaTS']}</td>
                            <td >{$rows['TenTS']}</td>
                            <td >{$rows['DVT']}</td>
                            <td >{$rows['GiaTri']}</td>
                            <td >{$TT}</td>
                            <td >
                                <a href='index.php?page=edit-parameter&maTS={$rows['MaTS']}'><i style='color:blue' class='bi bi-pencil-square'></i></a>
                                <a href='index.php?page=delete-parameter&maTS={$rows['MaTS']}'><i style='color:red' class='bi bi-person-x'></i></a>
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
echo '<div align="center">';
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-parameter&maTS=$maTS&tenTS=$tenTS&giaTri=$giaTri&DVT=$DVT&tinhTrang=$tinhTrang&timkiem=Tìm+kiếm&p=" . (1) . ">Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-parameter&=maTS=$maTS&tenTS=$tenTS&giaTri=$giaTri&DVT=$DVT&tinhTrang=$tinhTrang&timkiem=Tìm+kiếm&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>';
    } else {
        echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-parameter&maTS=$maTS&tenTS=$tenTS&giaTri=$giaTri&DVT=$DVT&tinhTrang=$tinhTrang&timkiem=Tìm+kiếm&p=" . $i . ">" . $i . "</a> ";
    }
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-parameter&maTS=$maTS&tenTS=$tenTS&giaTri=$giaTri&DVT=$DVT&tinhTrang=$tinhTrang&timkiem=Tìm+kiếm&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=admin-parameter&maTS=$maTS&tenTS=$tenTS&giaTri=$giaTri&DVT=$DVT&tinhTrang=$tinhTrang&timkiem=Tìm+kiếm&p=" . $maxPage . ">Về cuối</a> ";
echo "</div>";
?>
<?php $this->end(); ?>