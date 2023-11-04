$(document).ready(async function () {
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
            const urlUpdate = "http://localhost/QuanLyTienLuong_PHP/api/api-update-to-readed-notification.php";
            let html = '';
            for (let noti of notiList) {
                if (noti['TinhTrang'] == '0') {
                    const dataUpdate = {
                        MaTB: noti['MaTB']
                    }
                    await postData(urlUpdate, dataUpdate);
                }
                html += `
                <div class="card notification-card notification-invitation">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="${noti['TinhTrang'] == '0' ? '' : 'readed'}">
                            <div class="card-title">${noti['NoiDung']}</div>
                        </div>
                        <div >
                            <a href="#" class="btn btn-danger dismiss-notification">Xóa</a>
                        </div>
                    </div>
                 </div>
                    `
            }
            thongBaoContainer.html(html);
        }
    });
    const thongBaoContainer = $('#thongbao-container');
    const url = "http://localhost/QuanLyTienLuong_PHP/api/api-getall-notification.php";
    const data = {
        NguoiNhan: MANV,
        LoaiTKNguoiNhan: LOAITK,
        Type: 'all'
    }
    const { message, status, notiList } = await postData(url, data);
    if (status) {
        if (window.location.href.indexOf("views/pages/employee") > -1) {
            for (let noti of notiList) {
                thongBaoContainer.append(`
                <div class="card notification-card notification-invitation">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="${noti['TinhTrang'] == '0' ? '' : 'readed'}">
                            <div class="card-title">${noti['NoiDung']}</div>
                        </div>
                        <div >
                            <a href="#" class="btn btn-danger dismiss-notification">Xóa</a>
                        </div>
                    </div>
                </div>
                `)
            }
        } else {
            const urlUpdate = "http://localhost/QuanLyTienLuong_PHP/api/api-update-to-readed-notification.php";
            for (let noti of notiList) {
                const dataUpdate = {
                    MaTB: noti['MaTB']
                }
                await postData(urlUpdate, dataUpdate);
                thongBaoContainer.append(`
                <div class="card notification-card notification-invitation">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="${noti['TinhTrang'] == '0' ? '' : 'readed'}">
                            <div class="card-title">${noti['NoiDung']}</div>
                        </div>
                        <div >
                            <a href="#" class="btn btn-danger dismiss-notification">Xóa</a>
                        </div>
                    </div>
                </div>
                `)
            }
        }
    }

})