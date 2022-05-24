<?php
 include('db.php');
  if(isset($_GET['delete'])){
  	$id = $_GET['delete'];
  	$sql = "DELETE FROM `users` WHERE id = $id";
  	$run = mysqli_query($con,$sql);
  	if($run == true){
  		 header('Location: index.php');
  	}
  }
 ?>