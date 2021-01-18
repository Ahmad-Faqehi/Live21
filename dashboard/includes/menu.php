<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fab fa-bitbucket"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Live 21</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item  ">
        <a class="nav-link text-center" href="index.php" >
            <i class="fas fa-home"></i>
            <span>الرئيسية</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading text-center Fonty">
        <div class="head-menu">التحكم</div>
    </div>


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link text-center" href="add-match.php">
            <i class="fas fa-plus"></i>
            <span>أضافة مبارة جديدة</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link text-center" href="matches.php">
            <i class="far fa-question-circle"></i>
            <span>تعديل مبارة</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link text-center" href="teams.php">
            <i class="fas fa-user-shield"></i>
            <span>ادارة الفرق </span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link text-center" href="servers.php">
            <i class="fas fa-link"></i>
            <span> روابط سيرفرات </span>
        </a>
    </li>

    <!-- Divider -->
    <?php if($_SESSION['dashRank:TVTC'] == "admin"){?>
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading text-center Fonty" >
        <div class="head-menu">الاعدادات</div>
    </div>


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link text-center" href="ads.php">
            <i class="fas fa-dollar-sign"></i>
            <span>الاعلانات</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link text-center" href="users.php">
            <i class="fas fa-users"></i>
            <span>المستخدمين</span>
        </a>
    </li>
    <?php } ?>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>