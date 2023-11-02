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
    case 'payroll-info':
        echo $template->render('header_accountant', ['css' => 'payroll-info.css', 'js' => 'payroll-info.js']);
        echo $template->render('pages/accountant/payroll/payroll-info', []);
        break;
    case 'employee-detail':
        echo $template->render('header_accountant', ['css' => 'list_employee.css', 'js' => 'list_employee.js']);
        echo $template->render('pages/accountant/list_employee_info/employee-detail', []);
        break;
    case 'accountant-check-salary-slip':
        echo $template->render('header_accountant', ['css' => 'check_salary_slip.css', 'js' => 'check_salary_slip.js']);
        echo $template->render('pages/accountant/check_salary_slip/check_salary_slip', []);
        break;
    case 'accountant-detail-salary-slip':
        echo $template->render('header_accountant', ['css' => 'check_salary_slip.css', 'js' => 'check_salary_slip.js']);
        echo $template->render('pages/accountant/check_salary_slip/detail_salary_slip', []);
        break;
    case 'accountant-edit-salary-slip':
        echo $template->render('header_accountant', ['css' => 'check_salary_slip.css', 'js' => 'check_salary_slip.js']);
        echo $template->render('pages/accountant/check_salary_slip/edit_salary_slip', []);
        break;
    default:
        echo $template->render('header_accountant', ['css' => 'list_employee.css', 'js' => 'list_employee.js']);
        echo $template->render('pages/accountant/list_employee_info/list-employee', []);
        break;
}
