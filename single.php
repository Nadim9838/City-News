<!-- Include header file -->
<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <?php
                            // include config file 
                            include "admin/config.php";

                            // Get id
                            if(isset($_GET['id'])) {
                                $id = mysqli_real_escape_string($conn, $_GET['id']);
                            }

                            // Query to get data
                            $sql = "SELECT post.post_id, post.title, post.description, post.author as a_id, post.category as cat_id, post.post_date, post.post_img, category.category_name, user.first_name, user.last_name FROM post
                            LEFT JOIN category ON post.category = category.category_id
                            LEFT JOIN user ON post.author = user.user_id WHERE post.post_id={$id};";

                            $result = mysqli_query($conn, $sql) or die("Query Failed");

                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="post-content single-post">
                            <h3><?=$row['title']?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?id=<?=$row['cat_id']?>'><?=$row['category_name']?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?id=<?=$row['a_id']?>'><?=$row['first_name']." ".$row['last_name']?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?=$row['post_date']?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?=$row['post_img']?>" alt=""/>
                            <p class="description">
                                <?=$row['description']?>
                            </p>
                        </div>
                        <?php 
                        }
                            } else {
                                echo "<h2>No Record Found</h2>";
                            }
                        ?>
                    </div>
                </div>
                <!-- Inlcude sidebar section-->
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<!-- Include footer section -->
 <?php include 'footer.php'; ?>
