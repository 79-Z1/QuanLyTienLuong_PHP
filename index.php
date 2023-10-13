<?php
require_once __DIR__.'/views/template.php';

$url = $_SERVER['REQUEST_URI'];
if(isset($_GET['page']))
$page = $_GET['page'];
else $page = '';


// set thư mục views là ~/views
$template = new Template('');
echo $template->render('header', ['css' => 'satistic.css', 'js' => 'satistic.js']); 
echo $template->render('navbar', []);
echo $template->render('pages/login_logout/login/test', []);