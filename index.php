<?php 
function redirect($url) {
    header('Location: '.$url);
    die();
}
?>

<?php
require_once __DIR__.'\views\template.php';

$url = $_SERVER['REQUEST_URI'];
$page = $_GET['page'];


// set thư mục views là ~/views
$template = new Template('');
echo $template->render('navbar', []);

switch ($page) {
    case 'payroll-accountant':
        echo $template->render('pages\accountant\payroll\test2', []);
        break;
    
    default:
        echo $template->render('pages\profile', ['name' => 'Jocelyn']);
        break;
}
