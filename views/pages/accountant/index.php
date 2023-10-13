<?php
require_once '../../template.php';
$page = $_GET['page'];

$template = new Template('');
echo $template->render('navbar', []);

switch ($page) {
    case 'accountant-payroll':
        echo $template->render('header', ['css' => '/accountant/payroll/payroll.css', 'js' => '/accountant/payroll/payroll.js']);
        echo $template->render('pages/accountant/payroll/payroll', []);
        break;
    case 'accountant-satistic':
        echo $template->render('header', ['css' => '/accountant/satistic/satistic.css', 'js' => '/accountant/satistic/satistic.js']);
        echo $template->render('pages/accountant/satistic/satistic', []);
        break;
    
    default:
        echo $template->render('header', ['css' => '/accountant/list_employee_info/list_employee_info.css', 'js' => 'list_employee_info.js']);
        echo $template->render('pages/accountant/list_employee_info/list-employee', []);
        break;
}

