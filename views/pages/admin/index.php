<?php
require_once '../../template.php';
$page = $_GET['page'] ?? '';

$template = new Template('');
echo $template->render('navbar_admin', []);

switch ($page) {
    case 'admin-timekeeping':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/timekeeping/timekeeping', []);
        break;
    case 'admin-timekeeping-add':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/timekeeping/add_timekeeping', []);
        break;
    case 'admin-timekeeping-edit':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/timekeeping/edit_timekeeping', []);
        break;
    case 'admin-timekeeping-delete':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/timekeeping/delete_timekeeping', []);
        break;

    case 'admin-account':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/account/account', []);
        break;
    case 'admin-account-add':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/account/add-account', []);
        break;
    case 'admin-account-edit':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/account/edit-account', []);
        break;
    case 'admin-account-delete':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/account/delete-account', []);
        break;

    case 'admin-department':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/department/department', []);
        break;
    case 'admin-department-add':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/department/add_department', []);
        break;
    case 'admin-department-edit':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/department/edit_department', []);
        break;
    case 'admin-department-delete':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/department/delete_department', []);
        break;

    case 'admin-overtime':
        echo $template->render('header_admin', ['css' => 'overtime/overtime.css']);
        echo $template->render('pages/admin/overtime/overtime', []);
        break;
    case 'admin-overtime-add-overtime':
        echo $template->render('header_admin', ['css' => 'overtime/add-overtime.css']);
        echo $template->render('pages/admin/overtime/add-overtime', []);
        break;
    case 'admin-overtime-edit-overtime':
        echo $template->render('header_admin', ['css' => 'overtime/edit-overtime.css']);
        echo $template->render('pages/admin/overtime/edit-overtime', []);
        break;
    case 'admin-overtime-delete-overtime':
        echo $template->render('header_admin', ['css' => 'overtime/delete-overtime.css']);
        echo $template->render('pages/admin/overtime/delete-overtime', []);
        break;

    case 'admin-salary-slip':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/salary-slip/salary-slip', []);
        break;
    case 'admin-salary-slip-add':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/salary-slip/add_salary-slip', []);
        break;
    case 'admin-salary-slip-edit':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/salary-slip/edit_salary-slip', []);
        break;
    case 'admin-salary-slip_delete':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/salary-slip/delete_salary-slip', []);
        break;

    case 'admin-position':
        echo $template->render('header_admin', ['css' => 'position/position.css']);
        echo $template->render('pages/admin/position/position', []);
        break;
    case 'admin-position-add-position':
        echo $template->render('header_admin', ['css' => 'position/add-position.css']);
        echo $template->render('pages/admin/position/add-position', []);
        break;
    case 'admin-position-edit-position':
        echo $template->render('header_admin', ['css' => 'position/edit-position.css']);
        echo $template->render('pages/admin/position/edit-position', []);
        break;
    case 'admin-position-delete-position':
        echo $template->render('header_admin', ['css' => 'position/delete-position.css']);
        echo $template->render('pages/admin/position/delete-position', []);
        break;

    case 'admin-staff':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/staff/staff', []);
        break;
    case 'add-staff':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/staff/add_staff', []);
        break;
    case 'edit-staff':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/staff/edit_staff', []);
        break;
    case 'detail-staff':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/staff/detail_staff', []);
        break;
    case 'delete-staff':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/staff/delete_staff', []);
        break;
    case 'admin-paycheck-add-paycheck':
        echo $template->render('header_admin', ['css' => 'paycheck/add-paycheck.css']);
        echo $template->render('pages/admin/paycheck/add-paycheck', []);
        break;
    case 'admin-paycheck-edit-paycheck':
        echo $template->render('header_admin', ['css' => 'paycheck/edit-paycheck.css']);
        echo $template->render('pages/admin/paycheck/edit-paycheck', []);
        break;
    case 'admin-paycheck-delete-paycheck':
        echo $template->render('header_admin', ['css' => 'paycheck/delete-paycheck.css']);
        echo $template->render('pages/admin/paycheck/delete-paycheck', []);
        break;
    case 'admin-paycheck-info-paycheck':
        echo $template->render('header_admin', ['css' => 'paycheck/info-paycheck.css']);
        echo $template->render('pages/admin/paycheck/info-paycheck', []);
        break;
    case 'admin-parameter':
        echo $template->render('header_admin', ['css' => 'parameter/parameter.css']);
        echo $template->render('pages/admin/parameter/parameter', []);
        break;
    case 'add-parameter':
        echo $template->render('header_admin', ['css' => 'parameter/add-parameter.css']);
        echo $template->render('pages/admin/parameter/add-parameter', []);
        break;
    case 'edit-parameter':
        echo $template->render('header_admin', ['css' => 'parameter/edit-parameter.css']);
        echo $template->render('pages/admin/parameter/edit-parameter', []);
        break;
    case 'delete-parameter':
        echo $template->render('header_admin', ['css' => 'parameter/delete-parameter.css']);
        echo $template->render('pages/admin/parameter/delete-parameter', []);
        break;
    default:
        echo $template->render('header_admin', ['css' => 'paycheck/paycheck.css']);
        echo $template->render('pages/admin/paycheck/paycheck', []);
        break;
}
