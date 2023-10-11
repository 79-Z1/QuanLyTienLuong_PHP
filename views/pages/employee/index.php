<?php
require_once '../../template.php';
$page = $_GET['page'];

$template = new Template('');
echo $template->render('header', ['css' => 'main_nhanvien.css', 'js' => 'main_nhanvien.js']);

switch ($page) {
    
    default:
        echo $template->render('pages/employee/main/main', []);
        break;
}