<?php
include 'db_connect.php';
$conn=mysqli_connect("localhost","root","","test") or die("Connection failed");
// $Contact_No = $_REQUEST['Contact_No'];
$sql= "SELECT * FROM Users where Sno =1";

$result=mysqli_query($conn,$sql) or die("SQL Query failed.");
// print_r($result);


$dataArray = array();

    if(mysqli_num_rows($result)>0){
        
        while ($row = mysqli_fetch_array($result))
        {  
            $dataArray["FirstName"] = $row["First_Name"]; 
            $dataArray["Last_Name"] = $row["Last_Name"];
            $dataArray["Contact_No"] = $row["Contact_No"];
            $dataArray["emailID"] = $row["emailID"];
            

        }
    }

echo json_encode($dataArray);
mysqli_close($conn);
?>
