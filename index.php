<?php

// include config file
require_once("config/config.php");

// admin object
$admin = new Admin($db);

// Check if admin is not logged in
if (!($admin->is_logged_in())) {

    $admin->redirect('adminLogin.php');
}

// get all event regrading admins
$eventObj = new Event($db);
$allEvents = $eventObj->getAllEvent($_SESSION['id']);

// logout button 
if (isset($_REQUEST['logout'])) {
    $admin->logout();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- stylesheet link -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>Assignment- ADMIN LOGIN</title>
</head>

<body>
    <!-- header section start -->
    <header>
        <a href="index.php" class="logo">
            <h1 class="title">EVENT ASSIGNMENT</h1>
        </a>

        <a href="eventCreate.php" class="btn btn-blue create-event">Create A New Event</a>
        <nav>
            <ul>
                <?php if (isset($_SESSION["name"])) { ?>
                    <li class="admin-name"><?= $_SESSION["name"] ?></li>
                    <li>

                        <a href="index.php?logout=true" class="btn btn-red">Logout</a>

                    </li>
                <?php } else { ?>
                    <li><a href="adminLogin.php">Login</a></li>
                    <li><a href="adminRegister.php">Register</a></li>
                <?php } ?>

            </ul>


        </nav>
    </header>
    <!-- header section end -->


    <!-- main section -->
    <section class="main-container">
        <!-- msg show -->

        <?php if (isset($_REQUEST['msg'])) { ?>
            <div class="popup popup-green">
                <h2><?= $_REQUEST['msg'] ?></h2>
            </div>
        <?php } ?>


        <!-- status nav start -->
        <div class="status-nav">
            <ul>
                <li> <a href="index.php?status=true" class="<?php echo ($_REQUEST['status'] == 'true' || !isset($_REQUEST['status']))  ? 'active' : '' ?>">Actived Event</a></li>
                <li><a href="index.php?status=false" class="<?php echo  $_REQUEST['status'] == 'false' ? 'active' : '' ?>">Inactived Event</a></li>

            </ul>
        </div>
        <!-- status nav end -->


        <!-- list section start -->
        <div class="event-list">
            <?php foreach ($allEvents as $singleEvent) { ?>
                <?php if (($_REQUEST['status'] == 'true' || !isset($_REQUEST['status'])) && $singleEvent->status == true) { ?>
                    <div class="list-card">
                        <div class="card-img">
                            <img src="<?= $singleEvent->image ?>" class="list-card-image" alt=" <?= $singleEvent->title ?>">
                        </div>
                        <div class="card-description">
                            <a href="eventDetails.php?id=<?= $singleEvent->id ?>" class="list-card-header">
                                <h3><?= $singleEvent->title ?></h3>
                            </a>
                            <p class="list-card-text"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <?= $singleEvent->place ?></p>
                            <p class="list-card-text"><i class="fa fa-calendar" aria-hidden="true"></i>
                                <?= $singleEvent->date ?></p>
                        </div>
                        <div class="card-status">
                            <p class="list-card-text">Status: <?= $singleEvent->status ?>d</p>
                            <a href="index.php?changeStatus=true">Change Status</a>
                        </div>
                    </div>
                <?php } else if($singleEvent->status == false) { ?>
                    <div class="list-card">
                        <div class="card-img">
                            <img src="<?= $singleEvent->image ?>" class="list-card-image" alt=" <?= $singleEvent->title ?>">
                        </div>
                        <div class="card-description">
                            <a href="eventDetails.php?id=<?= $singleEvent->id ?>" class="list-card-header">
                                <h3><?= $singleEvent->title ?></h3>
                            </a>
                            <p class="list-card-text"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <?= $singleEvent->place ?></p>
                            <p class="list-card-text"><i class="fa fa-calendar" aria-hidden="true"></i>
                                <?= $singleEvent->date ?></p>
                        </div>
                        <div class="card-status">
                            <p class="list-card-text">Status: <?= $singleEvent->status ?>d</p>
                            <a href="index.php?changeStatus=true">Change Status</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <!-- list section end -->
    </section>
    <!-- main section end -->


    <!-- footer section start -->
    <footer>

    </footer>
    <!-- footer section end -->

</body>

</html>