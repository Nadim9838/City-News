<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                include "../admin/config.php";
                $sql = "SELECT * FROM setting";
                $result = mysqli_query($conn, $sql) or die("Query Failed");
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<span>'.$row['footer'].'</span>';
                    }
                }?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
