<?php
require_once '../../template.php';

$template = new Template('');
echo $template->render('pages\employee\main\main', []);
