<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];

    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($imageName);

    if (move_uploaded_file($imageTmp, $targetFile)) {
        $conn->query("INSERT INTO posts (title, description, image) VALUES ('$title', '$description', '$imageName')");
        header("Location: index.php");
    } else {
        echo "Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Post</title>
</head>
<body>
    <h1>Add New Post</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label for="description">Description:</label><br>
        <textarea name="description" rows="5" required></textarea><br><br>

        <label for="image">Image:</label><br>
        <input type="file" name="image" required><br><br>

        <button type="submit">Save</button>
    </form>
</body>
</html>
