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
    case 'accountant-statistic':
        echo $template->render('header', ['css' => '/accountant/statistic/statistic.css', 'js' => '/accountant/statistic/statistic.js']);
        echo $template->render('pages/accountant/statistic/statistic', []);
        break;
    case 'accountant-check-salary-advance':
        echo $template->render('header', ['css' => '/accountant/check_salary_advance/check_salary_advance.css', 'js' => '/accountant/satistic/satistic.js']);
        echo $template->render('pages/accountant/check_salary_advance/check_salary_advance', []);
        break;
    default:
        echo $template->render('header', ['css' => '/accountant/list_employee_info/list_employee_info.css', 'js' => 'list_employee_info.js']);
        echo $template->render('pages/accountant/list_employee_info/list-employee', []);
        break;
}

