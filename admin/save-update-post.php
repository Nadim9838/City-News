<?php
include "config.php";

if(empty($_FILES['new-image']['name'])) {
    $file_name = $_POST['old_image'];
} else {
    $errors = [];
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $fileExtention = end(explode('.', $file_name));
    $file_ext = strtolower($fileExtention);
    $extensions = ["jpg", "jpeg", "png"];

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

$sql = "UPDATE post SET title = '{$_POST['post_title']}', description = '{$_POST['postdesc']}', category = {$_POST['category']}, post_img = '{$file_name}' WHERE post_id = {$_POST['post_id']};";
    if($_POST['old_category'] != $_POST['category']) {
        $sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$_POST['old_category']};";
        $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$_POST['category']};";
    }
$result = mysqli_multi_query($conn, $sql) or die('Save Update Post Query Failed');

if($result) {
    header("location: {$hostname}/admin/post.php");
} else {
    echo "Query Failed";
}