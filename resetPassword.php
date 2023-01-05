<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
       <link rel="stylesheet" href="crud.css">
 
    <title>Reset Password</title>
</head>
<body style="background: url('images/loginImage.jpg') no-repeat center center fixed; background-size: cover;width: 100%;height: 100%;" >
<div class="container3">
          <div class="card">
            <div class="card-header text-center">
              Enter New Password
            </div>
            <div class="card-body">
              <form action="" method="">
                <div class="form-group">
                  <label for="exampleInputPassword">New Password</label>
                  <input type="password" name="newPassword" class="form-control" id="newPassword" aria-describedby="emailHelp" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Confirm New Password</label>
                  <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" aria-describedby="emailHelp" >
                </div>
                <input type="hidden" id="token" name="token" value="<?php echo $_GET['token']; ?>">
                <input type="hidden" id="key" name="key" value="<?php echo $_GET['key']; ?>">
                <button type="submit" class="btn btn-primary" name="submitNewPassword" id="submitNewPassword">Submit</button>

              </form>
            </div>
          </div>
      </div>
 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script><!-- Jquery library-->
    <script src="crud.js"></script>
</body>
</html>
