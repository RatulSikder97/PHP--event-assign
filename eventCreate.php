<?php
// include config file
require_once("config/config.php");

// admin object
$admin = new Admin($db);

// Check if admin is not logged in
if (!($admin->is_logged_in())) {
    $admin->redirect('adminLogin.php');
}

// btn handle
if (isset($_REQUEST['createEvent'])) {

    // prepare user object
    $event = new Event($db);

    // set user property values
    $event->adminId = $_SESSION['id'];
    $event->title = $_REQUEST['title'];
    $event->description = $_REQUEST['description'];
    //$this->image = $_REQUEST['image'];
    $event->place = $_REQUEST['place'];
    $event->address = $_REQUEST['address'];
    $event->date = $_REQUEST['date'];
    $event->status = $_REQUEST['status'];


    // image upload path
    // image file 
    $imageName = $_FILES['image']['tmp_name'];
    // image upload
    $uploadDir = 'uploads/';
    $targetFile = $uploadDir . $_FILES['image']['name'];

    //  set image file name
    $event->image = $targetFile;



    // create the user
    if ($event->create()) {
        move_uploaded_file($imageName, $targetFile);
        header('Location: index.php');
    } else {
        echo "Error happened";
    }
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


    <title>Assignment- Event Create</title>
</head>

<body>
    <!-- header section start -->
    <header>
        <a href="index.php" class="logo">
            <h1 class="title">EVENT ASSIGNMENT</h1>
        </a>
        <!-- <a href="eventCreate.php" class="btn btn-blue create-event">Create A New Event</a> -->
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
        <!-- register section start -->
        <div class="form-section">
            <h2 class="form-title">Create New Event</h2>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="submit-form" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter Event Title" required>
                </div>

                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea type="tex" name="description" id="description" placeholder="Enter description" cols="30"
                        rows="10" required></textarea>

                    <!-- <input type="tex" name="description" id="description" placeholder="Enter description" required> -->
                </div>

                <div class="input-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" required>
                </div>

                <div class="input-group">
                    <label for="place">Place Name</label>
                    <input type="text" name="place" id="place" placeholder="Enter Event Place Name" required>
                </div>

                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter Event Address" required>
                </div>

                <div class="input-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" required>
                </div>

                <div class="input-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="center">
                    <button class="btn btn-green" type="submit" name="createEvent">Create Event</button>
                </div>


            </form>
        </div>
        <!-- register section end -->
    </section>
    <!-- main section end -->


    <!-- footer section start -->
    <footer>

    </footer>
    <!-- footer section end -->

</body>

</html>