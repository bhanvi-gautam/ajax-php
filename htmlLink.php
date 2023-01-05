<?php
include 'dbConnection.php';
if($_GET['key'] && $_GET['token'])
{
    $email = $_GET['key'];
    $token = $_GET['token'];
    $servername = "localhost";
    $link = "resetPassword?key=".$email."&token=".$token;

    // echo $link;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify</title>
</head>
<body>
    <form>
        <input type="hidden" id="token" name="token" value="<?php echo $_GET['token']; ?>">
        <input type="hidden" id="key" name="key" value="<?php echo $_GET['key']; ?>">
        <a href="<?php echo $link; ?>" id="link">Click here to reset Password</a>;
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script><!-- Jquery library-->
    <script src="crud.js"></script>

</body>
<!-- <body style="background: url('images/loginImage.jpg') no-repeat center center fixed; background-size: cover;width: 100%;height: 100%;" > -->
    <!-- <div id="content"></div> -->
<!-- </body> -->
</html>