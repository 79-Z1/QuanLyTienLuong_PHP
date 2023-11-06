$(document).ready(async function () {
    const currActiveIndex = sessionStorage.getItem('active-item');
    const preActiveIndex = sessionStorage.getItem('pre-active-item');
    if (currActiveIndex) {
        const currActiveEl = $(".navbar-nav").find(`[data-active='${currActiveIndex}']`);
        const preActiveEl = $(".navbar-nav").find(`[data-active='${preActiveIndex}']`);
        preActiveEl.removeClass('active');
        currActiveEl.addClass('active');
    } else {
        sessionStorage.setItem('active-item', '1');
        sessionStorage.setItem('pre-active-item', '0');
        const currActiveEl = $(".navbar-nav").find(`[data-active='1']`);
        currActiveEl.addClass('active');
    }

    $('.nav-link').on('click', (el) => {
        const li = $(el.target).closest('li');
        const preActiveIndex = sessionStorage.getItem('active-item');
        const currActiveIndex = $(li).data("active");
        sessionStorage.setItem('active-item', currActiveIndex);
        sessionStorage.setItem('pre-active-item', preActiveIndex);
    });

    if (currActiveIndex == '6') {
        $('#num-noti').text('');
    } else {
        const url = "http://localhost/QuanLyTienLuong_PHP/api/api-countnew-notification.php";
        const data = {
            NguoiNhan: MANV,
            LoaiTKNguoiNhan: LOAITK
        }
        const { message, status, newNotiNumber } = await postData(url, data);
        if (status && newNotiNumber > 0) {
            $('#num-noti').css({ 'background-color': 'red' })
            $('#num-noti').text(`${newNotiNumber}`);
        } else {
            $('#num-noti').text('');
        }
    }

    $(".navbar-nav").find(`[data-active='7']`).on('click', () => {
        sessionStorage.clear();
        localStorage.clear();
        clearAllCookie();
        location.href = 'http://localhost/QuanLyTienLuong_PHP'
    })
})
