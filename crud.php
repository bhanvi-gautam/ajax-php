<?php
include 'dbConnection.php';
// include 'crud.css';

if($_GET['action'] == 'insertRecord'){
    insertRecord();
}
else if($_GET['action'] == 'loadRecordsTable'){
    loadRecordsTable();
}
else if($_GET['action'] == 'deleteRecord'){
    deleteRecord();
}
else if($_GET['action'] == 'fetchRecord'){
    fetchRecord();
}
else if($_GET['action'] == 'updateRecords'){
    updateRecords();
}
else if($_GET['action'] == 'verifyDetails'){
    verifyDetails();
}
else if($_GET['action'] == 'logoutSession'){
    logoutSession();
}
else if($_GET['action']=='forgotPassword'){
    forgotPassword();
}
else if($_GET['action']=='resetPassword'){
    resetPassword();
}
else if($_GET['action']=='checkExpire'){
    checkExpire();
}

    //function to load table
    function loadRecordsTable(){
        
        $limit_per_page=4;
        $page="";
        if(isset($_POST["page_no"])){
            $page=$_POST["page_no"];
        }
        else{
            $page=1;
        }
        $offset=($page -1)*$limit_per_page;
        // print_r($offset);
    
        $sql_total="SELECT * FROM users";
        $sql="SELECT * FROM users LIMIT {$offset},$limit_per_page";
        // print_r($sql);
        $conn=mysqli_connect("localhost","root","","dbproject1") or die("Connection failed");
        $result=mysqli_query($conn,$sql) or die("SQL Query failed.");
        $records=mysqli_query($conn,$sql_total) or die("SQL Query failed.");
        $total_records= mysqli_num_rows($records);
        $total_pages=ceil($total_records/$limit_per_page);

        // echo $total_pages;
        // exit;
        $output="";
        if(mysqli_num_rows($result)>0){
            while($row =mysqli_fetch_assoc($result)){
                if(!empty($row["profileImg"])){
                $output.="<tr><td>{$row["Id"]}</td><td><img src='images/{$row["profileImg"]}' height='50px' width='50px'}></td><td>{$row["firstName"]}</td><td>{$row["lastName"]}</td><td>{$row["emailId"]}</td><td>{$row["contactNo"]}</td><td class='edit delete'><button
                 class='edit-btn' id='edit-{$row["Id"]}' data-eid ='{$row["Id"]}' >Edit</button><button class='delete-btn' id='delete-{$row["Id"]}' data-id ='{$row["Id"]}' >Delete</button></td></tr>";
                }
                else{
                    $output.="<tr><td>{$row["Id"]}</td><td><img src='images/dummy.jpg' height='50px' width='50px'}></td><td>{$row["firstName"]}</td><td>{$row["lastName"]}</td><td>{$row["emailId"]}</td><td>{$row["contactNo"]}</td><td class='edit delete'><button
                    class='edit-btn' id='edit-{$row["Id"]}' data-eid ='{$row["Id"]}' >Edit</button><button class='delete-btn' id='delete-{$row["Id"]}' data-id ='{$row["Id"]}' >Delete</button></td></tr>";
                }
            }
            // $class_name="";
            $output2="";
            for($i=1;$i<=$total_pages;$i++){
                if($i==$page){
                    $class_name="active";
                }
                else{
                    $class_name="";
                }
                $output2.="<a class='{$class_name}' id='{$i}' href='#'>{$i}</a>";
            }
                
            $Array=array("table_data"=>$output,"pagination"=>$output2);
            
            mysqli_close($conn);
            echo json_encode($Array);
            // echo $output;
          }
        else{
            echo "<h2>No record found</h2>";
        }
    }


    // function to insert record
    function insertRecord(){
        
        $user_id = $_POST['user_id'];
        $firstName = $_REQUEST['firstName']; 
        $lastName = $_REQUEST['lastName'];
        $contactNo = $_POST['contactNo'];
        $emailId = $_REQUEST['email'];
        $password = $_REQUEST['password'];


        $pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
        if (!preg_match ($pattern, $emailId) ){  
            echo "email is not valid";
        }

        $length=strlen($password);
        if($length <6){
            echo "password is not valid";
        }
        
        $phoneLen = strlen ($contactNo);  
        if ( $phoneLen < 10 && $phoneLen > 10) {  
            $ErrMsg = "Mobile must have 10 digits.";  
            echo $ErrMsg;  
        }
        $img = $_FILES['Upload']['name'];
        $tmp = $_FILES['Upload']['tmp_name'];
       $response = 0;
       $conn=mysqli_connect("localhost","root","","dbproject1");
        $encryp=password_hash($password,PASSWORD_BCRYPT);
       $newImg="";
       
        if($_FILES['Upload']['size'] != 0 && $_FILES['Upload']['error'] == 0){ 
            $explode_img=explode(".",$img);
            // $newImg= $user_id;
            $newImg=time().'_'.mt_rand().'.'.$explode_img[1];
            $location = "images/".$newImg;
            $ext=strtolower(pathinfo($location,PATHINFO_EXTENSION)); 
            $valid_extensions = array("jpg","jpeg","png");
            if(in_array(strtolower($ext), $valid_extensions)) {
                if(move_uploaded_file($tmp,$location)){
                    $response = $location;
                 }
            }
            else {echo '3'; exit;} 
        }
    
        if(empty($user_id)){
            $sqlquery = "INSERT INTO users (profileImg,firstName,lastName,contactNo,emailId,password) VALUES ('".$newImg."','".$firstName."','".$lastName."','".$contactNo."','".$emailId."','".$encryp."')";
         }else{
            // if($verify){
               $sqlquery ="UPDATE users SET profileImg='{$newImg}',firstName='{$firstName}',lastName='{$lastName}',contactNo='{$contactNo}',emailId='{$emailId}',password='{$encryp}' where Id='{$user_id}'";
        // }else{
           // echo "password not verified";
        // }
         }
        if($conn->query($sqlquery)){
            echo '1';
        }else{
            echo '0';
        }
    }
        
    // function to delete record
    function deleteRecord(){
        // $request = $_REQUEST; 
        $user_id = $_POST['Id'];
        $explode_userId=explode("-",$user_id);
        // print_r($explode_userId);
        // exit;
        // Set the DELETE SQL data
        $conn=mysqli_connect("localhost","root","","dbproject1");
        // print_r($user_id);
        $sql = "DELETE FROM users WHERE id={$explode_userId[1]}";
       
        if($conn->query($sql)){
            echo 1;
        }
        else {
            echo 0;
        }

        // $sql = "DELETE FROM dbpoject1_address WHERE id='".$id."'";

        // if($conn->query($sql)){
        //     echo "done";
        // }
        // else {
        //     echo "error";
        // }
        
        $conn->close();
    }

    //function to fetch record
    function fetchRecord(){
        $user_id = $_POST['Id'];
        $conn=mysqli_connect("localhost","root","","dbproject1") or die("Connection failed");
        $sql= "SELECT * FROM Users where id={$user_id}";
        $result=mysqli_query($conn,$sql) or die("SQL Query failed.");

        $dataArray=array();
        if(mysqli_num_rows($result)>0){
        
            while ($row = mysqli_fetch_array($result))
            {  
                $dataArray["firstName"] = $row["firstName"]; 
                $dataArray["lastName"] = $row["lastName"];
                $dataArray["contactNo"] = $row["contactNo"];
                $dataArray["emailId"] = $row["emailId"];
                $dataArray["password"] = $row["password"];
                $dataArray["userId"] = $row["Id"];

                // $dataArray["address"] = $row["address"];

            }
            echo json_encode($dataArray);
        }
        else{
            echo "<h2>No record found</h2>";
        }   
       
        mysqli_close($conn);
    }

    //function to verify details
    function verifyDetails(){
        $emailId = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        
        $conn=mysqli_connect("localhost","root","","dbproject1") or die("Connection failed");
        $sql="SELECT password FROM users where emailId='{$emailId}'";
        $result=mysqli_query($conn,$sql) or die("SQL Query failed.");
        $table = null;
        if(mysqli_num_rows($result)==0){
            echo '1';
            exit;
        }

        while ($row = mysqli_fetch_array($result)) {
            $table = $row;       
        }
        $hash=$table['password'];
        
        $verify= password_verify($password, $hash);
        if($verify){
            $sql1="SELECT firstName,lastName FROM users where emailId='{$emailId}'";
            $result1=mysqli_query($conn,$sql1) or die("SQL Query failed.");
            $nameArr=null;
            $fullName="";
        if(mysqli_num_rows($result1)>0){
            while ($row = mysqli_fetch_array($result1))
            {  
                $nameArr=$row;
            }
            $fullName.=$nameArr[0].' '.$nameArr[1];
          
        }
       
            session_start();
            $_SESSION["emailId"]=$emailId;
            $_SESSION["password"]=$password;
            $_SESSION["fullName"]=$fullName;
            $_SESSION["login"]="1";
         
        
      
        echo "2";
        }
        else{
            echo '3';
        }
        mysqli_close($conn);

    }


    //TO LOGOUT SESSION
    function logoutSession(){
        session_start() ;
        if(isset($_SESSION['login'])) {
            session_unset();
            session_destroy();
        }
        mysqli_close($conn);
    }


    //FORGOT PASSWORD
    function forgotPassword(){

        $emailId = $_REQUEST['emailId'];
        $conn=mysqli_connect("localhost","root","","dbproject1") or die("Connection failed");
        $sql="SELECT emailId FROM users where emailId='{$emailId}'";
        $result=mysqli_query($conn,$sql) or die("SQL Query failed.");
        $token = md5($emailId).rand(10,9999);
        // $servername = "localhost";      
        // $link = "<a href='{$servername}/bhanvi/project1/resetPassword.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>";

        $startTime = date('Y-m-d H:i', strtotime("+1 min"));
        if(mysqli_num_rows($result)==1){
            $update ="UPDATE users SET token='" . $token . "',tokenExpiryTime='" . $startTime . "' WHERE emailId='" . $emailId . "'";
            $sql2= mysqli_query($conn,$update);
            // $Arr=array("link"=>$link,"data"=>"1");
            $Arr=array("key"=>$emailId,"token"=>$token,"data"=>"1");
            echo json_encode($Arr);
            // echo "1";
        }
        else{
            echo "Invalid email ID";
        }
        mysqli_close($conn);
    }


    //LINK EXPIRED
    function checkExpire(){
        $endTime = date('Y-m-d H:i');
        $key = $_REQUEST['key'];
        $token = $_REQUEST['token'];
        $conn=mysqli_connect("localhost","root","","dbproject1") or die("Connection failed");
        $timequery="SELECT tokenExpiryTime FROM users WHERE token='" . $token . "' and emailId= '" . $key . "'";
        $TimeResult=mysqli_query($conn,$timequery) or die("SQL Query failed.");
        $table="";
        while ($row = mysqli_fetch_array($TimeResult)) {
            $table = $row;       
        }
        $deadLine=$table[0];

        $date1=strtotime($deadLine);
        $date2=strtotime($endTime);
        if($date1<$date2){
            echo "15";
            exit;
        }
    }

    // RESET PASSWORD
    function resetPassword(){
        if($_REQUEST['token'] && $_REQUEST['key'])
        {
            $token = $_REQUEST['token'];
            $key = $_REQUEST['key'];
            $pass= $_REQUEST['pass1'];
            $encryp=password_hash($pass,PASSWORD_BCRYPT);
            // $endTime = date('Y-m-d H:i');
            $conn=mysqli_connect("localhost","root","","dbproject1") or die("Connection failed");
            // $timequery="SELECT tokenExpiryTime FROM users WHERE token='" . $token . "' and emailId= '" . $key . "'";
            // $TimeResult=mysqli_query($conn,$timequery) or die("SQL Query failed.");
            // $table="";
            // while ($row = mysqli_fetch_array($TimeResult)) {
            //     $table = $row;       
            // }
            // $deadLine=$table[0];

            // $date1=strtotime($deadLine);
            // $date2=strtotime($endTime);
            // if($date1<$date2){
            //     echo "15";
            //     exit;
            // }
            
            $sql="SELECT emailId FROM users WHERE token='" . $token . "' and emailId= '" . $key . "'";
            $result=mysqli_query($conn,$sql) or die("SQL Query failed.");
            if(mysqli_num_rows($result)==1){
                $update ="UPDATE users SET password='" . $encryp . "' WHERE token='" . $token . "'";
            }
            if($conn->query($update)){
                $sql2="UPDATE users SET token= NULL WHERE token='" . $token . "' and emailId= '" . $key . "'";
                if($conn->query($sql2)){
                    echo '1';
                }
                else{
                    echo '0';
                }

            }else{
                echo '0';
            }
        }
    }

?>