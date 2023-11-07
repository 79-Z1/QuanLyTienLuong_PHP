<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

try {
    $data = json_decode(file_get_contents("php://input"));
    $TenTK = $data->TenTK;
    $MatKhau = $data->MatKhau;

    $sql = "UPDATE `tai_khoan` SET `MatKhau`= '$MatKhau' WHERE TenTK = '$TenTK'";
    $resultCheck = mysqli_query($conn, $sql);

    echo json_encode(
        array(
            "message" => "change password success",
            "status" => true,
        )
    );
} catch (\Throwable $th) {
    http_response_code(200);
    echo json_encode(
        array(
            "message" => "change password false",
            "status" => false
        )
    );
}
