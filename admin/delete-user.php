<?php
include "config.php";
if($_SESSION["user_role"] == '0') {
    header("Location: {$hostname}/admin/post.php");
}
$userId = $_GET['id'];
$sql = "DELETE FROM user WHERE user_id={$userId}";
if(mysqli_query($conn, $sql)) {
    header("Location: {$hostname}/admin/users.php");
} else {
    echo "<p style='color:red'; text-align:center; margin: 10px 0;>Can\'t delete the user record.</p>";
}

mysqli_close($conn);

?>