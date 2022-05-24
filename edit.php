
<?php include('db.php'); ?>
<?php 
if(isset($_GET['edit'])){
  $id = $_GET['edit'];
  $sql = "SELECT * FROM users WHERE id = $id";
  $edit = mysqli_query($con, $sql);
  $result = mysqli_fetch_assoc($edit);
}
?>
<?php 
if(isset($_POST['edit'])){
  $id = $_POST['mainId'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $sql = "UPDATE `users` SET `name`='$name',`email`='$email' WHERE id = $id";
  $run = mysqli_query($con, $sql);
  if($run == true){
    header('Location: index.php');
  }

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
    Update Data
    <form action="" method="POST">
     <input type="hidden" name="mainId" value="<?= $result['id']?>">
   	 <label>Name</label>
    	<input type="text" name="name" value="<?=$result['name']?>">
   	 <label>Email</label>
   	 <input type="text" name="email" value="<?=$result['email']?>">
   	 <input type="submit" name="edit" value="Update">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>