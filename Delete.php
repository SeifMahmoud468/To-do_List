<?php
require 'connection.php';
$taskID = $_GET['taskID'];
$query = "DELETE FROM `task` WHERE `taskID`= '$taskID'";
mysqli_query($conn, $query);
header("Location: Home.php");
