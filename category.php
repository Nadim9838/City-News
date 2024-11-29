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
                    $limit = 10;
                    if(isset($_GET['page'])) {
                        $page = mysqli_real_escape_string($conn, $_GET['page']);
                        } else {
                            $page = 1;
                        }
                    $offset = ($page-1)*$limit;
                    
                    // Get id
                    if(isset($_GET['id'])) {
                        $catId = mysqli_real_escape_string($conn, $_GET['id']);
                    }

                    // Query to get all data
                    $sql = "SELECT post.post_id, post.title, post.description, post.category as cat_id, post.author as a_id, post.post_date, post.post_img, category.category_name, user.first_name, user.last_name FROM post
                    LEFT JOIN category ON post.category = category.category_id
                    LEFT JOIN user ON post.author = user.user_id
                    WHERE post.category = {$catId}
                    ORDER BY post_id DESC LIMIT {$offset},{$limit}";

                    $result = mysqli_query($conn, $sql) or die("Query Failed");

                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                ?>
                  <h2 class="page-heading"><?=$row['category_name']?></h2>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?=$row['post_id']?>"><img src="admin/upload/<?=$row['post_img']?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?=$row['post_id']?>'><?=$row['title']?></a></h3>
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
                                    <p class="description">
                                    <?=substr($row['description'], 0, 100)."..."?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?=$row['post_id']?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                        } else {
                            echo "<h2>No Record Found</h2>";
                        }
                        // Show pagination
                        $sql1 = "SELECT post FROM category WHERE category_id={$catId}";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");
                        $row = mysqli_fetch_assoc($result1);
                        if(mysqli_num_rows($result1) > 0) {
                            $total_records = $row['post'];
                            $total_pages = ceil($total_records / $limit);
                            echo "<ul class='pagination admin-pagination'>";
                            if($page > 1) {
                                echo "<li><a href='category.php?id=".$catId."&page=".($page-1)."'>Prev</a></li>";
                            }
                            for($i=1; $i<=$total_pages; $i++) {
                                if($page == $i) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo "<li class='{$active}'><a href='category.php?id=".$catId."&page={$i}'>{$i}</a></li>";
                            }
                            if($total_pages > $page) {
                                echo "<li><a href=category.php?id=".$catId."&page=".($page+1).">Next</a></li>";
                            }
                            echo "</ul>";
                        }
                    ?>
                </div><!-- /post-container -->
            </div>
            <!-- Inlcude sidebar section-->
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<!-- Include footer section -->
 <?php include 'footer.php'; ?>
