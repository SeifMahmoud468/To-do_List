<?php
session_start();
require 'connection.php';
if (!isset($_SESSION['UserID'])) {
    header("Location: index.php");
}
if (isset($_POST["add"])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $date1 = date_create($_POST["dueDate"]);
    $dueDate = date_format($date1, "Y-m-d");
    $Id = $_SESSION['UserID'];
    $description = mysqli_real_escape_string($conn, $description);
    $query5 = "INSERT INTO `task`(`UserID`, `dueDate`, `priority`, `title`, `description`) VALUES ('$Id','$dueDate','$priority','$title','$description')";
    mysqli_query($conn, $query5);
    header("Location: Home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>List-T</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        form {
            width: 400px;
        }

        .styling {
            background-color: rgb(255, 255, 255);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
            min-height: 680px;
            max-height: 680px;
        }

        form * {
            color: #000000;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 40px;
            text-align: center;
            color: #000000;
        }

        h4 {
            max-height: 32px;
            overflow: hidden;
        }

        label {
            display: block;
            margin-top: 8px;
            font-size: 16px;
            font-weight: 500;
        }

        form input,
        .input {
            display: block;
            height: 45px;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 5px;
            font-size: 14px;
            font-weight: 300;
            font-family: inherit;
            color: #000000;
        }

        ::placeholder {
            color: #000000;
            text-align: start;
        }

        input:focus {
            background-color: rgba(226, 226, 226, 0.67);
        }

        .link {
            text-align: center;
            margin: 10px 0px;
        }

        .link-sub {
            color: blue;
        }

        #my-div {
            max-height: 450px;
            min-height: 450px;
            overflow-y: auto;
        }

        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .task {
            flex: 0 0 32%;
            box-sizing: border-box;
            min-height: fit-content;
            max-height: 310px;
            padding: 10px 5px;
            overflow-y: hidden;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .bg-ccc {
            background-color: #eee !important;
        }

        .des {
            min-height: 90px;
            max-height: 90px;
            text-overflow: ellipsis;
            overflow-y: hidden;
        }
    </style>
</head>

<body class="bg-light overflow-hidden m-0">
    <div class="site-wrap" id="home-section">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>
        <header class="site-navbar site-navbar-target" role="banner" style="transform: scale(1.2);">
            <div class="container">
                <div class="row align-items-center position-relative">

                    <div class="col-3">
                        <div class="site-logo">
                            <a href="index.php"><strong>List-T</strong></a>
                        </div>
                    </div>

                    <div class="col-9  text-right">
                        <span class="d-inline-block d-lg-none"><a href="#" class=" site-menu-toggle js-menu-toggle py-5 "><span class="icon-menu h3 text-black"></span></a></span>
                        <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav ml-auto ">
                                <li class="active"><a href="Home.php" class="nav-link"><strong>Home</strong></a></li>
                                <li><a href="SharedTask.php" class="nav-link">Shared Tasks</a></li>
                                <?php
                                $Id = $_SESSION['UserID'];
                                $query = "SELECT * FROM user WHERE UserID='$Id'";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                $fname = $row["FirstName"];
                                echo "<li><span class='icon-user-o'></span> $fname</li>";
                                echo "<li><a href='Logout.php' class='nav-link'>Logout </a><span class='icon-sign-out'></span></li>";
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <section class="site-section bg-light container-lg mt-5 pb-6">
            <div class="row m-0">
                <div class="col ml-4 mr-1">
                    <form class="styling" action=" " method="post">
                        <h3>Add Task</h3>

                        <label for="title">Title</label>
                        <input type="text" placeholder="title" id="title" name="title" minlength="1" maxlength="20" required>

                        <label for="description">Description</label>
                        <textarea class="input" type="text" minlength="0" maxlength="255" placeholder="description" id="description" name="description" style="height: 200px;max-height: 200px !important;" class="text-start"></textarea>

                        <div class="row">
                            <div class="col-3 mr-3">
                                <label for="priority">Priority:</label>
                                <select id="priority" name="priority" style="height: 55px;">
                                    <option value="urgent">Urgent</option>
                                    <option value="important">Important</option>
                                    <option value="normal">Normal</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>

                            <div class="col-7 ml-3">
                                <label for="dueDate">Due Date</label>
                                <input type="date" id="cf-3" class="form-control datepicker px-3" name="dueDate" id="dueDate" require>
                            </div>
                        </div>
                        <div class="my-3 mb-md-0  w-100">
                            <input type="submit" class='btn btn-primary btn-block py-3' style="height: 55px;" value="Add Task" name="add">
                        </div>
                    </form>
                </div>
                <div class="col-8 styling ml-1 mr-4">
                    <h3 class="text-start">Tasks</h3>
                    <div class="row" id="my-div">
                        <?php
                        $Id = $_SESSION['UserID'];
                        $query2 = "SELECT * FROM `task` WHERE `UserID`= '$Id';";
                        $rows = mysqli_query($conn, $query2);
                        ?>
                        <?php foreach ($rows as $row) : ?>
                            <div class="col-md-5 col-lg-4 task mb-4 p-1 mx-1 bg-ccc">
                                <div class="listing d-block  align-items-stretch p-2 bg-ccc mb-0">
                                    <div class="listing-contents h-100 bg-ccc">
                                        <h4 class="text-capitalize bg-ccc text-start" style="color: #000000;"><strong><?php echo $row['title'] ?></strong></h4>
                                        <p class="des"><?php echo $row['description'] ?></p>
                                        <div class="d-block d-md-flex justify-content-between mb-3 border-bottom pb-3">
                                            <div class="listing-feature pr-4">
                                                <span class="caption w-100">Due Date: </span>
                                                <br>
                                                <span class="text"><?php echo $row['dueDate'] ?></span>
                                            </div>
                                            <div class="listing-feature pr-4">
                                                <span class="caption">Priority:</span>
                                                <br>
                                                <span class="text text-capitalize"><?php echo $row['priority'] ?></span>
                                            </div>
                                        </div>
                                        <?php echo "<div><a href='Delete.php?taskID=$row[taskID]' class='btn btn-primary btn-sm w-100'>Completed</a></div>" ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
        </section>

    </div>
</body>

</html>