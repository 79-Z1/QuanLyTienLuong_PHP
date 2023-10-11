<?php
require_once '../../template.php';
$page = $_GET['page'];

$template = new Template('');
echo $template->render('header_employee', []);

switch ($page) {
    
    default:
        echo $template->render('pages/employee/main/main', []);
        break;
}