<?php // $appointment = "active" ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Reports Management</h1>
        <div class="btn-group ">
            <a href="<?= SYSTEM_PATH ?>report/appointments.php" class="btn btn-sm btn-dark">Appointment</a>
        </div>
        <div class="btn-group">
            <a href="<?= SYSTEM_PATH ?>report/stocks.php" class="btn btn-sm btn-dark">Stocks</a>
        </div>
        <div class="btn-group ">
            <a href="<?= SYSTEM_PATH ?>report/task.php" class="btn btn-sm btn-dark">Tasks</a>
        </div> <div class="btn-group ">
            <a href="<?= SYSTEM_PATH ?>report/sales.php" class="btn btn-sm btn-dark">Sales</a>
        </div>
    </div>



</main>
<?php include'../footer.php'; ?>
<script>
    function printReport(divid) {
        var divToPrint = document.getElementById(divid);

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);
    }
    var doc = new jsPDF();
    function exportReport(divId, title) {
        doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
        doc.save('div.pdf');
    }
</script>