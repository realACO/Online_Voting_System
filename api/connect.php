
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$connect = mysqli_connect("localhost","root","","voting") or die("connection failed!");

if($connect){
    echo "Connected!";
}
else{
    echo "Not Connected!";
}

?>
