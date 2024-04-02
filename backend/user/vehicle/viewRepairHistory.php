<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Appointments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" onclick="history.back()" class="btn btn-primary">Back</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Print
            </button>
        </div>
    </div>
    <h2>My Job Card</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Appoinment No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Vehicle No</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Time Slot</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>202305181402684869</td>
                    <td>1</td>
                    <td>CCA-1234</td>
                    <td>2023-05-18</td>
                    <td>1</td>
                    <td>Full Service</td>
                    <td>
                        <form method='post' action="../jobCard/addJobCard.php">

                            <input type="hidden" name="AppointmentId" value="<?= @$row['AppointmentId'] ?>">
                            <button type="submit" class="btn btn-success" name="action" value="edit">View Job Card
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
<?php include'../../footer.php'; ?>