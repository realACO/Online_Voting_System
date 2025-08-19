<?php
session_start();

include("connect.php");

$name = $_POST['Name'];
$mobile= $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address = $_POST['address'];
$image = $_FILES['photo']['name'];
$temp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];
$captcha = $_POST['captcha'];

// We don't need to validate CAPTCHA here as it's already validated by AJAX

// Reset CAPTCHA after validation attempt
unset($_SESSION['captcha']);

if($password == $cpassword){
    move_uploaded_file($temp_name,"../uploads/$image");
    $insert = mysqli_query($connect,"INSERT INTO user (name, mobile, address, password, photo, role, status, votes ) VALUES ('$name','$mobile','$address','$password','$image','$role',0,0)");
    if($insert){
        echo '
        <script>
            alert("Registration Successful");
            window.location = "../";
        </script>
        ';
    }
    else{
        echo '
        <script>
            alert("some error occured");
            window.location = "../routes/registration.html";
        </script>
        ';
    }
}
else{
    echo '
        <script>
            alert("password and confirm password does not match");
            window.location = "../routes/registration.html";
        </script>
    ';
}
?>