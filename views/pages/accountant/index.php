<?php
require_once '../../template.php';
$page = $_GET['page'] ?? '';

$template = new Template('');
echo $template->render('navbar_accountant', []);

switch ($page) {
    case 'accountant-payroll':
        echo $template->render('header_accountant', ['css' => 'payroll.css', 'js' => 'payroll.js']);
        echo $template->render('pages/accountant/payroll/payroll', []);
        break;
    case 'accountant-statistic':
        echo $template->render('header_accountant', ['css' => 'statistic.css', 'js' => 'statistic.js']);
        echo $template->render('pages/accountant/statistic/statistic', []);
        break;
    case 'accountant-check-salary-advance':
        echo $template->render('header_accountant', ['css' => 'check_salary_advance.css', 'js' => 'check_salary_advance.js']);
        echo $template->render('pages/accountant/check_salary_advance/check_salary_advance', []);
        break;
    default:
        echo $template->render('header_accountant', ['css' => 'list_employee_info.css', 'js' => 'list_employee_info.js']);
        echo $template->render('pages/accountant/list_employee_info/list-employee', []);
        break;
}

