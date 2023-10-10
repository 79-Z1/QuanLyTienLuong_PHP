<?php
require_once '../../template.php';
$page = $_GET['page'];

$template = new Template('');
echo $template->render('navbar', []);

switch ($page) {
    case 'payroll-accountant':
        echo $template->render('pages\accountant\payroll\payroll', []);
        break;
    case 'satistic-accountant':
        echo $template->render('pages\accountant\satistic\satistic', []);
        break;
    
    default:
        echo $template->render('pages\accountant\list_employee_info\list-employee', []);
        break;
}

