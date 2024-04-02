<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link " href="<?= SYSTEM_PATH ?>index.php">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= @$attend ?>" href="<?= SYSTEM_PATH ?>attendance/viewAttandance.php">
                    <span data-feather="user-x" class="align-text-bottom"></span>
                    Employee Attendance
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= @$Skills ?>" href="<?= SYSTEM_PATH ?>skills/ViewEmpSkill_Task.php">
                    <span data-feather="sun" class="align-text-bottom"></span>
                    Employee Skills & Task
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= @$appointment ?>" href="<?= SYSTEM_PATH ?>appointments/viewAppointment.php">
                    <span data-feather="book-open" class="align-text-bottom"></span>
                    Appointments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= @$viewTasks ?>" href="<?= SYSTEM_PATH ?>tasks/viewTasks.php">
                    <span data-feather="book-open" class="align-text-bottom"></span>
                    Tasks
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= @$Service ?>" href="<?= SYSTEM_PATH ?>serviceType/ViewServiceType.php">
                    <span data-feather="tool" class="align-text-bottom"></span>
                    Service Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= @$Vehicle ?>" href="<?= SYSTEM_PATH ?>vehicle_catergory/viewVehicleCatergory.php">
                    <span data-feather="settings" class="align-text-bottom"></span>
                    Vehicle Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= @$Category ?>" href="<?= SYSTEM_PATH ?>products/category/view.php">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Product Category Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= @$Products ?>" href="<?= SYSTEM_PATH ?>products/viewProducts.php">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Products Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= @$Products ?>" href="<?= SYSTEM_PATH ?>questions/faq.php">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    FAQ Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= @$Products ?>" href="<?= SYSTEM_PATH ?>questions/questions.php">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Question Management
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= @$Department ?>" href="<?= SYSTEM_PATH ?>services/categories.php">
                    <span data-feather="share-2" class="align-text-bottom"></span>
                    services Management
                </a>
            </li>
            <!--            <li class="nav-item">
                            <a class="nav-link" href="<?= SYSTEM_PATH ?>jobCard/viewJobCard.php">
                                <span data-feather="shopping-cart" class="align-text-bottom"></span>
                                Job Card Mangment
                            </a>
                        </li>-->
            <li class="nav-item">
                <a class="nav-link <?= @$inspection ?>" href="<?= SYSTEM_PATH ?>inspection/manager_supervisor/viewInspection.php">
                    <span data-feather="file" class="align-text-bottom"></span>
                    inspection Management
                </a>
            </li>
            <li class="nav-item <?= @$Repair ?>">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>repair/repairCatergory/viewRepairs.php">
                    <span data-feather="list" class="align-text-bottom"></span>
                    Repair Management
                </a>
            </li>
            <li class="nav-item <?= @$Holiday ?>">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>holiday/ViewHoliday.php">
                    <span data-feather="smile" class="align-text-bottom"></span>
                    Holiday Management
                </a>
            </li>
            <li class="nav-item <?= @$Time ?>">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>timeSlots/ViewTimeSlots.php">
                    <span data-feather="clock" class="align-text-bottom"></span>
                    Time Slot Management
                </a>
            </li>
            <li class="nav-item <?= @$Payment ?>">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>jobCard/viewJobCardMngDone.php">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Payment Management
                </a>
            </li>

            <li class="nav-item <?= @$Reports ?>">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>report/report.php">
                    <span data-feather="layers" class="align-text-bottom"></span>
                    Reports
                </a>
            </li>
        </ul>
    </div>
</nav>