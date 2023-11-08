$(document).ready(async function () {
    const thongBaoContainer = $('#thongbao-container');
    const url = "http://localhost/QuanLyTienLuong_PHP/api/api-getall-notification.php";
    const data = {
        NguoiNhan: MANV,
        LoaiTKNguoiNhan: LOAITK,
        Type: 'all'
    }
    const { message, status, notiList } = await postData(url, data);
    if (status) {
        if (notiList.length > 0) {
            if (window.location.href.indexOf("views/pages/employee") > -1) {
                for (let noti of notiList) {
                    thongBaoContainer.append(renderNoti(noti))
                }
            } else {
                const urlUpdate = "http://localhost/QuanLyTienLuong_PHP/api/api-update-to-readed-notification.php";
                for (let noti of notiList) {
                    const dataUpdate = {
                        MaTB: noti['MaTB']
                    }
                    await postData(urlUpdate, dataUpdate);
                    thongBaoContainer.append(renderNoti(noti))
                }
            }
        } else {
            $('#dismiss-all').prop('disabled', true);
        }
    }

    $('#tab-5').on('click', async () => {
        const urlCount = "http://localhost/QuanLyTienLuong_PHP/api/api-countnew-notification.php";
        const dataCount = {
            NguoiNhan: MANV,
            LoaiTKNguoiNhan: LOAITK
        }
        const resultCount = await postData(urlCount, dataCount);
        if (resultCount.status && resultCount.newNotiNumber > 0) {
            const thongBaoContainer = $('#thongbao-container');
            const url = "http://localhost/QuanLyTienLuong_PHP/api/api-getall-notification.php";
            const data = {
                NguoiNhan: MANV,
                LoaiTKNguoiNhan: LOAITK,
                Type: 'all'
            }
            const { message, status, notiList } = await postData(url, data);
            if (notiList.length > 0) {
                const urlUpdate = "http://localhost/QuanLyTienLuong_PHP/api/api-update-to-readed-notification.php";
                let html = '';
                for (let noti of notiList) {
                    if (noti['TinhTrang'] == '0') {
                        const dataUpdate = {
                            MaTB: noti['MaTB']
                        }
                        await postData(urlUpdate, dataUpdate);
                    }
                    html += renderNoti(noti);
                }
                thongBaoContainer.html(html);
            } else {
                $('#dismiss-all').prop('disabled', true);
            }
        }
    });

    //# Xóa Noti
    $('.dismiss-notification').on('click', async function () {
        const matb = $(this).data('matb');
        const urlDelete = "http://localhost/QuanLyTienLuong_PHP/api/api-delele-notification.php";
        const dataDelete = {
            MaTB: matb
        }
        const { status } = await postData(urlDelete, dataDelete);
        if (status) {
            $(this).closest('.notification-card').remove();
            toastr.success('Xóa thành công');
        }
    })

    $('#dismiss-all').on('click', async function () {
        const urlDelete = "http://localhost/QuanLyTienLuong_PHP/api/api-delele-notification.php";
        const dataDelete = {}
        const { status } = await postData(urlDelete, dataDelete);
        if (status) {
            $('#thongbao-container').html('');
            toastr.success('Xóa tất cả thành công');
        }
    })
})

function checkNoiDung(noidung) {
    if (noidung.indexOf("ứng") > -1) {
        localStorage.setItem('active-item', '2');
        localStorage.setItem('pre-active-item', '6');
        window.location.href = "http://localhost/QuanLyTienLuong_PHP/views/pages/accountant/?page=accountant-check-salary-advance";
    }
}

function renderNoti(noti) {
    return `
    <div class="notification-card notification-invitation">
        <div class="card-body d-flex justify-content-between align-items-center">
            <a onclick="checkNoiDung('${noti['NoiDung']}')" class="w-100 noti-link">
                <div class="${noti['TinhTrang'] == '0' ? '' : 'readed'}">
                    <div class="card-title">${noti['NoiDung']}</div>
                </div>
            </a>
            <div >
                <span href="#" data-matb='${noti['MaTB']}' class="text-danger dismiss-notification">&times;</span>
            </div>
        </div>
    </div>
    `
}