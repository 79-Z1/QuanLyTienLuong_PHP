<?php
require_once('jwt.php');
if (!isset($_SESSION)) {
    session_start();
}

function validate()
{
    $jwt = (new JWT());
    if (!$_SESSION['Authorization']) header('Location: ' . "/" . explode('/', $_SERVER['PHP_SELF'])[1]);
    $result = $jwt->is_valid($_SESSION['Authorization']);
    if ($result !== 1 && $result === 0) {
        header('Location: ' . "/" . explode('/', $_SERVER['PHP_SELF'])[1]);
    } else if ($result === -1) {
        $payload = [
            'MaNV' => $_SESSION['MaNV'],
            'LoaiTK' =>  $_SESSION['LoaiTK'],
            'iss' => 'http://localhost/QuanLyTienLuong_PHP',
            'aud' => 'dakhoathientrang.com'
        ];
        $token = $jwt->generate($payload);
        $_SESSION["Authorization"] = $token;
        validate();
    }
}
