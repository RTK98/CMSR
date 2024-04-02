<!--session_start();-->
<?php include'../header.php'; ?>



<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == "appointment") {
    extract($_POST);
    echo $AppDatez = date('D', strtotime($AppDate));
    //thu kiyla ena data eka database eke days table ekath ekka compare krala e table eke id eka gannawa
    $sql="";

  
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Appointments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addAppointment.php" class="btn btn-sm btn-outline-secondary">Add Appointments</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <h2>Appointments</h2>'
    <div class="table-responsive" style="background-color: white;">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col"> Looking Date </th>
                    <th scope="col"> Looking Time name</th>
                    <th scope="col">Looking Time time </th>
                    <th scope="col">Booked count </th>
                    <th scope="col">Available count</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">should be appointment </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                </tr>
            </tbody>
        </table>
    </div>

    <!--    <h2>Booked Appointments </h2>'
        <div class="table-responsive" style="background-color: white;">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Appointment handling</th>
                        <th scope="col">TimeSlotId</th>
                        <th scope="col">AppointmentId</th>
                        <th scope="col">AppDate</th>
    
                    </tr>
                </thead>
                <tbody>
    
    
                    </tr>
                </tbody>
            </table>
        </div>-->

    <!--
        <h2>Appointments couting</h2>'
        <div class="table-responsive" style="background-color: white;">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Slotid</th>
                        <th scope="col">bookedcount</th>
                        <th scope="col">availablecount</th>
                        <th scope="col">Date</th>
    
                    </tr>
                </thead>
                <tbody>
    
    
                    </tr>
                </tbody>
            </table>
        </div>-->


</main>

<?php include'../footer.php'; ?>