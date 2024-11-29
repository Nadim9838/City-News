<?php
include "config.php";

if(empty($_FILES['logo']['name'])) {
    $file_name = $_POST['old_logo'];
} else {
    $errors = [];
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_tmp = $_FILES['logo']['tmp_name'];
    $file_type = $_FILES['logo']['type'];
    $fileExtention = end(explode('.', $file_name));
    $file_ext = strtolower($fileExtention);
    $extensions = ["jpg", "jpeg", "png"];

    if(in_array($file_ext, $extensions) === false) {
        $error[] = "This extention file is not allowed, Please choose a JPG or PNG image";
    }

    if($file_size > 2097152) {
        $error[] = "File size must be 2MB or lower";
    }

    if(empty($error) == true) {
        move_uploaded_file($file_tmp, "images/".$file_name);
    } else {
        print_r($error);
        die();
    }
}
$website_name = mysqli_real_escape_string($conn, $_POST['website_name']);
$footer = mysqli_real_escape_string($conn, $_POST['footer']);
$sql = "UPDATE setting SET website_name = '{$website_name}', footer = '{$footer}', logo = '{$file_name}'";

$result = mysqli_query($conn, $sql) or die('Query Failed');

if($result) {
    header("location: {$hostname}/admin/setting.php");
} else {
    echo "Query Failed";
}