<?php
session_start();
if(!isset($_SESSION['userdata'])){
    header("location: ../");
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if($_SESSION['userdata']['status'] == 0){
    $status='<b style="color: red;">Not Voted</b>';
}
else{
    $status='<b style="color: green;">Voted</b>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE VOTING SYSTEM- DASHBOARD</title>
    <style>
        body {
            height: 100vh;
            width: 100%;
            background-image: url('../images/bg5.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat; 
            font-family: 'Roboto', sans-serif;
            color: #333;
        }

        h1 {
            text-align: center;
            font-size: 50px;
            margin-top: 50px;
            color: rgb(2, 2, 2);
        }

        button:hover {
            background-color: #555;
            color: white;
        }

        #backbtn {
            padding: 5px;
            font-size: 20px;
            background-color:rgb(0, 0, 0);
            color: white;
            border-radius: 4px;
            float: left;
            margin: 10px;
        }

        #logoutbtn {
            padding: 5px;
            font-size: 20px;
            background-color:rgb(0, 0, 0);
            color: white;
            border-radius: 4px;
            float: right;
            margin: 10px;
        }

        #Profile {
            background-color: rgb(255, 255, 255);
            width: 30%;
            padding: 20px;
            float: left;
        }

        #Group{
            background-color: rgb(255, 255, 255);
            width: 60%;
            padding: 20px;
            float: right;
        }
        #votesbtn{
            padding: 5px;
            font-size: 20px;
            background-color:rgb(0, 0, 0);
            color: white;
            border-radius: 4px;
        }
        #mainsection{
            padding: 10px;
        }
        #voted{
            padding: 5px;
            font-size: 20px;
            background-color:green;
            color: white;
            border-radius: 4px;
        }

    </style>
</head>
<body>
    <div id="mainsection">
        <div id="headersection">
            <a href="../"><button id="backbtn">Back</button></a>
            <a href="logout.php"><button id="logoutbtn">Logout</button></a>
            <h1>ONLINE VOTING SYSTEM</h1>
        </div>
        <hr>
        <div id="Profile">
            <center><img src="../uploads/<?php echo $userdata['photo']; ?>" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%; margin-left: 0%; margin-top: 50px;"></center><br><br>
            <b>Name: </b> <?php echo $userdata['name']; ?><br><br>
            <b>Mobile: </b> <?php echo $userdata['mobile']; ?><br><br>
            <b>Address: </b> <?php echo $userdata['address']; ?><br><br>
            <b>Status: </b> <?php echo $status; ?><br><br>
        </div>
        <div id="Group">
            <?php
            if($_SESSION['groupsdata']){
                $groupsdata = $_SESSION['groupsdata'];
                for($i=0; $i<count($groupsdata); $i++){
                    ?>
                    <div>
                        <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo']; ?>" height="100px" width="100px">
                        <b>Group Name: </b> <?php echo $groupsdata[$i]['name']; ?><br><br>
                        <b>Votes: </b> <?php echo $groupsdata[$i]['votes']; ?><br><br>
                        <form action="../api/vote.php" method="post">
                            <input type="hidden" name="gvotes" value=" <?php echo $groupsdata[$i]['votes']; ?>">
                            <input type="hidden" name="gid" value=" <?php echo $groupsdata[$i]['id']; ?>">
                            
                            <?php
                            if($_SESSION['userdata']['status'] == 0){
                                ?>
                                <input type="submit" value="votesbtn" value="vote" id="votesbtn">
                                <?php
                            }
                            else{    
                                ?>                           
                                <button disabled type="submit" value="votesbtn" value="vote" id="voted">VOTED</button>
                                <?php
                            }
                            ?>
                        </form><br>
                    </div>
                    <hr>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    
    
</body>
</html>
