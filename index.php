<?php 
function redirect($url) {
    header('Location: '.$url);
    die();
}
?>

<?php
require_once __DIR__.'\views\template.php';

$url = $_SERVER['REQUEST_URI'];

// set thư mục views là ~/views
$template = new Template('');
echo $template->render('navbar', []);
echo $template->render('pages\profile', ['name' => 'Jocelyn']);
echo $template->render('pages\test', ['name' => 'Jocelyn']);
