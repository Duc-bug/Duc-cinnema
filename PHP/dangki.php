<?php


include 'ketnoi.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];

$sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

if ($conn->query($sql) === TRUE) {
    // Đăng ký thành công, chuyển hướng về trang đăng nhập
    header("Location:../dangnhap.html");
    exit();
} else {
    // Lỗi khi thêm dữ liệu
    echo "<script>alert('Lỗi: " . $conn->error . "'); window.location.href='../dangky.html';</script>";
}

$conn->close();
?>