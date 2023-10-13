<?php
require_once '../../template.php';
$page = $_GET['page'];

$template = new Template('');
echo $template->render('header_employee', []);

switch ($page) {
    case 'employee-check-payroll':
        echo $template->render('header', ['css' => '/employee/check_payroll/check_payroll.css', 'js' => '/employee/check_payroll/check_payroll.js']);
        echo $template->render('pages/employee/check_payroll/check_payroll', []);
        break;
    case 'employee-check-timesheets':
        echo $template->render('header', ['css' => '/employee/check_payroll/check_timesheets.css', 'js' => '/employee/check_payroll/check_timesheets.js']);
        echo $template->render('pages/employee/check_payroll/check_timesheets', []);
        break;
    case 'employee-salary_advance':
        echo $template->render('header', ['css' => '/employee/check_payroll/salary_advance.css', 'js' => '/employee/check_payroll/salary_advance.js']);
        echo $template->render('pages/employee/check_payroll/salary_advance', []);
        break;
    default:
    echo $template->render('header', ['css' => '/employee/check_payroll/salary_advance.css', 'js' => '/employee/check_payroll/salary_advance.js']);
        echo $template->render('pages/employee/main/main', []);
        break;
}