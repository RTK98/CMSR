<?php
// include '../config.php';
// include '../function.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    extract($_POST);
    $message = array();
    if (empty($nic)) {
        $message['error_nic'] = "The NIC should not be blank";
    }
    if (empty($address)) {
        $message['error_address'] = "The Address not be blank";
    }
    if (empty($message)) {
        $db = dbConn();
        $sql = "INSERT INTO tbl_customers(nic,name,address) VALUES('$nic','$cust_name','$address')";
        $db->query($sql);
        $message['msg'] = "Data Saved..!";
        $data = array('status' => true, 'error' => $message);
    } else {
        $data = array('status' => false, 'error' => $message);
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Customer</h1>
    </div>
    <button type="button" onclick="openModel()">Open My Model</button>
    <div class="modal fade" id="regcust" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_customer" method="post"  action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                        <div class="form-group">
                            <label>Enter NIC No.</label>
                            <input type="text" name="nic" id="nic" class="form-control border border-1 border-dark">
                            <div id="error_nic" class="text-danger"></div>
                        </div>
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" name="cust_name" id="cust_name" class="form-control border border-1 border-dark">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" id="address" class="form-control border border-1 border-dark">
                            <div id="error_address" class="text-danger"></div>
                        </div>
                        <button type="button" onclick="saveCustomer()" class="btn btn-success mt-2">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</main>

<?php include '../footer.php'; ?>
<script>
    function saveCustomer() {
        var formData = $('#form_customer').serialize();

        $.ajax({
            type: 'POST',
            url: $('#form_customer').attr('action'),
            data: formData,
            dataType: 'json',
            success: function (response) {

                if (response.status) {
                    $('#error_nic').html('');
                    $('#error_address').html('');
                } else {
                    $('#error_nic').html(response.error.error_nic);
                    $('#error_address').html(response.error.error_address);
                }
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });

    }
    function openModel() {
        $('#regcust').modal('show');
    }
</script>