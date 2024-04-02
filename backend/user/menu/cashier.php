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
                <a class="nav-link" href="<?= SYSTEM_PATH ?>inspection//manager_supervisor/viewInspection.php">
                    <span data-feather="paperclip" class="align-text-bottom"></span>
                    Completed Inspection
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>jobCard/viewJobCardCashier.php">
                    <span data-feather="paperclip" class="align-text-bottom"></span>
                    Completed Job Cards
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>jobCard/viewJobCardCashierDone.php">
                    <span data-feather="trending-up" class="align-text-bottom"></span>
                    Payed Job Cards
                </a>
            </li>
        </ul>

    </div>
</nav>