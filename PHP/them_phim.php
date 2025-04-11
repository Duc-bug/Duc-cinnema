<?php
include 'ketnoi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $release_date = $_POST['release_date'];
    $poster = $_POST['poster'];
    $sql = "INSERT INTO movies (title, description, duration, release_date, poster) 
            VALUES ('$title', '$description', '$duration', '$release_date', '$poster')";
    $conn->query($sql);
    header("Location: movies.php");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm phim mới</title>
   
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-group textarea {
            resize: none;
            height: 100px;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Thêm phim mới</h2>
        <form method="post">
            <div class="form-group">
                <label for="title">Tiêu đề:</label>
                <input type="text" id="title" name="title" placeholder="Nhập tiêu đề phim" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea id="description" name="description" placeholder="Nhập mô tả phim" required></textarea>
            </div>
            <div class="form-group">
                <label for="duration">Thời lượng (phút):</label>
                <input type="number" id="duration" name="duration" placeholder="Nhập thời lượng phim" required>
            </div>
            <div class="form-group">
                <label for="release_date">Ngày phát hành:</label>
                <input type="date" id="release_date" name="release_date" required>
            </div>
            <div class="form-group">
                <label for="poster">Poster (link hoặc tên file):</label>
                <input type="text" id="poster" name="poster" placeholder="Nhập link hoặc tên file poster" required>
            </div>
            <button type="submit" class="submit-btn">Lưu</button>
        </form>
    </div>
</body>
</html>
