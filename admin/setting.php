<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Website Setting</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
              <?php
                include "config.php";
                $sql = "SELECT * FROM setting";
                $result = mysqli_query($conn, $sql) or die("Query Failed");
                if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { ?>
                  <!-- Form -->
                  <form  action="save-setting.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Website Name</label>
                          <input type="text" name="website_name" class="form-control" value="<?=$row['website_name']?>" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Website Logo</label>
                          <input type="file" name="logo">
                          <img  src="images/<?=$row['logo']?>" height="80px" width="250px">
                          <input type="hidden" name="old_logo" value="<?=$row['logo']?>">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Footer Description</label>
                          <textarea name="footer" class="form-control" rows="5"  required><?=$row['footer']?></textarea>
                      </div>
                     
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <?php }}?>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
