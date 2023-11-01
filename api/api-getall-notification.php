<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

try {
    $data = json_decode(file_get_contents("php://input"));
    $nguoinhan = $data->NguoiNhan;

    $sql = "SELECT * FROM `thong_bao` WHERE NguoiNhan = '$nguoinhan' ORDER BY ThoiGianGui DESC";
    $results = mysqli_query($conn, $sql);
    $notiList = array();
    if (mysqli_num_rows($results) <> 0) {
        while ($row = mysqli_fetch_array($results)) {
            $notiList[] = array(
                'MaTB' => $row['MaTB'],
                'NguoiGui' => $row['NguoiGui'],
                'NguoiNhan' => $row['NguoiNhan'],
                'NoiDung' => $row['NoiDung'],
                'TinhTrang' => $row['TinhTrang'],
                'ThoiGianGui' => $row['ThoiGianGui']
            );
        }
    }
    http_response_code(200);
    echo json_encode(
        array(
            "message" => "get all noti successful",
            "status" => true,
            "notiList" => $notiList,
        )
    );
} catch (\Throwable $th) {
    http_response_code(200);
    echo json_encode(
        array(
            "message" => "get all noti false",
            "status" => false,
        )
    );
}
