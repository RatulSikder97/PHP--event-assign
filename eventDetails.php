<?php
// include config file
require_once("config/config.php");

// models object
// db: Instance of database connection
$admin = new Admin($db);
$event = new Event($db);

// Check if admin is not logged in
if (!($admin->is_logged_in())) {
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
        <nav>
            <ul>
                <?php if (isset($_SESSION["name"])) { ?>
                    <li><?= $_SESSION["name"] ?></li>
                    <li>
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                            <button name="logout">Logout</button>
                        </form>
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
                <img src="<?= $singleEventInfo->image ?>" alt=" <?= $singleEventInfo->title ?>">
                <h2 class="event-title"><?= $singleEventInfo->title ?></h2>
                <p class="event-text"><?= $singleEventInfo->description ?></p>
                <p class="event-text"><?= $singleEventInfo->place ?></p>
                <p class="event-text"><?= $singleEventInfo->address ?></p>
                <p class="event-text"><?= $singleEventInfo->status ?></p>

            <?php } ?>
        </div>
        <!-- Event  details section end -->
    </section>
    <!-- main section end -->


    <!-- footer section start -->
    <footer>

    </footer>
    <!-- footer section end -->

</body>

</html>