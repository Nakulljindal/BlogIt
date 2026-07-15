
<?php 

    $currentPage = basename($_SERVER['PHP_SELF']);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.2.0/css/all.min.css"
    integrity="sha512-F/yRpRY8sctKzP7exU5PLGejwg/QtjDX6CIy/41nApe7JqdZgCcCzJTNq9Rcp/XwbeeTGillGevBakruY15pxA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<aside class="sidebar d-flex flex-column">

    <!-- Navigation -->
    <ul class="nav flex-column px-3 py-4">

        <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?= ($currentPage == 'dashboard.php') ? 'active' : ''; ?>">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="myblogs.php" class="nav-link <?= ($currentPage == 'myblogs.php') ? 'active' : ''; ?>">
                <i class="bi bi-journal-text"></i>
                My Blogs
            </a>
        </li>

        <li class="nav-item">
            <a href="profile.php" class="nav-link <?= ($currentPage == 'profile.php') ? 'active' : ''; ?>">
                <i class="bi bi-person"></i>
                Profile
            </a>
        </li>

    </ul>

    <!-- Logout -->
    <div class="mt-auto p-3 pb-5">

        <a href="logout.php" class="btn btn-dark w-100">
            Logout
        </a>

    </div>

</aside>