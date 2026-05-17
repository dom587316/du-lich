# 🌍 Cẩm Nang Du Lịch (Du Lịch Việt)

**Cẩm Nang Du Lịch** là một ứng dụng web toàn diện được xây dựng bằng Laravel 12, đóng vai trò như một cẩm nang trực tuyến chia sẻ kinh nghiệm, điểm đến, ẩm thực và các địa điểm check-in hấp dẫn tại Việt Nam.

Dự án cung cấp giao diện người dùng thân thiện, hiện đại (áp dụng phong cách thiết kế Glassmorphism) cùng hệ thống quản trị (Admin Panel) mạnh mẽ giúp quản lý nội dung dễ dàng.

---

## 🚀 Các tính năng nổi bật

### 👤 Dành cho Người dùng (User)
* **Khám phá bài viết**: Tìm kiếm và đọc các bài viết theo chuyên mục (**Ẩm thực**, **Điểm đến**, **Checkin**).
* **Tìm kiếm & Lọc**: Công cụ tìm kiếm bài viết theo từ khóa, chuyên mục và địa điểm.
* **Tương tác**: 
  * Đăng nhập / Đăng ký tài khoản cá nhân.
  * Thêm bài viết vào danh sách **Yêu thích**.
  * **Bình luận** chia sẻ cảm nghĩ (Bình luận sẽ được Admin duyệt trước khi hiển thị).
  * **Đánh giá** (Rating) bài viết.
* **Quản lý Hồ sơ**: Cập nhật thông tin cá nhân và ảnh đại diện.

### 👑 Dành cho Quản trị viên (Admin)
* **Bảng điều khiển (Dashboard)**: Thống kê tổng quan với các biểu đồ trực quan (Bài viết theo tháng, Lượt xem theo danh mục).
* **Quản lý Bài viết**: Thêm, sửa, xóa, duyệt và quản lý trạng thái bài viết (Đã đăng / Nháp).
* **Quản lý Danh mục**: Tạo và chỉnh sửa các danh mục du lịch.
* **Quản lý Bình luận**: Hệ thống kiểm duyệt bình luận (Duyệt, Ẩn, Xóa).
* **Quản lý Người dùng**: Xem danh sách thành viên, cấp quyền Admin hoặc xóa tài khoản.

---

## 🛠 Công nghệ sử dụng
* **Backend:** PHP 8.x, [Laravel 12](https://laravel.com/)
* **Database:** MySQL
* **Frontend:** Blade Templates, HTML5, Vanilla CSS, Bootstrap 5
* **Biểu đồ & Thống kê:** Chart.js
* **Icons:** FontAwesome 6

---

## ⚙️ Hướng dẫn cài đặt

Để chạy dự án này trên môi trường local của bạn, vui lòng làm theo các bước sau:

**1. Clone dự án về máy**
```bash
git clone https://github.com/dom587316/du-lich.git
cd du-lich
```

**2. Cài đặt các thư viện (Dependencies)**
```bash
composer install
```

**3. Cấu hình biến môi trường**
Sao chép file cấu hình mẫu và điền thông tin database của bạn:
```bash
cp .env.example .env
```
Mở file `.env` và cập nhật thông tin kết nối MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=du_lich_db
DB_USERNAME=root
DB_PASSWORD=
```

**4. Tạo APP_KEY**
```bash
php artisan key:generate
```

**5. Chạy Migration và Seeder (Tạo dữ liệu mẫu)**
```bash
php artisan migrate:fresh --seed
```
*Lưu ý: Lệnh này sẽ tạo sẵn một số danh mục, bài viết mẫu và tài khoản quản trị.*

**6. Liên kết thư mục Storage (để hiển thị hình ảnh)**
```bash
php artisan storage:link
```

**7. Chạy Server cục bộ**
```bash
php artisan serve
```
Truy cập trang web tại: `http://localhost:8000`

---

## 🔐 Tài khoản mặc định (Seeder)

Sau khi chạy lệnh `seed`, bạn có thể sử dụng các tài khoản sau để đăng nhập:

* **Tài khoản Admin:**
  * Email: `admin@dulich.com`
  * Mật khẩu: `password`

* **Tài khoản User (Người dùng bình thường):**
  * Email: `user1@dulich.com` (có thể dùng từ user1 đến user5)
  * Mật khẩu: `password`

---

## 📸 Giao diện tham khảo

* Giao diện trang chủ được thiết kế theo phong cách Glassmorphism sáng sủa, đẹp mắt.
* Trang quản trị (Admin Panel) sử dụng thiết kế Light-mode thân thiện, trực quan với Sidebar điều hướng và các biểu đồ thống kê sinh động.

---
*Dự án được xây dựng và phát triển nhằm mục đích cung cấp thông tin du lịch hữu ích và nền tảng giao lưu cho cộng đồng yêu thích khám phá Việt Nam.*
