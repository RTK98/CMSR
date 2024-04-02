<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Vehicles</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="../customer/viewUser.php" class="btn btn-sm btn-outline-secondary">Add Vehicle</a>
            </div>
        </div>
    </div>
    <h2>Vehicles</h2>
    <div class="row">
        <div class="col-md-4">  
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= SYSTEM_PATH ?>assets/img/car.jpg" class="card-img" alt="vehicleImage">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Mithsubishi Evolution X</h5>
                            <h6>CCA-1234</h6>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group me-2">
                                    <a href="viewVehicleDetails.php" class="btn-sm btn btn-primary">View Details</a>
                                </div>
                                <div class="btn-group me-2">
                                    <a href="viewAppointment.php" class="btn-sm btn btn-success">Appointment History</a>
                                </div>
                                <div class="btn-group me-2">
                                    <a href="viewRepairHistory.php" class="btn-sm btn btn-warning">Repair History</a>
                                </div>
                                <div class="btn-group me-2">
                                    <a href="#" class="btn-sm btn btn-danger">Delete Vehicle</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">  
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= SYSTEM_PATH ?>assets/img/car.jpg" class="card-img" alt="vehicleImage">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Mithsubishi Evolution IX</h5>
                            <h6>CCA-1234</h6>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group me-2">
                                    <a href="../customer/viewUser.php" class="btn-sm btn btn-primary">View Details</a>
                                </div>
                                <div class="btn-group me-2">
                                    <a href="../customer/viewUser.php" class="btn-sm btn btn-success">Appointment History</a>
                                </div>
                                <div class="btn-group me-2">
                                    <a href="../customer/viewUser.php" class="btn-sm btn btn-warning">Repair History</a>
                                </div>
                                <div class="btn-group me-2">
                                    <a href="../customer/viewUser.php" class="btn-sm btn btn-danger">Delete Vehicle</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">  
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= SYSTEM_PATH ?>assets/img/car.jpg" class="card-img" alt="vehicleImage">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Mithsubishi Evolution VIII</h5>
                            <h6>CCA-1234</h6>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group me-2">
                                    <a href="../customer/viewUser.php" class="btn-sm btn btn-primary">View Details</a>
                                </div>
                                <div class="btn-group me-2">
                                    <a href="../customer/viewUser.php" class="btn-sm btn btn-success">Appointment History</a>
                                </div>
                                <div class="btn-group me-2">
                                    <a href="../customer/viewUser.php" class="btn-sm btn btn-warning">Repair History</a>
                                </div>
                                <div class="btn-group me-2">
                                    <a href="../customer/viewUser.php" class="btn-sm btn btn-danger">Delete Vehicle</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<?php include'../../footer.php'; ?>