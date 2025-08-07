<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Profile Image Section -->
    <div class="text-center my-4 position-relative">
        <div class="position-relative d-inline-block">
            <img src="assets/img/profile-img.jpg" alt="User Profile" class="rounded-circle border border-2" width="100" height="100" style="object-fit: cover;">

            <a href="#" 
            class="position-absolute bottom-0 end-0 translate-middle bg-white border rounded-circle d-flex align-items-center justify-content-center"
            style="width: 24px; height: 24px;" 
            title="Edit Profile Picture">
            <i class="bi bi-pencil-fill text-primary" style="font-size: 12px;"></i>
            </a>
        </div>
        <h6 class="mt-2 mb-0 fw-semibold text-dark"><?=$web_app->getname()?></h6>
    </div>


    <li class="nav-item">
        <a class="nav-link <?= ($page === 'dashboard') ? '' : 'collapsed' ?>" href="dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-heading">Pages</li>

    <li class="nav-item">
        <a class="nav-link <?= ($page === 'transaction') ? '' : 'collapsed' ?>" href="transaction">
        <i class="bi bi-clock-history me-1"></i>
        <span>Transaction History</span>
        </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
        <a class="nav-link <?= ($page === 'logout') ? '' : 'collapsed' ?>" href="login">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Sign Out</span>
        </a>
    </li><!-- End Login Page Nav -->

    </ul>

</aside><!-- End Sidebar-->