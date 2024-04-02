<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="<?= SYSTEM_PATH ?>index.php">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>inspection/manager_supervisor/viewInspection.php">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Inspections
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>products/category/view.php">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Product Category Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>products/viewProducts.php">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Products Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>order/requesting/viewMyReqItems.php">
                    <span data-feather="shopping-bag" class="align-text-bottom"></span>
                    Order
                </a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>jobCard/viewJobCardAlerts.php">
                    <?php
                    $db = dbconn();
                    $sql = "SELECT * FROM jobcardalerts WHERE Status='1'";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        $AlertCount = $result->num_rows;
                    } else {
                        $AlertCount = 0;
                    }
                    ?>
                    <span data-feather="alert-octagon" class="align-text-bottom"></span>
                    Job Completed Supervision Alerts <span style="
                                                               background-color: black;
                                                               color: white;
                                                               margin-left: 3px;
                                                               font-weight: bold;
                                                               padding: 3px;
                                                               border-color: white;
                                                               border-radius: 75%;
                                                               border-width: 5px;
                                                               text-align: center;"><?= $AlertCount ?></span>
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="<?= SYSTEM_PATH ?>jobCard/viewJobCardSupervisor.php">
                        <span data-feather="settings" class="align-text-bottom"></span>
                        Job Cards
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= SYSTEM_PATH ?>jobCard/viewJobCardRepairTech.php">
                        <span data-feather="settings" class="align-text-bottom"></span>
                        Completed Job Cards
                    </a>
                </li>
            </ul>

        </div>
    </nav>