<?php
session_start();
unset($_SESSION["login"]);
unset($_SESSION["UserID"]);
header("Location: index.php");
