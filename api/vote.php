<?php
/*
session_start();
include("connect.php");

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
        alert("Some error occured");
        window.location = "../routes/dashboard.php";
    </script>
    ';
}
*/

session_start();
include("connect.php");

// Debugging: Check if POST data and session data are set
if (!isset($_POST['gvotes']) || !isset($_POST['gid']) || !isset($_SESSION['userdata']['id'])) {
    die('Required data not set');
}

$votes = $_POST['gvotes'];
$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];
$total_votes = $votes + 1;

// Debugging: Check values before executing queries
error_log("Votes: $votes, GID: $gid, UID: $uid, Total Votes: $total_votes");

$update_votes = mysqli_query($connect,"UPDATE user SET votes = '$total_votes' WHERE id = '$gid'");
$update_user_status = mysqli_query($connect,"UPDATE user SET status = 1 WHERE id = '$uid'");

// Debugging: Check if queries executed successfully
if (!$update_votes) {
    error_log("Error updating votes: " . mysqli_error($connect));
}
if (!$update_user_status) {
    error_log("Error updating user status: " . mysqli_error($connect));
}

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