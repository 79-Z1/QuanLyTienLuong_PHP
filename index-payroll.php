<?php
require_once __DIR__.'\views\template.php';
$template = new Template('');
echo $template->render('navbar', []);
echo $template->render('pages\accountant\payroll\test2', []);
