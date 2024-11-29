<?php
include "config.php";
$tital = mysqli_real_escape_string($conn, $_POST['post_title']);
$description = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d, M, Y");
session_start(); //session start first
$author = $_SESSION['user_id'];

if($_FILES['fileToUpload']) {
    $errors = [];
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $fileExtention = end(explode('.', $file_name));
    $file_ext = strtolower($fileExtention);
    $extensions = ["jpg", "jpeg", "png", "webp"];

    if(in_array($file_ext, $extensions) === false) {
        $error[] = "This extention file is not allowed, Please choose a JPG or PNG image";
    }

    if($file_size > 2097152) {
        $error[] = "File size must be 2MB or lower";
    }

    $target = "upload/".time()."-".basename($file_name);
    if(empty($error) == true) {
        move_uploaded_file($file_tmp, "upload/".$target);
    } else {
        print_r($error);
        die();
    }
}

$sql = "INSERT INTO post (title, description, category, post_date, author, post_img) VALUES('{$tital}', '{$description}', {$category}, '{$date}', '{$author}', '{$file_name}');";

$sql.="UPDATE category SET post = post + 1 WHERE category_id = {$category}";

// To execute multiple query together
if(mysqli_multi_query($conn, $sql)) {
    header("location: {$hostname}/admin/post.php");
} else {
    echo "<div class='alert alert-danger'>Query Failed</div>";
}
