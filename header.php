<?php
// Include config file
include "admin/config.php";
$page = basename($_SERVER['PHP_SELF']);
switch($page) {
    case "single.php":
        if(isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $titleQuery = "SELECT * FROM post WHERE post_id={$id}";
            $titleResult = mysqli_query($conn, $titleQuery) or die("Title Query Failed");
            $rowTitle = mysqli_fetch_assoc($titleResult);
            $pageTitle = $rowTitle['title'];
        } else {
            $pageTitle = "No Post Found";
        }
        break;
    case "category.php":
        if(isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $titleQuery = "SELECT * FROM category WHERE category_id={$id}";
            $titleResult = mysqli_query($conn, $titleQuery) or die("Title Query Failed");
            $rowTitle = mysqli_fetch_assoc($titleResult);
            $pageTitle = $rowTitle['category_name']." News";
        } else {
            $pageTitle = "No Post Found";
        }
        break;
    case "author.php":
        if(isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $titleQuery = "SELECT * FROM user WHERE user_id={$id}";
            $titleResult = mysqli_query($conn, $titleQuery) or die("Title Query Failed");
            $rowTitle = mysqli_fetch_assoc($titleResult);
            $pageTitle = "News By ".$rowTitle['first_name']." ".$rowTitle['last_name'];
        } else {
            $pageTitle = "No Post Found";
        }
        break;
    case "search.php":
        if(isset($_GET['search'])) {
            $Titlesearch = mysqli_real_escape_string($conn, $_GET['search']);
            $pageTitle = "Search ".$Titlesearch;
        } else {
            $pageTitle = "No Search Found";
        }
        break;
    default:
        $pageTitle = "City-News";
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$pageTitle?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <?php
                $sql = "SELECT * FROM setting";
                $result = mysqli_query($conn, $sql) or die("Query Failed");
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if(!isset($row['logo']) || empty($row['logo'])) {
                            echo '<a href="index.php" id="logo"><h1>'.$row['website_name'].'</h1></a>';
                        } else {
                            echo '<a href="index.php" id="logo"><img class="logo" src="admin/images/'.$row['logo'].'" height="80"></a>';
                        } 
                    }
                }?>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                    include "config.php";
                    if(isset($_GET['id'])) {
                        $catId = $_GET['id'];
                    } else {
                        $catId = 0;
                    }
                    $sql = "SELECT * FROM category WHERE post > 0";
                    $result = mysqli_query($conn, $sql) or die("Query Failed. : Category");
                    if(mysqli_num_rows($result) > 0) {
                ?>
                    <ul class='menu'>
                        <li><a href="<?=$hostname?>">Home</a></li>
                        <?php while($row = mysqli_fetch_assoc($result)) {
                            if($row['category_id'] == $catId) {
                                $active = "active";
                            } else {
                                $active = "";
                            } 
                            echo "<li><a class='{$active}' href='category.php?id={$row['category_id']}'>{$row['category_name']}</a></li>";
                        }?>
                    </ul>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
