<?php
require_once __DIR__.'/views/template.php';



// set thư mục views là ~/views
$template = new Template('');
echo $template->render('pages/auth/login', []);