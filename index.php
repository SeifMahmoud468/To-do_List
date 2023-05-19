<? header("Location: Logout.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>List-T</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            font-size: 20px;
            margin-bottom: 10px;
            text-align: center;
            opacity: 0;
            transform: translateX(-20px);
            animation: fadeIn 1.25s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        div.center {
            width: 400px;
            background-color: rgb(255, 255, 255);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="site-wrap" id="home-section">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <header class="site-navbar site-navbar-target" role="banner">

            <div class="container">
                <div class="row align-items-center position-relative">

                    <div class="col-3">
                        <div class="site-logo font-size-30">
                            <a href="index.php"><strong>List-T</strong></a>
                        </div>
                    </div>
                </div>
        </header>
        <div class="center">
            <h1 class="strong">Welcome to the To-Do List App!</h1>
            <p>This app will help you stay organized and on top of your tasks. With features like task assignment,
                priority
                setting, and collaboration with others, you'll never miss a beat!</p>
            <ul>
                <li>Create new tasks</li>
                <li>Assign tasks to collaborators</li>
                <li>Set task priorities</li>
                <li>View and edit tasks</li>
                <li>Share task lists with others</li>
                <li>Log in to access your tasks from anywhere</li>
            </ul>
            <div class="mb-3 mb-md-0">
                <a class="btn btn-primary btn-block py-3" style="margin-top: 25px;" href="signIn.php">Log in</a>
            </div>
        </div>
    </div>
    <script>
        let listItems = document.querySelectorAll('li');
        for (let i = 0; i < listItems.length; i++) {
            listItems[i].style.animationDelay = i * 0.2 + 's';
        }
    </script>
</body>

</html>