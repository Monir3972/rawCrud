
<?php include('db.php'); ?>
<?php 
   $msg = "";
   $msg_class = "";
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
   $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "images/";
    $target_file = $target_dir . basename($profileImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['profileImage']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO users SET name='$name', email='$email', image='$profileImageName'";
        if(mysqli_query($con, $sql)){
          $msg = "Image uploaded and saved in the Database";
          $msg_class = "alert-success";
        } else {
          $msg = "There was an error in the database";
          $msg_class = "alert-danger";
        }
      } else {
        $error = "There was an erro uploading the file";
        $msg = "alert-danger";
      }
    }
    
	// $sql = "INSERT INTO `users`(`name`, `email`,`image`) VALUES ('$name','$email','$image')";
	// $run = mysqli_query($con,$sql);
	// if($run == true){
	// 	header('Location: index.php');
	// }
	}
 ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <form action="" method="POST" enctype="multipart/form-data">
 	<label>Name</label>
 	<input type="text" name="name">
 	<label>Email</label>
 	<input type="text" name="email">
  <label>Profile</label>
  <input type="file" name="profileImage" id="profileImage">
  <img src="avatar.png" width="100" height="100" id="image">
 	<input type="submit" name="submit">
 </form>
 <table class="table">
  <thead>
    <tr>
      
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Profile</th>
      <th scope="col">Action</th>
     
    </tr>
  </thead>
  <tbody>
 <?php
  $sql = "SELECT * FROM users";
  $run = mysqli_query($con,$sql);
  while ($row = mysqli_fetch_assoc($run)) {
  ?>
     <tr>
      <td><?= $row['name']?></td>

      <td><?= $row['email']?></td>
       <td> <img src="<?php echo 'images/' . $row['image'] ?>" width="90" height="90" alt=""> </td>
      <td>
      	<a href="edit.php?edit=<?=$row['id']?>">Edit</a>
      	<a href="delete.php?delete=<?=$row['id']?>">Delete</a>
      </td>
    </tr>
<?php } ?>
 
   
  </tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
     <script type="text/javascript">
      profileImage.onchange = evt => {
      const [file] = profileImage.files
      if (file) {
        image.src = URL.createObjectURL(file)
      }
    }
    </script>
  </body>
</html>