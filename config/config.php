<?php
// start session
session_start();

// include DATABASE
require_once("Database.php");

// include model
require_once("Model/Event.php");
require_once("Model/Admin.php");


// get database connection
$database = new Database();
$db = $database->connect();

// variables
$msg = "";

// // instantiate model
// $admin = new Admin($db);
// $event = new Event($db);



?>