<?php
// include config file
require_once("config/config.php");

// models object
// db: Instance of database connection
$admin = new Admin($db);
$event = new Event($db);

// Check if admin is not logged in
if (!($admin->isLoggedIn())) {
    $admin->redirect('adminLogin.php');

}


// change active status
if(isset($_REQUEST['makeActive'])){
    $event->changeActiveStatus($_REQUEST['eventId'],$_REQUEST['makeActive']);
    $admin->redirect('index.php');
}
// fetch single event
$singleEventInfo = $event->getEvent($_REQUEST['id']);

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


    <title>Assignment- Event Create</title>
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
        <!-- Event  details section start -->
        <div class="event-details">
            <?php if ($singleEventInfo) { ?>
                <img src="<?= $singleEventInfo->image ?>" class="event-image" alt=" <?= $singleEventInfo->title ?>">
                <h2 class="event-title">
                    <?= $singleEventInfo->title ?>
                </h2>
                <p class="event-text">
                    Status: <span class="batch"><?= $singleEventInfo->status ?></span>
                </p>

                <p class="event-text">
                    <i class="fa fa-calendar" aria-hidden="true"></i></i>&nbsp;&nbsp;<?= $singleEventInfo->date ?>
                </p>

                <p class="event-text">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<?= $singleEventInfo->place ?>
                </p>

                <p class="event-text">
                    <i class="fa fa-address-book" aria-hidden="true"></i>&nbsp;&nbsp;<?= $singleEventInfo->address ?>
                </p>

                <p class="event-text">
                    <i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;<?= $singleEventInfo->description ?>
                </p>

            <?php } ?>
            <!-- Back btn  -->
            <div class="center">
                <?php if ($singleEventInfo->status == 'inactive') { ?>
                    <a href="eventDetails.php?eventId=<?= $singleEventInfo->id ?>&makeActive=true" class="btn btn-green">Active</a>
                <?php } else { ?>
                    <a href="eventDetails.php?eventId=<?= $singleEventInfo->id ?>&makeActive=false" class="btn btn-green">Inactive</a>
                <?php } ?>

                <a href="index.php" class="btn btn-blue">Back</a>
            </div>
        </div>
        <!-- Event  details section end -->
    </section>
    <!-- main section end -->

    <!-- footer section start -->
    <footer>
        <p>Developed by <a href="mailto:ratulsikder104@gmail.com">Ratul Sikder</a></p>
    </footer>
    <!-- footer section end -->

</body>

</html>