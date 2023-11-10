<?php
require_once '../../../template.php';
$page = $_GET['page'] ?? '';
$template = new Template('');
echo $template->render('navbar_exercise', []);
echo $template->render('footer', []);

switch ($page) {
    case 'TKH-form':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/form/form-chuvi-dientich', []);
        break;
    default:
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/TruongKhanhHoa', []);
        break;
}