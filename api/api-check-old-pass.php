<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

try {
    $data = json_decode(file_get_contents("php://input"));
    $MaNV = $data->MaNV;
    $OldPass = $data->OldPass;
    $check = false;

    $sqlCheck = "SELECT * FROM tai_khoan
        WHERE TenTK = '$MaNV' AND MatKhau = '$OldPass'";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    if (mysqli_num_rows($resultCheck) > 0) {
        $check =  true;
    }

    echo json_encode(
        array(
            "message" => "check old password success",
            "status" => true,
            "check" => $check,
        )
    );
} catch (\Throwable $th) {
    http_response_code(200);
    echo json_encode(
        array(
            "message" => "check old password false",
            "status" => false
        )
    );
}
