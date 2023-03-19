<?php
define('BASE_URL', '../../');
define('CURRENT_FILE', basename(__FILE__));
if (session_start()) {
    session_destroy();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

@media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* padding-top: 40px;
  padding-bottom: 40px; */
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

    </style>
</head>
<body class="d-flex h-100 flex-column">
    <header class="w-100">
        <?php
        require('../partials/navbar.php')
        ?>
    </header>
    <main class="form-signin w-100 m-auto">



        <form method="post" action="">
            <h1 class="h1 mb-3 fw-normal text-center">Register Here</h1>
            <div class="row">
                <div class="col">
                    <input type="text" required class="form-control" placeholder="First name" name="firstName" aria-label="First name">
                </div>
                <div class="col">
                    <input type="text" required class="form-control" placeholder="Last name" name="lastName" aria-label="Last name">
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" required class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">
                        This email is your Username.
                    </div>
                </div>
                <div class="row" style="width:100% !important;">
                    <div class="col">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" required class="form-control" name="password" id="exampleInputPassword1">
                    </div>
                </div>
                <div class="row" style="width:100% !important;">
                    <div class="col">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" required class="form-control" name="confPassword" id="exampleInputPassword1">
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary col-6" name="register">Register</button>
                </div>

                <?php
                require('../php_functions/validate.php');
                if (isset($_REQUEST['register'])) {
                    $fname = $_POST['firstName'];
                    $lname = $_POST['lastName'];
                    $username = $_POST['email'];
                    $pswd = $_POST['password'];
                    $conf_pswd = $_POST['confPassword'];
                    if ($pswd == $conf_pswd) {
                        //echo("<p class='text-success'>Password matched!</p>");
                        $table = 'users';
                        if (user_exist($username, $table, $conn)) {
                            die("<p class='text-danger'>Username Already exists.</p>");
                        } else
                        {
                            if ($conn->connect_error) {
                                die("<p class='text-danger'>Connection error</p>" . $conn->connect_error);
                            } else
                            {
                                $push_usr = "INSERT INTO $table (First_Name,Last_Name,Username,Password) VALUES ('$fname','$lname','$username',Password('$pswd'))";
                                if ($conn->query($push_usr)) {
                                    echo "<p class='text-success'>You are registered successfully</p>";
                                    $conn->close();
                                    die();
                                } else
                                {
                                    die('Some error');
                                }
                            }
                        }
                    } else {
                        die("<p class='text-danger'>Password didn't matched in both fields. Please re-enter the password.</p>");
                    }
                }
                ?>
            </form>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>