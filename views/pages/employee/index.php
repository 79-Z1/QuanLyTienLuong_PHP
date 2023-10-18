<?php
require_once '../../template.php';
$page = $_GET['page'] ?? '';
$template = new Template('');

switch ($page) {
    case 'employee-check-payroll':
        echo $template->render('header_employee', ['css' => 'check_payroll.css', 'js' => 'check_payroll.js']);
        echo $template->render('pages/employee/check_payroll/check_payroll', []);
        break;
    case 'employee-check-timesheets':
        echo $template->render('header_employee', ['css' => 'check_timesheets.css', 'js' => 'check_timesheets.js']);
        echo $template->render('pages/employee/check_payroll/check_timesheets', []);
        break;
    case 'employee-salary_advance':
        echo $template->render('header_employee', ['css' => 'salary_advance.css', 'js' => 'salary_advance.js']);
        echo $template->render('pages/employee/check_payroll/salary_advance', []);
        break;
    default:
        echo $template->render('header_employee', []);
        echo $template->render('pages/employee/main/main', ['MaNV' => $_SESSION["MaNV"], 'LoaiTK' => $_SESSION["LoaiTK"]]);
        break;
}