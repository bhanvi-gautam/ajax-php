<?php
include 'db_connect.php';

$First_Name = $_REQUEST['First_Name']; 
$Last_Name = $_REQUEST['Last_Name'];
$Contact_No = $_REQUEST['Contact_No'];
$emailID = $_REQUEST['emailID'];

$sqlquery = "INSERT INTO users (First_Name,Last_Name,Contact_No,emailID) VALUES
    ('".$First_Name."','".$Last_Name."','".$Contact_No."','".$emailID."')";
	
	
if ($conn->query($sqlquery) === TRUE) {
    echo "record inserted successfully";
} else {
    echo "Error: " . $sqlquery . "<br>" . $conn->error;
}
exit;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    // collect value of input field
    $data = $_REQUEST['First_Name'];
 
    if (empty($data)) {
        echo "data is empty";
    } else {
        echo $data;
    }
	
}
?>

 
