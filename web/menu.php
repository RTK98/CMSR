<nav>
    <div class="logo">
        <img src="<?= SYSTEM_PATH ?>assets/img/logo.png" alt="logo">
        <span>Replica Speed</span>
    </div>
    <ul class="home-nav" >
        <li><a class='<?= @$home ?>' href="<?= SYSTEM_PATH ?>index.php" >Home</a></li>
<!--                    <li><a href="<?= SYSTEM_PATH ?>about.php" class=" active">About</a></li>-->
        <li><a class='<?= @$Service ?>' href="<?= SYSTEM_PATH ?>services.php">Services</a></li>
<!--                    <li><a href="<?= SYSTEM_PATH ?>appointments/addAppointment.php">Schedule</a></li>-->
        <li><a class='<?= @$Gallery ?>' href="<?= SYSTEM_PATH ?>gallery.php">Gallery</a></li>
<!--                    <li><a href="<?= SYSTEM_PATH ?>">Blog</a></li>-->
        <li><a class='<?= @$Contact ?>' href="<?= SYSTEM_PATH ?>contactus.php">Contact</a></li>


        <li>
            <?php if (!isset($_SESSION['CustomerID'])) { ?>

                <a href="<?= SYSTEM_PATH ?>customer/login.php"">Login</a></li> <?php }
            ?>

        <!--                    <li>-->
        <?php // if (isset($_SESSION['CustomerID'])) { ?>

        <!--                            <a href="customer/logout.php">Log out</a></li>-->
        <?php // }
        ?>

        <li>
            <?php if (isset($_SESSION['CustomerID'])) { ?>
                <div class="navbar-nav">
                    <nav>
                        <img src="<?= SYSTEM_PATH ?>assets/img/user.png" class="user-pic" onclick="toggleMenu()">
                        <div class="sub-menu-wrap" id="subMenu">
                            <div class="sub-menu">
                                <div class="user-info">
                                    <img src="<?= SYSTEM_PATH ?>assets/img/user.png" alt="Bootstrappin'">
                                    <h3><?= $_SESSION["FirstName"] ?><?= $_SESSION["LastName"] ?></h3>
                                </div>
                                <hr>
                                <a href="<?= SYSTEM_PATH ?>customer/viewUser.php"" class="sub-menu-link">
                                    <img src="<?= SYSTEM_PATH ?>assets/img/profile.png">
                                    <p>My Profile</p>
                                    <span>></span>
                                </a>
                                <a href="<?= SYSTEM_PATH ?>customer/logout.php" class="sub-menu-link">
                                    <img src="<?= SYSTEM_PATH ?>assets/img/logout.png">
                                    <p>Log out</p>
                                    <span>></span>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </li> <?php }
            ?>
    </ul>
</nav>