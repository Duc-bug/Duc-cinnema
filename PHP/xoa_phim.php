<?php
include 'ketnoi.php';
$id = $_GET['id'];
$conn->query("DELETE FROM movies WHERE id=$id");
header("Location: movies.php");
?>
