
<?php
// Only show errors during development
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$connect = mysqli_connect("localhost","root","","voting") or die("connection failed!");

// Remove connection status messages to avoid displaying them to users
// if($connect){
//     echo "Connected!";
// }
// else{
//     echo "Not Connected!";
// }

?>
