<?php
include "dbConnection.php";
session_start();
// print_r($_SESSION);
if(isset($_SESSION["login"])){

   header("Location: {$hostname}/bhanvi/project1/dashboard");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="crud.css" >
    <title>LoginPage</title>
  </head>
  <body style="background: url('images/loginImage.jpg') no-repeat center center fixed; background-size: cover;width: 100%;height: 100%;" >
    <div class="container2">
        <form action ="<?php $_SERVER['PHP_SELF'];?>" style="margin-top:310px;" >
          <div class="form-group">
            <label for="loginEmail">Email</label>
            <input type="loginEmail" name="loginEmail" class="form-control" id="loginEmail" aria-describedby="loginEmailHelp">    
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="password">
          </div>
          <button type="submit" name="submitDetails" id="submitDetails" class="btn btn-primary">Submit</button>
          <a href="#" name="forgotPassword" id="forgotPassword" class="">Forgot Password?</a>

        </form>
    </div>
    
    <!-- Optional JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script><!-- Jquery library-->
    <script src="crud.js"></script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>