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
                <a class="nav-link <?= @$Skills?>" href="<?= SYSTEM_PATH ?>skills/ViewEmpSkill_Task.php">
                    <span data-feather="sun" class="align-text-bottom"></span>
                    Employee Skills & Task
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>inspection/viewIEstimates.php">
                    <span data-feather="briefcase" class="align-text-bottom"></span>
                    Estimates
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>inspection/viewInspection.php">
                    <span data-feather="sliders" class="align-text-bottom"></span>
                    Inspections
                </a>
            </li>
        </ul>
    </div>
</nav>