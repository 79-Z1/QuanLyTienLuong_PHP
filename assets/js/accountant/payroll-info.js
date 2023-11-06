async function thongBao(thang, nguoinhan) {
     const urlTB = "http://localhost/QuanLyTienLuong_PHP/api/api-send-notification.php";
     const nguoigui = MANV;
     const noidung = `Tiền lương tháng ${thang} của bạn đã được tính`;
     const dataTB = {
          NguoiGui: nguoigui,
          NguoiNhan: nguoinhan,
          LoaiTKNguoiNhan: 'NV',
          NoiDung: noidung
     }
     await postData(urlTB, dataTB);
}

const button = document.getElementById('luupl');
function handleChange(e){
    if(e.value != 0){
        button.setAttribute('disabled','')
        return
    }
    button.removeAttribute('disabled')
}
