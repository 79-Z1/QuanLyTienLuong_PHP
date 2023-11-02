<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

try {
    $data = json_decode(file_get_contents("php://input"));
    $nguoigui = $data->NguoiGui;
    $nguoinhan = $data->NguoiNhan;
    $loaitknn = $data->LoaiTKNguoiNhan;
    $noidung = $data->NoiDung;

    $sql = "INSERT INTO `thong_bao`(`NguoiGui`, `NguoiNhan`, `LoaiTKNguoiNhan`, `NoiDung`) VALUES ('$nguoigui','$nguoinhan','$loaitknn','$noidung')";
    $results = mysqli_query($conn, $sql);
    http_response_code(200);
    echo json_encode(
        array(
            "message" => "insert thong_bao successful",
            "status" => true,
        )
    );
} catch (\Throwable $th) {
    http_response_code(200);
    echo json_encode(
        array(
            "message" => "insert thong_bao fail",
            "status" => false,
        )
    );
}
