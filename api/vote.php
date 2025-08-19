<?php
session_start();
include("connect.php");

// Check if required data is available
if (!isset($_POST['gvotes']) || !isset($_POST['gid']) || !isset($_SESSION['userdata']['id'])) {
    echo '
    <script>
        alert("Missing required data");
        window.location = "../routes/dashboard.php";
    </script>
    ';
    exit;
}

$votes = $_POST['gvotes'];
$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];
$total_votes = $votes + 1;

$update_votes = mysqli_query($connect,"UPDATE user SET votes = '$total_votes' WHERE id = '$gid'");
$update_user_status = mysqli_query($connect,"UPDATE user SET status = 1 WHERE id = '$uid'");

if($update_votes && $update_user_status){
    $groups = mysqli_query($connect,"SELECT * FROM user WHERE role=2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupsdata;

    echo '
    <script>
        alert("Voted Successfully");
        window.location = "../routes/dashboard.php";
    </script>
    ';
}
else{
    echo '
    <script>
        alert("Some error occurred");
        window.location = "../routes/dashboard.php";
    </script>
    ';
}
?>