<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

try {
    $data = json_decode(file_get_contents("php://input"));
    $maTB = isset($data->MaTB) ? $data->MaTB : null;

    if ($maTB) {
        $sql = "DELETE FROM `thong_bao` WHERE MaTB = '$maTB'";
        $result = mysqli_query($conn, $sql);
        http_response_code(200);
        echo json_encode(
            array(
                "message" => "delete noti successful",
                "status" => true,
            )
        );
    } else {
        $sql = "DELETE FROM `thong_bao` WHERE 1";
        $result = mysqli_query($conn, $sql);
        http_response_code(200);
        echo json_encode(
            array(
                "message" => "delete noti successful",
                "status" => true,
            )
        );
    }
} catch (\Throwable $th) {
    http_response_code(200);
    echo json_encode(
        array(
            "message" => "delete noti false",
            "status" => false
        )
    );
}
