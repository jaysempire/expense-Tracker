<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Profile Image Section -->
    <div class="text-center my-4 position-relative">
        <div class="position-relative d-inline-block">
            <img src="<?= $web_app->getImg(); ?>" alt="User Profile" class="rounded-circle border border-2" width="100" height="100" style="object-fit: cover;">

            <!-- Pencil triggers modal -->
            <a href="#" 
            class="position-absolute bottom-0 end-0 translate-middle bg-white border rounded-circle d-flex align-items-center justify-content-center"
            style="width: 24px; height: 24px;" 
            data-bs-toggle="modal" data-bs-target="#changeProfileImageModal"
            title="Change Profile Picture">
            <i class="bi bi-pencil-fill text-primary" style="font-size: 12px;"></i>
            </a>
        </div>
        <h6 class="mt-2 mb-0 fw-semibold text-dark"><?=$web_app->getName()?></h6>
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


<div class="modal fade" id="changeProfileImageModal" aria-labelledby="changeProfileImageModalLabel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update User Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img src="<?= $web_app->getImg(); ?>" alt="Current Image" 
                            class="img-fluid rounded mb-2" style="max-height: 200px;">
                    </div>
                    
                    <div class="mb-3">
                        <label for="player_image" class="form-label">Upload New Image</label>
                        <input class="form-control" type="file" name="user_image" 
                         accept="image/*">
                        <div class="form-text">Max file size: 2MB (JPG, PNG)</div>
                    </div>
                    
                    <!-- <input type="hidden" name="user_id"> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="img_btn">Upload Image</button>
                </div>
            </form>
        </div>
    </div>
</div>