





</body>
<footer style="background-color: #333; color: #fff; padding: 20px; text-align: center; position: relative;
    z-index: 1;">
    <div>
       
        <p>130A, Horahena Rd, Pannipitiya</p>
        <p>Phone: <a href="tel:+94 777 755 249">+94 777 755 249</a> </p>
        <p>Email: <a href="mail:info@replicaspeed.com">info@replicaspeed.com</a> </p>
         <p>&copy; <?php echo date("Y"); ?> Replica Speed</p>
    </div>
</footer>
</html>
<script src="<?= SYSTEM_PATH ?>assets/js/jquery.min.js"></script>
<script src="<?= SYSTEM_PATH ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?= SYSTEM_PATH ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= SYSTEM_PATH ?>assets/js/jspdf.min.js"></script>
<script src="<?= SYSTEM_PATH ?>assets/js/html2canvas.js"></script>
<script src="<?= SYSTEM_PATH ?>assets/js/feather.min.js"></script>
<script src="<?= SYSTEM_PATH ?>assets/qr_scanner/instascan.min.js"></script>
<!--  <script src="assets/js/Chart.min.js"></script>-->
<!--  <script src="assets/js/dashboard.js"></script>-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
        subMenu.classList.toggle("open-menu");
    }
</script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>

<script>

    /* globals Chart:false, feather:false */

    (() => {
        'use strict'

        feather.replace({'aria-hidden': 'true'})

        // Graphs
        const ctx = document.getElementById('myChart')
        // eslint-disable-next-line no-unused-vars
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    'January',
                    'February',
                    'March',
                    'Aprill',
                    'May',
                    'June',
                ],
                datasets: [{
                        data: [
                            153390,
                            213450,
                            184830,
                            240030,
                            234890,
                            240920

                        ],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        borderWidth: 4,
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
                    text: "Sales Report 2023",

                }
            }
        })
    })()



</script>

<script>
    var xValues = ["Complete", "InComplete"];
    var yValues = [29, 6];
    var barColors = [
        "#00D100",
        "#FF0000",
    ];

    new Chart("myChartpie", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
        },
        options: {
            title: {
                display: true,
                text: "Appointments",

            }
        }
    });
</script>

<script>

    /* globals Chart:false, feather:false */

    (() => {
        'use strict'

        feather.replace({'aria-hidden': 'true'})

        // Graphs
        const ctx = document.getElementById('myCharta')
        // eslint-disable-next-line no-unused-vars
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Sunday',
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday'
                ],
                datasets: [{
                        data: [

                            234890,
                            240030,
                            184830,
                            213450,
                            153390,
                            240920,
                            120340
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
                    text: "Last 7 days Sales",

                }
            }
        })
    })()



</script>

<script>
    var xValues = ["Good Review", "Bad Review"];
    var yValues = [30, 2];
    var barColors = [

        "#0000FF",
        "#FF0000"

    ];

    new Chart("myChart_Complaints", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
        },
        options: {
            title: {
                display: true,
                text: "Complaints"
            }
        }
    });
</script>


<!-- shopowner reports starts -->
<script>

    /* globals Chart:false, feather:false */

    (() => {
        'use strict'

        feather.replace({'aria-hidden': 'true'})

        // Graphs
        const ctx = document.getElementById('myChart1')
        // eslint-disable-next-line no-unused-vars
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    'January',
                    'February',
                    'March',
                    'Aprill',
                    'May',
                    'June',
                ],
                datasets: [{
                        data: [
                            153390,
                            213450,
                            184830,
                            240030,
                            234890,
                            240920

                        ],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        borderWidth: 4,
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
                    text: "Sales Report 2023",

                }
            }
        })
    })()



</script>

<script>
    var xValues = ["Completed", "Uncompleted"];
    var yValues = [35, 5];
    var barColors = [
        "#FAD02C",
        "#FF0000"
    ];

    new Chart("myChart2", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
        },
        options: {
            title: {
                display: true,
                text: "Daily Summery of Tasks ",

            }
        }
    });
</script>

<script>

    /* globals Chart:false, feather:false */

    (() => {
        'use strict'

        feather.replace({'aria-hidden': 'true'})

        // Graphs
        const ctx = document.getElementById('myChart3')
        // eslint-disable-next-line no-unused-vars
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'January',
                    'February',
                    'March',
                    'Aprill',
                    'May',
                    'June',
                ],
                datasets: [{
                        data: [

                            234890,
                            240030,
                            184830,
                            213450,
                            153390,
                            240920,
                            120340
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
                    text: "Monthly Sales Report",

                }
            }
        })
    })()



</script>


<script>

            /* globals Chart:false, feather:false */

                    (() => {
                        'use strict'

                        feather.replace({'aria-hidden': 'true'})

                        // Graphs
                        const ctx = document.getElementById('myChart5')
                        // eslint-disable-next-line no-unused-vars
                        const myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: [
                                    'January',
                                    'February',
                                    'March',
                                    'Aprill',
                                    'May',
                                    'June',
                                ],
                                datasets: [{
                                        data: [

                                            150000,
                                            160000,
                                            80000,
                                            140000,
                                            60000,
                                            200000,
                                            50000
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
                                    text: "Monthly Expenses Report",

                                }
                            }
                        })
                    })()



</script>

<script>

                    /* globals Chart:false, feather:false */

                            (() => {
                                'use strict'

                                feather.replace({'aria-hidden': 'true'})

                                // Graphs
                                const ctx = document.getElementById('myChart6')
                                // eslint-disable-next-line no-unused-vars
                                const myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: [
                                            'January',
                                            'February',
                                            'March',
                                            'Aprill',
                                            'May',
                                            'June',
                                        ],
                                        datasets: [{
                                                data: [

                                                    80000,
                                                    90000,
                                                    100000,
                                                    70000,
                                                    90000,
                                                    40000,
                                                    70000
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
                                            text: "Monthly Profit Report",

                                        }
                                    }
                                })
                            })()



</script>

<script>
                    var xValues = ["Men", "Women"];
                    var yValues = [55, 40];
                    var barColors = [

                        "#00aba9",
                        "#b91d47"

                    ];

                    new Chart("myChart4", {
                        type: "doughnut",
                        data: {
                            labels: xValues,
                            datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: "Reviews Report"
                            }
                        }
                    });
</script>

<script>
                    var xValues = ["Attend", "UnAttend"];
                    var yValues = [20, 2, ];
                    var barColors = [
                        "#0000FF",
                        "#FF0000"

                    ];

                    new Chart("myChart7", {
                        type: "pie",
                        data: {
                            labels: xValues,
                            datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: "Attendance Daily",

                            }
                        }
                    });
</script>





</body>

</html>



<?php ob_flush(); ?>
