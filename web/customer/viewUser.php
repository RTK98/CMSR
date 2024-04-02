<?php
include'../header.php';
include'../menu.php';
?>
<main class="col-md-12 ms-sm-auto col-lg-12 px-md-12 user-main" style="background:white;">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addVehicle.php" class="btn btn-sm btn btn-dark position-relative">Add Vehicle</a>
            </div>
            <div class="btn-group me-2">
                <a href="viewVehicle.php" class="btn btn-sm btn-dark position-relative">View Vehicles</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>appointments/myAppointments.php" class="btn btn-sm btn btn-dark position-relative">My Appointments</a>
            </div>
            <div class="btn-group me-2">
                <button type="button" class="btn btn-dark position-relative">
                    Inbox
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        2
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </button> 
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <h3>   Hello <?php echo " " . $_SESSION["FirstName"] . " " . $_SESSION["LastName"] . " " ?>!</h3>
    <div>
        <div class="main-body">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>  <?php echo $_SESSION["FirstName"] . " " . $_SESSION["LastName"] ?></h4>
                                    <p class="text-secondary mb-1">Customer</p>
                                    <p class="text-muted font-size-sm">
                                        <?php
                                        $city = $_SESSION["City"];
                                        $db = dbConn();
                                        $sql = "SELECT id,name_en FROM cities WHERE id='$city'";
                                        $results = $db->query($sql);
                                        $row = $results->fetch_assoc();

                                        echo $_SESSION['HouseNo'] . "," . $_SESSION['Lane'] . "," . $_SESSION['Street'] . "," . $row['name_en'];
                                        ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">

                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $_SESSION["FirstName"] . " " . $_SESSION["LastName"] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">

                                    <?php echo $_SESSION["Email"] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $_SESSION['ContactNo'] ?>
                                </div>
                            </div>
                            <hr>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">
                                        Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $_SESSION["HouseNo"] . "," . $_SESSION["Lane"] . "," . $_SESSION["Street"] . "," . $row['name_en'] ?>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row gutters-sm">
                        <div class="col-sm-6 mb-3">
                            <!--                            <div class="card h-100">
                                                            <div class="card-body">
                                                               
                                                            </div>
                                                        </div>-->
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include'../footer.php'; ?>