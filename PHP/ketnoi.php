<?php
$servername = "localhost"; // Hoặc địa chỉ máy chủ
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "ve xem phim"; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
