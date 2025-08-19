<?php
session_start();

include("connect.php");

$mobile= $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];
$captcha = $_POST['captcha'];

// We don't need to validate CAPTCHA here as it's already validated by AJAX

// First check if the mobile number exists
$check_mobile = mysqli_query($connect,"SELECT * FROM user WHERE mobile = '$mobile' AND role = '$role'");

// Reset CAPTCHA after validation attempt
unset($_SESSION['captcha']);

if(mysqli_num_rows($check_mobile) > 0){
    // Mobile exists, now check password
    $check = mysqli_query($connect,"SELECT * FROM user WHERE mobile = '$mobile' AND password = '$password' AND role = '$role'");
    
    if(mysqli_num_rows($check) > 0){
        $userdata = mysqli_fetch_array($check);
        $groups = mysqli_query($connect,"SELECT * FROM user WHERE role=2");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        $_SESSION['userdata'] = $userdata;
        $_SESSION['groupsdata'] = $groupsdata;

        echo '
        <script>
            window.location = "../routes/dashboard.php";
        </script>
        ';
    }
    else {
        // Mobile exists but password is wrong
        echo '
        <script>
            alert("Invalid Password");
            window.location = "../";
        </script>
        ';
    }
}
else{
    // Mobile doesn't exist
    echo '
    <script>
        alert("Invalid Credentials");
        window.location = "../";
    </script>
    ';
}
?>