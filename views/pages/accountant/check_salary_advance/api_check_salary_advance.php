<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
    header("Access-Control-Allow-Origin: * ");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

    $data = json_decode(file_get_contents("php://input"));
    $type = $data->type;
    $maphieu = $data->maphieu;
    if ($type == 'delete') {
        $sql = "DELETE FROM `phieu_ung_luong` WHERE MaPhieu = '$maphieu'";
        $results = mysqli_query($conn, $sql);
        http_response_code(200);
        echo json_encode(
            array(
                "message" => "delete successful",
                "status" => true,
            ));
    } else {
        $sql = "UPDATE `phieu_ung_luong` SET `Duyet`= 1 WHERE MaPhieu = '$maphieu'";
        $results = mysqli_query($conn, $sql);
        http_response_code(200);
        echo json_encode(
            array(
                "message" => "accept successful",
                "status" => true,
            ));
    }
