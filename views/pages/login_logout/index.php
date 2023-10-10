<?php
require_once '../../template.php';
$page = $_GET['page'];

$template = new Template('');
echo $template->render('header', ['css' => 'satistic.css', 'js' => 'satistic.js']);
echo $template->render('navbar', []);

switch ($page) {
    case 'payroll-accountant':
        echo $template->render('pages/accountant/payroll/payroll', []);
        break;
    
    default:
        echo $template->render('pages/login_logout/login/test', []);
        break;
}