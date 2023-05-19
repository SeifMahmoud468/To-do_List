<?php
session_start();
require 'connection.php';
if (!isset($_SESSION['UserID'])) {
    header("Location: index.php");
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
            width: 327px;
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
            max-height: 270px;
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
                                <li><a href="Home.php" class="nav-link">Home</a></li>
                                <li class="active"><a href="SharedTask.php" class="nav-link"><strong>Shared Tasks</strong></a></li>
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
                    <div class="styling" style="width: fit-content !important;">
                        <form action=" " method="post">
                            <h3>Assign Task</h3>
                            <?php if ((!isset($_POST["show"])) || (isset($_POST["clear"]))) : ?>
                                <?php
                                if ((isset($_POST["clear"]))) {
                                    unset($_SESSION["taskID"]);
                                }
                                ?>
                                <label for="title">Title</label>
                                <select class="input" id="title" name="title" style="height: 55px;">
                                    <?php
                                    $Id = $_SESSION['UserID'];
                                    $query2 = "SELECT * FROM `task` WHERE `UserID`= '$Id';";
                                    $rows = mysqli_query($conn, $query2);
                                    ?>
                                    <?php foreach ($rows as $row) : ?>
                                        <option value=<?php echo "$row[taskID]"; ?> class="text-capitalize" style="font-size:  18px;"><?php echo $row['title'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="my-3 mb-md-0">
                                    <div class="d-md-flex justify-content-around">
                                        <input type="submit" class='btn btn-primary btn-block py-3 mt-1' style="height: 55px; max-width: 160px;" value="Add Task" name="show">
                                        <input type="submit" class='btn btn-primary btn-block py-3 mt-1' style="height: 55px; max-width: 160px;" value="Clear Selection" name="clear">
                                    </div>
                                </div>
                                <label for="description">Description</label>
                                <p class="input m-0" id="description" name="description" style="height: 55px;max-height: 143px !important; overflow: hidden;" class="text-start">
                                    Description
                                </p>

                                <div class="row">
                                    <div class="col-3 mr-3">
                                        <label for="priority">Priority:</label>
                                        <span class="text-capitalize" id="priority" name="priority" style="height: 55px;">Not Define</span>
                                    </div>

                                    <div class="col-7 ml-3">
                                        <label for="dueDate">Due Date</label>
                                        <span name="dueDate" id="dueDate">dd/mm/yyyy</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php
                            if (isset($_POST["show"])) : ?>
                                <?php
                                if (isset($_POST['title'])) {
                                    $_SESSION['title'] = $_POST['title'];
                                }
                                $taskID = $_SESSION['title'];
                                $query = "SELECT * FROM `task` WHERE `taskID`= '$taskID';";
                                $tasks = mysqli_query($conn, $query);
                                mysqli_data_seek($tasks, 0);
                                $first_task = mysqli_fetch_assoc($tasks);
                                $_SESSION["taskID"] = $first_task['taskID'];
                                ?>
                                <label for="title">Title</label>
                                <select class="input" id="title" name="title" style="height: 55px;" disabled>
                                    <option value=<?php echo "$first_task[taskID]"; ?> class="text-capitalize" style="font-size:  18px;"><?php echo $first_task['title'] ?></option>
                                </select>
                                <div class="my-3 mb-md-0">
                                    <div class="d-md-flex justify-content-around">
                                        <input type="submit" class='btn btn-primary btn-block py-3 mt-1' style="height: 55px; max-width: 160px;" value="Add Task" name="show">
                                        <input type="submit" class='btn btn-primary btn-block py-3 mt-1' style="height: 55px; max-width: 160px;" value="Clear Selection" name="clear">
                                    </div>
                                </div>

                                <label for="description">Description</label>
                                <p class="input m-0" id="description" name="description" style="height: 55px;max-height: 143px !important; overflow: hidden;" class="text-start">
                                    <?php echo $first_task["description"]; ?>
                                </p>

                                <div class="row">
                                    <div class="col-3 mr-3">
                                        <label for="priority">Priority:</label>
                                        <span class="text-capitalize" id="priority" name="priority" style="height: 55px;"><?php echo $first_task['priority']; ?></span>
                                    </div>

                                    <div class="col-7 ml-3">
                                        <label for="dueDate">Due Date</label>
                                        <span name="dueDate" id="dueDate"><?php echo $first_task['dueDate']; ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </form>
                        <form action=" " method="post">
                            <label for="email">Collaborator Email</label>
                            <input type="email" placeholder="Email" id="email" name="email" required>
                            <div class="my-3 mb-md-0  w-100">
                                <input type="submit" class='btn btn-primary btn-block py-3' style="height: 55px;" value="Assign Task" name="assign">
                            </div>
                            <?php
                            if (isset($_POST["assign"])) {
                                $email = $_POST["email"];
                                $founded = mysqli_query($conn, "SELECT * FROM User WHERE email ='$email'");
                                if (mysqli_num_rows($founded) != 0) {
                                    mysqli_data_seek($founded, 0);
                                    $first = mysqli_fetch_assoc($founded);
                                    if (isset($_SESSION["taskID"])) {
                                        $check_query = mysqli_query($conn, "SELECT * FROM `collaborate_task` WHERE `UserID` = '$first[UserID]' AND `taskID` = '$_SESSION[taskID]' ");
                                        if (mysqli_num_rows($check_query) == 0) {
                                            $query = "INSERT INTO `collaborate_task` (`UserID`, `taskID`) VALUES ('$first[UserID]', '$_SESSION[taskID]');";
                                            mysqli_query($conn, $query);
                                            echo '<p class="font-size-15 text-center"><strong class="text-success">Task was assigned Successfully</strong></p>';
                                        } else {
                                            echo '<p class="font-size-15 text-center"><strong class="text-danger">This task was added before for this user</strong></p>';
                                        }
                                    } else {
                                        echo '<p class="font-size-15 text-center"><strong class="text-danger">Select Task First</strong></p>';
                                    }
                                } else {
                                    echo '<p class="font-size-15 text-danger text-center"><strong class="text-danger">Username is wrong, please try again</strong></p>';
                                }
                                unset($_SESSION["taskID"]);
                            }
                            ?>
                        </form>
                    </div>
                </div>
                <div class="col-8 styling ml-1 mr-4">
                    <h3 class="text-start">Shared Tasks With You</h3>
                    <div class="row" id="my-div">
                        <?php
                        $Id = $_SESSION['UserID'];
                        $query2 = "SELECT * FROM `collaborate_task` WHERE `UserID`= '$Id';";
                        $rows1 = mysqli_query($conn, $query2);
                        ?>
                        <?php foreach ($rows1 as $row1) : ?>
                            <?php
                            $query = "SELECT * FROM `task` WHERE `taskID`= '$row1[taskID]';";
                            $rows = mysqli_query($conn, $query);
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
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
        </section>

    </div>
</body>

</html>