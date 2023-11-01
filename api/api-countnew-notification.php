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

    $sql = "SELECT * FROM `thong_bao` WHERE NguoiNhan = '$nguoinhan' AND TinhTrang = '0'";
    $results = mysqli_query($conn, $sql);
    http_response_code(200);
    $num = mysqli_num_rows($results);
    echo json_encode(
        array(
            "message" => "count new noti successful",
            "status" => true,
            "newNotiNumber" => $num,
        )
    );
} catch (\Throwable $th) {
    http_response_code(200);
    echo json_encode(
        array(
            "message" => "count new noti false",
            "status" => false
        )
    );
}
