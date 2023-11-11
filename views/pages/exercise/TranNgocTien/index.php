<?php
require_once '../../../template.php';
$page = $_GET['page'] ?? '';
$template = new Template('');
echo $template->render('navbar_exercise', []);
echo $template->render('footer', []);

switch ($page) {
    default:
        echo $template->render('header_exercise', ['css' => 'TranNgocTien/TranNgocTien.css', 'js' => 'TranNgocTien.js']);
        echo $template->render('pages/exercise/TranNgocTien/TranNgocTien', []);
        break;
}