<?php
include 'ketnoi.php';
$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $release_date = $_POST['release_date'];
    $poster = $_POST['poster'];
    $sql = "UPDATE movies SET title='$title', description='$description', duration='$duration', 
            release_date='$release_date', poster='$poster' WHERE id=$id";
    $conn->query($sql);
    header("Location: movies.php");
}
$result = $conn->query("SELECT * FROM movies WHERE id=$id");
$row = $result->fetch_assoc();
?>
<h2>Sửa phim</h2>
<form method="post">
    Tiêu đề: <input type="text" name="title" value="<?= $row['title'] ?>"><br>
    Mô tả: <textarea name="description"><?= $row['description'] ?></textarea><br>
    Thời lượng: <input type="number" name="duration" value="<?= $row['duration'] ?>"><br>
    Ngày phát hành: <input type="date" name="release_date" value="<?= $row['release_date'] ?>"><br>
    Poster: <input type="text" name="poster" value="<?= $row['poster'] ?>"><br>
    <button type="submit">Cập nhật</button>
</form>
