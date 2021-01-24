<?php
// include config file
require_once("config/config.php");

// admin object
$admin = new Admin($db);

//Check if admin is not logged in
if (!($admin->isLoggedIn())) {
    $admin->redirect('adminLogin.php');
}

// get all event regrading admins
$eventObj = new Event($db);
$allEvents = $eventObj->getAllEvent($_SESSION['id']);

// change all today event to active another to inactive automatically
// Uncomment this to apply this action
// $eventObj->changeEventStatusByDate();

// delete event from event list
if (isset($_REQUEST['delete']) && $_REQUEST['delete']) {
    $eventObj->deleteEvent($_REQUEST['id']);
    header( "Location: index.php" );
    
}

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
        <?php }
        unset($_REQUEST['msg']);
        ?>


        <!-- status nav start -->
        <div class="status-nav">
            <ul>
                <li> <a href="index.php?status=true"
                        class="<?php echo ($_REQUEST['status'] == 'true' || !isset($_REQUEST['status']))  ? 'active' : '' ?>">Actived
                        Event</a></li>
                <li><a href="index.php?status=false"
                        class="<?php echo  $_REQUEST['status'] == 'false' ? 'active' : '' ?>">Inactived Event</a></li>

            </ul>
        </div>
        <!-- status nav end -->


        <!-- list section start -->
        <div class="event-list">
            <!-- event empty -->
            <?php if (empty($allEvents)) { ?>

                <div class="alert">
                    Event list is empty;
                    Click on <span class="batch">CREATE NEW EVENT</span>  on nav.Or 
                    <a href="eventCreate.php" class="batch">Click Here</a>
                </div>
            <!-- otherwise -->
            <?php } else { ?>

            <?php foreach ($allEvents as $singleEvent) { ?>
            <!-- activated events -->
            <?php if ((!isset($_REQUEST['status']) || $_REQUEST['status'] == 'true') && $singleEvent->status == 'active') { ?>
                <div class="list-card">
                    <div class="card-img">
                        <img src="<?= $singleEvent->image ?>" class="list-card-image" alt=" <?= $singleEvent->title ?>">
                    </div>

                    <div class="card-description">
                        <a href="eventDetails.php?id=<?= $singleEvent->id ?>" class="list-card-header">
                            <h3><?= $singleEvent->title ?></h3>
                            <p class="card-status list-card-text">Status: <?= $singleEvent->status ?>d</p>
                        </a>

                        <p class="list-card-text">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <?= $singleEvent->place ?>
                        </p>

                        <p class="list-card-text">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?= $singleEvent->date ?>
                        </p>
                    </div>

                    <div class="card-action">
                        <a href="index.php?id=<?= $singleEvent->id ?>&delete=true">Delete</a>
                    </div>
                </div>
            <!-- activated ends -->

            <!-- inactivated event -->
            <?php } else if (isset($_REQUEST['status']) && $_REQUEST['status'] == 'false' && $singleEvent->status == 'inactive') { ?>
                <div class="list-card">
                    <div class="card-img">
                        <img src="<?= $singleEvent->image ?>" class="list-card-image" alt=" <?= $singleEvent->title ?>">
                    </div>

                    <div class="card-description">
                        <a href="eventDetails.php?id=<?= $singleEvent->id ?>" class="list-card-header">
                            <h3><?= $singleEvent->title ?></h3>
                            <p class="card-status list-card-text">Status: <?= $singleEvent->status ?>d</p>
                        </a>

                        <p class="list-card-text">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <?= $singleEvent->place ?>
                        </p>

                        <p class="list-card-text">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?= $singleEvent->date ?>
                        </p>
                    </div>

                    <div class="card-action">
                        <a href="index.php?id=<?= $singleEvent->id ?>&delete=true">Delete</a>
                    </div>
                </div>
            <?php } ?>
            <!-- inactivated ends -->
            <?php }} ?>
        </div>
        <!-- list section end -->
    </section>
    <!-- main section end -->

    <!-- footer section start -->
    <footer>
        <p>Developed by </p>
        <a href="mailto:ratulsikder104@gmail.com"> Ratul Sikder</a>
    </footer>
    <!-- footer section end -->

</body>

</html>