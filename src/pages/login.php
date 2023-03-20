<?php
define('BASE_URL', '../../');
define('CURRENT_FILE', basename(__FILE__));
if (session_start()) {
    session_destroy();
}
$host = '127.0.0.1';
$s_user = 'root';
$s_password = '';
$s_database = 'web_dev';
$conn = new mysqli($host, $s_user, $s_password, $s_database);

/*function user_exist($user, $table, $conn) {
    if ($conn->connect_error) {
        die("Connection Error: " .$conn->connect_error);
    }
    $query = "SELECT * FROM $table WHERE Username = '$user'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $user_exist = true;
    } else {
        $user_exist = false;
    }
    return $user_exist;
}*/
session_start();
$_SERVER['user_exist']=false;
$_SERVER['loggedIn']=false;
$user_exist;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //require('../php_functions/validate.php');
    $table = 'users';
    if ($conn->connect_error) {
        die("Connection Error: " .$conn->connect_error);
    }
    $query = "SELECT First_Name, Last_Name FROM $table WHERE Username = '$username' and Password = Password('$password')";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
        $user_exist = true;
        $row = mysqli_fetch_assoc($result);
        global $firstName,
        $lastName;
        $firstName = $row['First_Name'];
        $lastName = $row['Last_Name'];
        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = "$firstName $lastName";
        header("Location: ". BASE_URL.'src/pages/welcome.php');
        exit();
    } else {
        $user_exist = false;
    }


}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>
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
<body class="d-flex h-100 text-center flex-column">
    <header class="w-100">
        <?php
        require('../partials/navbar.php')
        ?>
    </header>
    <main class="form-signin w-100 m-auto">
        <form class="text-center" method="post" action="">
            <h1 class="h1 mb-3 fw-normal">Sign in</h1>

            <div class="form-floating">
                <input type="email" class="form-control" name="username" id="floatingInput" placeholder="name@example.com" autocomplete="off">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" name="login" type="submit">Log in</button>
            <?php
            if ($_SERVER['REQUEST_METHOD']=='POST' && !$user_exist) {
                echo("<p class = 'text-danger'>Username of password in wrong.</p>");
            }
            ?>
        </form>
    </main>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>