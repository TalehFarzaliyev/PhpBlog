<?php include 'include/header.php';?>
<?php
	$id = $_GET["id"]; //will get id from url and insert it to be used.

    //Create DB object
    $db = new Database(); // from database.php

    //Create Query
    $query = "Select * From posts Where id = ".$id;
    //Run Query
    $post = $db->select($query)->fetch_assoc();

    //Create Query
    $query = "Select * From categories";
    $categories = $db->select($query);

?>
	<div class="blog-post">
    <h2 class="blog-post-title"><?php echo $post['title'];?></h2>
            <p class="blog-post-meta"><?php echo formatDate($post['data']);?> by <a href="#"><?php echo $post['author'];?></a></p>
              <?php echo $post['body'];?>

    </div><!--/.blog-post -->
<?php include 'include/footer.php';?>