<?php
include 'ketnoi.php';
$result = $conn->query("SELECT * FROM movies");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách phim</title>
    <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f7f7f7;
      padding: 30px;
    }

    h1 {
      color: #333;
    }

    a.them-phim {
      text-decoration: none;
      color: #6c5ce7;
      font-weight: bold;
      margin-bottom: 10px;
      display: inline-block;
    }

    a.them-phim:hover {
      text-decoration: underline;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      background: white;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 12px 16px;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }

    th {
      background-color: #f0f0f0;
      font-weight: bold;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    .btn {
      padding: 6px 10px;
      border: none;
      border-radius: 4px;
      font-size: 14px;
      cursor: pointer;
      text-decoration: none;
    }

    .btn-sua {
      background-color: #00b894;
      color: white;
    }

    .btn-xoa {
      background-color: #d63031;
      color: white;
    }

    .btn-sua:hover {
      background-color: #019874;
    }

    .btn-xoa:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>
<h2>Danh sách phim</h2>
<a href="them_phim.php">➕ Thêm phim mới</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th><th>Tiêu đề</th><th>Thời lượng</th><th>Ngày phát hành</th><th>Hành động</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['title'] ?></td>
        <td><?= $row['duration'] ?> phút</td>
        <td><?= $row['release_date'] ?></td>
        <td>
            <a href="sua_phim.php?id=<?= $row['id'] ?>">✏️ Sửa</a> | 
            <a href="xoa_phim.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">🗑️ Xóa</a>
        </td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
