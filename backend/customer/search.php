<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Customer</h1>

    </div>
    <form id="form_customer" method="post"  action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <label>Enter NIC No.</label>
        <input type="text" name="NIC" id="NIC" onchange="loadCustomerName()">
        <label>Customer Name</label>
        <input type="text" name="FirstName" id="FirstName">
    </form>
</main>
<?php include '../footer.php'; ?>
<script>
    function loadCustomerName() {
        var formData = $('#form_customer').serialize();
        $.ajax({
            type: 'GET',
            url: 'search_customer.php',
            data: formData,
            success: function (response) {
                $('#FirstName').val(response);
               
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });

    }
</script>