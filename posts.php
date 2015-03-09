 <?php include 'include/header.php';?>

<?php
  $db = new Database(); // from database.php

  //Check Url category
  if(isset($_GET['category'])){
    $category = $_GET['category'];
    //Create Query
    $query = "Select * FROM posts Where category = ".$category."Order by id DESC";
    //Run Query
    $posts = $db->select($query);
  }
  else{
    //Create query
    $query = "Select * From posts Order By id DESC";
    //Run query
    $posts = $db->select($query);

  }

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