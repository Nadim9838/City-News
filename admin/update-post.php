<?php include "header.php"; 
if($_SESSION['user_role'] == '0') {
    $id = $_GET['id'];
    $header_sql = "SELECT author FROM post WHERE post_id = {$id}";
    $header_result = mysqli_query($conn, $header_sql) or die("Update Post Header Query Failed");
    $header_row = mysqli_fetch_assoc($header_result);
    if($header_row['author'] != $_SESSION['user_id']) {
        header("location: {$hostname}/admin/post.php");
    }
}
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <?php
            include "config.php";
            $id = $_GET['id'];
            $sql = "SELECT post.post_id, post.title, post.description, post.post_date, post.category, post.post_img FROM post
            WHERE post.post_id = {$id}";

            $result = mysqli_query($conn, $sql) or die("Query Failed");
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { ?>
        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?=$row['post_id']?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?=$row['title']?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                    <?=trim($row['description'])?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <option value="" disabled> Select Cattegory</option>
                    <?php 
                        $sql2 = "SELECT * FROM category";
                        $result2 = mysqli_query($conn, $sql2) or die("Query Failed.");
                        if(mysqli_num_rows($result2) > 0) {
                            while($row2 = mysqli_fetch_assoc($result2)) {
                                if($row2['category_id'] == $row['category']) {
                                    $select = "selected";
                                } else {
                                    $select = "";
                                }
                                echo "<option {$select} value='{$row2['category_id']}'>{$row2['category_name']}</option>";
                            }
                        }
                    ?>
                </select>
                <input type="hidden" name="old_category" value="<?=$row['category']?>">
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?=$row['post_img']?>" height="150px">
                <input type="hidden" name="old_image" value="<?=$row['post_img']?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php }
            } else {
                echo "Result Not Found";
            }
        ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
