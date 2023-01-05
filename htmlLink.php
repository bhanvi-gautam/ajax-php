<?php
include 'dbConnection.php';
if($_GET['key'] && $_GET['token'])
{

$email = $_GET['key'];
$token = $_GET['token'];
$servername = "localhost";
// $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
// $expDate = date("Y-m-d H:i:s",$expFormat);

//generate expiry time with token save it in db ....n when user is reseting password..check if the cur time when user clicked is less than that in db if less then ok else link expire

$link = "<a href='resetPassword?key=".$email."&token=".$token."'>Click To Reset password</a>";

echo $link;
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
<!-- <body style="background: url('images/loginImage.jpg') no-repeat center center fixed; background-size: cover;width: 100%;height: 100%;" > -->
    <!-- <div id="content"></div> -->
<!-- </body> -->
</html>