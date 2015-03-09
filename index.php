<?php include 'include/header.php';?>

<?php
    //Create DB object
    $db = new Database(); // from database.php

    //Create Query
    $query = "Select * From posts Order By id DESC";
    //Run Query
    $posts = $db->select($query);

    //Create Query
    $query = "Select * From categories";
    $categories = $db->select($query);

?>
<?php if($posts): ?>
  <?php while($row = $posts->fetch_assoc()): ?>
          <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $row['title'];?></h2>
            <p class="blog-post-meta"><?php echo formatDate($row['data']);?> by <a href="#"><?php echo $row['author'];?></a></p>
              <?php echo shortenedText($row['body']);?>
            <a class="readmore" href="post.php?id=<?php echo urlencode($row['id']);?>">Read More</a>
          </div><!--/.blog-post -->
        <?php endwhile;?>
<?php else: ?>
  <p>No posts yet</p>
<?php endif; ?>

<?php include 'include/footer.php';?>