<?php
include './_partials/_dbconnect.php';
$sr = $_GET['ID'];
// echo $sr;
// $query = "DELETE FROM `crud` WHERE srno = $sr";
$query = "DELETE FROM crud WHERE `srno` = $sr";
$result = mysqli_query($conn, $query);
if($result){
    header("location: index.php");
    exit();
}
else{
    echo "Error deleting record:" . mysqli_error($conn);
}
?>