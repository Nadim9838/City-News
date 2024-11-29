<?php
include "config.php";
$id = $_GET['id'];
$catId = $_GET['cat_id'];

// To delete image from image folder when delete record
$sql1 = "SELECT * FROM post WHERE post_id={$id}";
$result = mysqli_query($conn, $sql1) or die("Select Query Failed");
$row = mysqli_fetch_assoc($result);
if(empty($row['post_img']) == false) {
    unlink("upload/".$row['post_img']);
}

// Delete post record
$sql = "DELETE FROM post WHERE post_id = {$id};";
$sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$catId};";

if(mysqli_multi_query($conn, $sql)) {
    header("location: {$hostname}/admin/post.php");
} else {
    echo "Query failed";
}
