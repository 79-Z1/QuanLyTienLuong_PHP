<?php
require_once '../../template.php';
$page = $_GET['page'] ?? '';
$template = new Template('');
echo $template->render('navbar_exercise', []);
echo $template->render('footer', []);

switch ($page) {
    case 'exercise-TranNgocTien':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien', []);
        break;
    case 'exercise-LeHoangThien':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien', []);
        break;
    case 'exercise-PhamNgocTuyen':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/PhamNgocTuyen', []);
        break;
    case 'exercise-NguyenDuyThien':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien', []);
        break;
    case 'exercise-TruongKhanhHoa':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa', []);
        break;
    default:
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/exercise', []);
        break;
}