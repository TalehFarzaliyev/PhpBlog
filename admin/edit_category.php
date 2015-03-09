<?php include 'includes/header.php';?>

<?php
  $id = $_GET["id"]; //will get id from url.

    //Create DB object
    $db = new Database(); // from database.php

    //Create Query
    $query = "Select * From categories Where id = ".$id;
    //Run Query
    $category = $db->select($query)->fetch_assoc();

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
    $name = mysqli_real_escape_string($db->link, $_POST['name']);

    //echo $tags;die();
    //Validation
    if($name == ''){
      //Set error
      $error = 'Please fill out required fields';
      echo $error;
    }
    else {
      $query = "Update categories
                Set
                name = '$name';
                Where id =".$id;

      $update_row = $db->update($query);
    }
  }
?>
<?php
  if (isset($_POST['delete'])) {
    $query = "Delete from categories Where id = ".$id;

    $delete_row = $db->delete($query);
  }
?>


<form role = "form" method="post" action="edit_category.php?id=<?php echo $id; ?>">
  <div class="form-group">
    <label>Category Name</label>
    <input name="name" type="text" class="form-control" placeholder="Enter category" value="<?php echo $category['name'];?>">
  </div>
  <div>
  	<input name = "submit"type="submit" class="btn btn-default" value="Submit"/>
  	<a href="index.php" class="btn btn-default">Cancel</a>
    <input name = "delete"type="submit" class="btn btn-danger" value="Delete"/>
  </div>
  <br>
</form>
<?php include 'includes/footer.php';?>
