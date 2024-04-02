<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Customer</h1>
    </div>
    <form id="form_customer" method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <label>Enter Customer Name</label>
        <input type="text" name="customer_name" id="customer_name">
        <label>Select District</label>
        <?php
        $db = dbConn();
        $sql = "SELECT * FROM tbl_district";
        $result = $db->query($sql);
        ?>
        <select name="district" id="district" onchange="loadCity()">
            <option value="">--</option>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
            <option value="<?= $row['district_code'] ?>"><?= $row['district_name'] ?></option>
            <?php
                }
            }
            ?>
        </select>
        <div id="city_list">

        </div>

    </form>
    <button type="button" onclick="openModel()">Open My Model</button>
    <div class="modal fade" id="citylist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="content"></div>
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
function loadCity() {
    var formData = $('#form_customer').serialize();
    $.ajax({
        type: 'POST',
        url: 'citylist.php',
        data: formData,
        success: function(response) {
            $('#content').html(response);
            $('#citylist').modal('show');
        },
        error: function() {
            alert('Error submitting the form!');
        }
    });
}

function openModel() {
    $('#citylist').modal('show');
}
</script>