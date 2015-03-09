<?php include 'includes/header.php';?>
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
<?php
  //Create db object
  $db = new Database();

  if (isset($_POST['submit'])) {
    //Assign Variables
    //Get is for url, and Post is in form!
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
    $category = mysqli_real_escape_string($db->link, $_POST['category']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
    //echo $tags;die();
    //Validation
    if($title == '' || $body == '' || $category == '' || $author == ''){
      //Set error
      $error = 'Please fill out required fields';
      echo $error;
    }
    else {
      $query = "Update posts
                Set title = '$title',
                body = '$body',
                category = '$category',
                author = '$author',
                tags = '$tags'
                Where id = ".$id;

      $update_row = $db->update($query);
    }
  }
?>
<?php
  if (isset($_POST['delete'])) {
    $query = "Delete from posts Where id = " .$id;

    $delete_row = $db->delete($query);
  }
?>

<form role = "form" method="post" action="edit_post.php?id=<?php echo $id; ?>">
  <div class="form-group">
    <label>Post Title</label>
    <input name="title" type="text" class="form-control"  placeholder="Enter Title" value="<?php echo $post['title'];?>">
  </div>
  <div class="form-group">
    <label>Post Body</label>
    <textarea name="body" class="form-control"  placeholder="Enter Post Body"><?php echo $post['body'];?></textarea>

  </div>
  <div class="form-group">
    <label>Category</label>
    	<select name = "category" class="form-control">
  			<?php while($row = $categories->fetch_assoc()): ?>
          <?php if($row['id'] == $post['category']){
            $selected = 'selected';
            }
            else {
            $selected = '';
            }

          ?>
          <option value="<?php echo $row['id']; ?>"> <?php echo $selected; ?>><?php echo $row['name'];?></option>
  			  <option>Events</option>
      <?php endwhile;?>

		</select>
  </div>
  <div class="form-group">
    <label>Post Author</label>
    <input name="author" type="text" class="form-control"  placeholder="Enter Author Name"
    value="<?php echo $post['author'];?>">
  </div>
  <div class="form-group">
    <label>Tags</label>
    <input name="tags" type="text" class="form-control"  placeholder="Enter Tags" value="<?php echo $post['tags'];?>">

  </div>
  <div>
  	<input name = "submit"type="submit" class="btn btn-default" value="Submit"/>
  	<a href="index.php" class="btn btn-default">Cancel</a>
    <input name = "submit"type="submit" class="btn btn-danger" value="Delete"/>
  </div>
  <br>
</form>

<?php include 'includes/footer.php';?>