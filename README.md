
## Trang thương mại điện tử 

## Công nghệ
- Laravel
- Jquery
- Ajax
- Boostrap
- HTML
- CSS
### Cài đặt
- CMD thường
- Yêu cầu : Xampp , composer
+ Cài đặt bằng cmd :
- composer install
- copy .env.example .env
- php artisan migrate
- php artisan db:seed
- php artisan serve
- Truy cập website :localhost:8000

### Chức năng chính
+ Trang admin (http://localhost:8000/api-admin)
Nếu chưa đăng nhập sẽ không vào được trang admin
    - Nếu không có quyền thì chỉ xem và không thể thêm sửa xóa
    - Đăng nhập (http://localhost:8000/admin-auth/login)
    - Thống kê doanh thu , trạng thái các đơn hàng
+ Trang quản lý giao dịch
    - Thông tin khác hàng
    - Giá trị ,trạng thái đơn hàng
    - Thời gian nhận đơn
    - Chi tiết đơn hàng trong view
    - Tìm kiếm đơn hàng
    - Xuất exel
+ Thêm danh mục sản phẩm ,chi tiết sản phẩm, từ khóa
+ Trang tổng hợp đánh giá của khách hàng
