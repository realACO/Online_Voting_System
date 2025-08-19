<?php
session_start();
if(!isset($_SESSION['userdata'])){
    header("location: ../");
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if($_SESSION['userdata']['status'] == 0){
    $status='<span class="text-danger">Not Voted</span>';
}
else{
    $status='<span class="text-success">Voted</span>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE VOTING SYSTEM - DASHBOARD</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .dashboard-container {
            padding: 1rem;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .dashboard-title {
            text-align: center;
            flex-grow: 1;
            margin: 0;
            color: var(--text-color);
            font-size: 2.5rem;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        @media (min-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr 2fr;
            }
        }
        
        .candidate-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
    </style>
</head>
<body style="background-image: url('../images/bg5.png');">
    <header class="header">
        <hr>
        <h1>ONLINE VOTING SYSTEM</h1>
        <hr>
    </header>
    
    <div class="container dashboard-container">
        <div class="nav-buttons">
            <a href="../" class="nav-btn">Back</a>
            <a href="logout.php" class="nav-btn">Logout</a>
        </div>
        
        <div class="dashboard-grid">
            <!-- Profile Section -->
            <div class="profile-section">
                <img src="../uploads/<?php echo $userdata['photo']; ?>" alt="Profile Picture" class="profile-image">
                
                <div class="profile-info">
                    <p><strong>Name:</strong> <?php echo $userdata['name']; ?></p>
                    <p><strong>Mobile:</strong> <?php echo $userdata['mobile']; ?></p>
                    <p><strong>Address:</strong> <?php echo $userdata['address']; ?></p>
                    <p><strong>Status:</strong> <?php echo $status; ?></p>
                </div>
            </div>
            
            <!-- Candidates Section -->
            <div class="candidate-list">
                <?php
                if($_SESSION['groupsdata']){
                    $groupsdata = $_SESSION['groupsdata'];
                    for($i=0; $i<count($groupsdata); $i++){
                        ?>
                        <div class="candidate-card">
                            <img src="../uploads/<?php echo $groupsdata[$i]['photo']; ?>" class="candidate-image">
                            
                            <div class="candidate-info">
                                <h3><?php echo $groupsdata[$i]['name']; ?></h3>
                                <p><strong>Votes:</strong> <?php echo $groupsdata[$i]['votes']; ?></p>
                                
                                <form action="../api/vote.php" method="post" class="candidate-actions">
                                    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']; ?>">
                                    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']; ?>">
                                    
                                    <?php
                                    if($_SESSION['userdata']['status'] == 0){
                                        ?>
                                        <button type="submit" class="btn">Vote</button>
                                        <?php
                                    }
                                    else{    
                                        ?>                           
                                        <button disabled type="submit" class="btn btn-success btn-disabled">VOTED</button>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    
    <script>
        // Add animations to elements
        document.addEventListener('DOMContentLoaded', function() {
            // Animate profile section
            const profileSection = document.querySelector('.profile-section');
            setTimeout(() => {
                profileSection.style.opacity = '1';
                profileSection.style.transform = 'translateY(0)';
            }, 100);
            
            // Animate candidate cards with staggered delay
            const candidateCards = document.querySelectorAll('.candidate-card');
            candidateCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 200 + (index * 100));
            });
        });
    </script>
</body>
</html>
