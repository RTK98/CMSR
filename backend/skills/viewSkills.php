<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Skills</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addSkills.php" class="btn btn-sm btn-dark">Add Skills</a>
            </div>
            <div class="btn-group me-2">
                <a href="viewEmpSkill.php" class="btn btn-sm btn-dark">Employee Skills</a>
            </div>
            <div class="btn-group me-2">
                <a href="addSkillCategory.php" class="btn btn-sm btn-dark">Add Skill Category</a>
            </div>
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-dark">Export</button>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printReport('report')">Print</button>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportReport('report', 'Vehicle Info')">Export PDF</button>
    <hr>
    <div id="report">
        <section>
            <div class="row">
                <div class="col-md-6" style='background-color: #ECE8DD;'>
                    <h5><strong>Skill List</strong></h5>
                    <div class="table-responsive" style='border: 1px solid black;'>
                        <?php
                        $db = dbconn();
                        $sql = "SELECT *,sc.CatergoryName FROM skills s LEFT JOIN skillcatergory sc ON s.SCatergory_Id=sc.SCatergoryId";
                        $result = $db->query($sql); // Run Query
                        ?>
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Skill Name</th>
                                    <th scope="col">Skill Catergory Name</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    $n = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?= $n ?></td>
                                            <td><?= $row['SkillName'] ?></td>
                                            <td><?= $row['CatergoryName'] ?></td>
                                            <td>
                                                <?php
                                                $SkillStatus = $row['Status'];
                                                $statusDescription = '';

                                                switch ($SkillStatus) {
                                                    case 1:
                                                        $statusDescription = "Active";
                                                        $statusColor = "badge bg-success btn-sm";
                                                        break;
                                                    case 0:
                                                        $statusDescription = "Deactive";
                                                        $statusColor = "badge bg-danger btn-sm";
                                                        break;
                                                }
                                                ?>
                                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                                            </td>
                                        </tr>
                                        <?php
                                        $n++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div> 
                </div>
                <div class="col-md-6" style='background-color: #E1D7C6;'>
                    <h5><strong>Skill Category List</strong></h5>
                    <div class="table-responsive" style='border: 1px solid black;'>
                        <?php
                        $db = dbconn();
                        $sql = "SELECT * FROM skillcatergory";
                        $result = $db->query($sql); // Run Query
                        ?>
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Skill Category Name</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    $n = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?= $n ?></td>
                                            <td><?= $row['CatergoryName'] ?></td>
                                            <td>
                                                <?php
                                                $SkillCatStatus = $row['Status'];
                                                $statusDescription = '';

                                                switch ($SkillCatStatus) {
                                                    case 1:
                                                        $statusDescription = "Active";
                                                        $statusColor = "badge bg-success btn-sm";
                                                        break;
                                                    case 0:
                                                        $statusDescription = "Deactive";
                                                        $statusColor = "badge bg-danger btn-sm";
                                                        break;
                                                }
                                                ?>
                                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                                            </td>
                                        </tr>
                                        <?php
                                        $n++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div> 
                </div>
                <div class="col-md-6">

                    <!--2nd Card-->

                </div>
            </div>
        </section>
    </div>
</main>
<?php include'../footer.php'; ?>
<script>
    function printReport(divid) {
        var divToPrint = document.getElementById(divid);

        var newWindow = window.open('', 'Print-Window');

        newWindow.document.open();

        newWindow.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWindow.document.close();

        setTimeout(function () {
            newWindow.close();
        }, 10);
    }
    var doc = new jsPDF();

    function exportReport(divid, title) {
        doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById('report').innerHTML + `</body></html>`);
        doc.save('div.pdf');
    }
</script>