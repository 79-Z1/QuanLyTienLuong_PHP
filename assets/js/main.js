const MANV = getCookie('MaNV');
const LOAITK = getCookie('LoaiTK');


if (!MANV || !LOAITK) {
    location.href = "http://localhost/QuanLyTienLuong_PHP/"
}

if (LOAITK == 'KT') {
    if (window.location.href.indexOf("views/pages/accountant") <= -1) {
        location.href = "http://localhost/QuanLyTienLuong_PHP/views/pages/accountant"
    }
} else if (LOAITK == 'QL') {
    if (window.location.href.indexOf("views/pages/human_manager") <= -1) {
        location.href = "http://localhost/QuanLyTienLuong_PHP/views/pages/human_manager"
    }
} else if (LOAITK == 'AD') {
    if (window.location.href.indexOf("views/pages/admin") <= -1) {
        location.href = "http://localhost/QuanLyTienLuong_PHP/views/pages/admin"
    }
} else if (LOAITK == 'NV') {
    if (window.location.href.indexOf("views/pages/employee") <= -1) {
        location.href = "http://localhost/QuanLyTienLuong_PHP/views/pages/employee"
    }
}

//# HELPER FUNCTION
async function postData(url = "", data = {}) {
    const response = await fetch(url, {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    });
    return response.json();
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

function clearAllCookie() {
    var all_cookies = document.cookie.split(";");

    for (var i = 0; i < all_cookies.length; i++) {
        var single_cookie = all_cookies[i];
        var cookie_index = single_cookie.indexOf("=");
        var cookie_name = cookie_index > -1 ? all_cookies.substr(0, cookie_index) : single_cookie;
        document.cookie = cookie_name + "=;expires=" + new Date().toUTCString();
    }
}