<?php

session_start();

// Kết nối cơ sở dữ liệu
include 'ketnoi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Đăng nhập thành công
        $_SESSION['username'] = $username;
        header("Location: ../index.html");
        // Chuyển hướng đến trang chính
        exit();
    } else {
        // Sai tên đăng nhập hoặc mật khẩu
        echo "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}

$conn->close();
?>
