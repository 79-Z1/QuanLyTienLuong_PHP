<?php
require_once '../../template.php';
$page = $_GET['page'] ?? '';
$template = new Template('');
echo $template->render('navbar_exercise', []);
echo $template->render('footer', []);

switch ($page) {
    case 'TranNgocTien':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/TranNgocTien', []);
        break;
    case 'LeHoangThien':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/LeHoangThien', []);
        break;
    case 'PhamNgocTuyen':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/PhamNgocTuyen/PhamNgocTuyen', []);
        break;
    case 'NguyenDuyThien':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/NguyenDuyThien', []);
        break;
    case 'TruongKhanhHoa':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/TruongKhanhHoa', []);
        break;
    default:
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/exercise', []);
        break;
}