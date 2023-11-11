********** Các bước để chạy được bài tập nhóm **********
### Cô có thể truy cập vào: https://github.com/TonyHoe/QuanLyTienLuong_PHP và cuộn chuột xuống dưới để xem hướng dẫn có hình ảnh trực quan.
Lưu ý: Giải nén vào thư mục htdocs.
- Bước 1: Cài đặt XAMPP và PHP (version bằng hoặc lớn hơn 8.2.4) 
- Bước 2: Khởi động Apache và MySQL.
- Bước 3: Tạo database tên `quan_ly_tien_luong` type `utf8_general_ci`.
- Bước 4: Import file database.sql.
- Bước 5: Mở terminal mới từ thư mục `QuanLyTienLuong_PHP` và chạy đoạn mã sau:
    composer --ignore-platform-reqs install
- Bước 6: Tiếp tục chạy đoạn mã sau
    php -f .\server-notification.php
- truy cập vào: http://localhost/QuanLyTienLuong_PHP/