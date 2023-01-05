<?php
include 'db_connect.php';

$sql="DELETE FROM users where Id=41";

if($conn->query($sql)){
    echo "done";
}
else {
    echo "error";
}

$conn->close();
// if(isset($_POST['deleteId'])){
// echo ("abcd");
//     $id= $_POST['deleteId'];
//     delete_data($connection, $id);

// }

// function delete_data($connection, $id){
   
//     $query="DELETE from usertable WHERE id=$id";
//     $exec= mysqli_query($connection,$query);

//     if($exec){
//       echo "Data was deleted successfully";
//     }else{
//         $msg= "Error: " . $query . "<br>" . mysqli_error($connection);
//       echo $msg;
//     }
// }
?>
