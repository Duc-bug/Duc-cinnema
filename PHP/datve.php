<?php
include 'ketnoi.php';
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    echo "Vui lòng đăng nhập để đặt vé.";
    exit();
}

$user_id = $_SESSION['user_id'];
$showtime_id = $_POST['showtime_id'];
$seat_number = $_POST['seat_number'];

// Kiểm tra xem ghế đã được đặt hay chưa
$sql_check = "SELECT * FROM tickets WHERE showtime_id = ? AND seat_number = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("is", $showtime_id, $seat_number);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo "Ghế số $seat_number đã được đặt. Vui lòng chọn ghế khác.";
    exit();
}

// Thêm vé mới vào cơ sở dữ liệu
$sql_insert = "INSERT INTO tickets (user_id, showtime_id, seat_number) VALUES (?, ?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("iis", $user_id, $showtime_id, $seat_number);

if ($stmt_insert->execute()) {
    echo "Đặt vé thành công!";
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
?>
