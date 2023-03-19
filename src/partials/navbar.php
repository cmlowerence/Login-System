<nav class="navbar navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="<?php echo BASE_URL ?>src/img/logo.png" alt="Bootstrap" width="30" height="24"> N_Level
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel text-success">N_Level</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3" style="gap:1rem;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL ?>">Home</a>
                    </li>
                    <?php
                    if (CURRENT_FILE != 'register.php'||CURRENT_FILE!='welcome.php') {
                        echo('                    <li class="nav-item">
                        <a class=" btn btn-success" href="'.BASE_URL.'src/pages/register.php">Sign Up</a>
                    </li>');
                    }
                    ?>

                    <?php
                    if (CURRENT_FILE != 'login.php'|| CURRENT_FILE!='welcome.php') {
                        echo('                    <li class="nav-item">
                        <a class="btn btn-success" href="'.BASE_URL.'src/pages/login.php">Log In</a>
                    </li>');
                    }
                    ?>

                    <?php
                    if (CURRENT_FILE == 'welcome.php') {
                        //$base = BASE_URL;
                        echo(' <li class="nav-item">
                        <a class="btn btn-warning" href="'.BASE_URL.'">Log Out</a>
                    </li>');
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</nav>