<?php
include 'dbConnection.php';
session_start();
// print_r($_SESSION);
if(!isset($_SESSION["login"])){
   header("Location: {$hostname}/bhanvi/project1/login");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="crud.css" >
   <title>Dashboard</title>
   <!-- <link rel="stylesheet" href="crud.css"> -->
</head>
<body style="background: url('images/dashboard.jpg') no-repeat center center fixed; background-size: cover;width: 100%;height: 100%;" >
<h1>
<?php 

   echo "Welcome, ".$_SESSION["fullName"];

?>
</h1>
</body>

<form>
   <input type="button" id="logout" value="logout" name="logout">
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script><!-- Jquery library-->
    <script src="crud.js"></script>
</body>
</html>
