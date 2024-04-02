<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $_SESSION["FirstName"] ?>'s Dashboard </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <?php
    $adddate = date("Y-m-d");
    $maxDate = date("Y-m-d", strtotime("-1 days"));
    $addeduser = $_SESSION['userId'];
    $db = dbconn();
    $sql = " SELECT * FROM empattendance empat WHERE empat.Date='2023-08-02' AND empat.CheckingTime IS NOT NULL AND empat.CheckOutTime IS NULL;";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $EmpId = $row['EmpId'];
            $ClosedTime = $row['ClosedTime'];

            $sqlUpdateAtt = "UPDATE empattendance SET CheckOutTime='$ClosedTime' WHERE EmpId='$EmpId'";
            $db->query($sqlUpdateAtt);
        }
    }
    ?>
                <!--    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>-->
    <h2>Reports</h2>

    <div class="row">
        <div class="col-md-12"><canvas id="profitmonth"></canvas></div>

    </div>
    <div class="row">
        <div class="col-md-6"><canvas id="myChart6"></canvas></div>
        <div class="col-md-6"><canvas id="myChartpie"></canvas></div>
    </div>

    <div class="row">
        <div class="col-md-6"><canvas id="myChart7"></canvas></div>
        <div class="col-md-6"><canvas id="myChart2"></canvas></div>
    </div>
    <div class="row">
        <div class="col-md-6"><canvas id="myChart4"></canvas></div>
        <div class="col-md-6"><canvas id="myChart_Complaints"></canvas></div>
    </div>
    
    
    
     <?php
//        SELECT COUNT( o.orderID),o.customerId,c.Gender  FROM tbl_orders o INNER JOIN tbl_customers c on o.customerId= c.CustomerId GROUP BY c.Gender;
        $sqlsale = "SELECT SUM(TotalRepairProfit), MONTH(AddDate), monthname(AddDate)FROM job_cards GROUP BY MONTH(AddDate)";
        $db = dbConn();
        $resultsale = $db->query($sqlsale);

        $data_label1 = array();
        $data_value1 = array();

        while ($rowsale = $resultsale->fetch_assoc()) {
            $data_label1[] = $rowsale['SUM(TotalRepairProfit)'];
            $data_value1[] = $rowsale['monthname(AddDate)'];
        }
       echo  "'" . implode("','", $data_value1) . "'";
       echo  implode(",", $data_label1);
        ?>
    

</main>
<?php include'footer.php'; ?>

<script>

    /* globals Chart:false, feather:false */

    (() => {
    'use strict'

            feather.replace({ 'aria-hidden': 'true' })

            // Graphs
            const ctx = document.getElementById('profitmonth')
            // eslint-disable-next-line no-unused-vars
            const myChart = new Chart(ctx, {
            type: 'bar',
                    data: {
                    labels: [
<?= "'" . implode("','", $data_value1) . "'" ?>
                    ],
                            datasets: [{
                            data: [


<?= implode(",", $data_label1) ?>
                            ],
                                    lineTension: 0,
                                    backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                            'rgb(255, 205, 86)',
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                            'rgb(54, 162, 235)',
                                            'rgb(255, 205, 86)'
                                    ],
                                    borderColor: '#007bff',
                                    borderWidth: 2,
                                    pointBackgroundColor: '#007bff'
                            }]
                    },
                    options: {
                    scales: {
                    yAxes: [{
                    ticks: {
                    beginAtZero: false
                    }
                    }]
                    },
                            legend: {
                            display: false
                            }, title: {
                    display: true,
                            text: "Month wise Profit",
                    }
                    }
            })
    })()



</script>