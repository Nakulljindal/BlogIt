<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['id'])) {
    $user_name = $_SESSION['user_name'];
}

$currentPage = basename($_SERVER['PHP_SELF']);

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.2.0/css/all.min.css"
    integrity="sha512-F/yRpRY8sctKzP7exU5PLGejwg/QtjDX6CIy/41nApe7JqdZgCcCzJTNq9Rcp/XwbeeTGillGevBakruY15pxA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 sticky-top">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold fs-3" href="index.php">
            BLOGIT
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            <!-- Navigation Links -->
            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'index.php') ? 'active' : ''; ?>" href="index.php"> Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link  <?= ($currentPage == 'explore.php') ? 'active' : ''; ?>" href="explore.php">
                        Explore
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'write.php') ? 'active' : ''; ?>" href="write.php">
                        Write
                    </a>
                </li>

            </ul>

            <!-- Right Buttons -->
            <?php

            if ($currentPage === "login.php" || $currentPage === "signup.php") {
                echo '<div class = "px-5"></div>';
            } else {

                if (!isset($_SESSION['id'])) {

                    echo "<div class=\"d-flex align-items-center gap-2\">";

                    echo "<button class=\"btn btn-outline-dark\" onclick=\"window.location.href='login.php'\">Login</button>";

                    echo "<button class=\"btn btn-dark\" onclick=\"window.location.href='signup.php'\">Sign Up</button>";

                    echo "</div>";
                } else {
                    echo "<div class=\"d-flex align-items-center gap-2\">";
                    echo "<div class=\"d-flex dropdown-btn\">";



                    echo "<div class=\"dropdown\">";
                    echo "<button class=\"nav-link dropdown-toggle\"  data-bs-toggle=\"dropdown\" aria-expanded=\"false\">";
                    echo "Welcome, " . $_SESSION['user_name'];
                    echo "</button>";
                    echo "<ul class=\"dropdown-menu dropdown-menu-end shadow\">";
                    echo "<li>";
                    echo "<a class=\"dropdown-item\" href=\"dashboard.php\">";
                    echo "<i class=\"bi bi-speedometer2 me-2\"></i> Dashboard </a>";
                    echo "</li>";
                    echo "<li>";
                    echo "<a class=\"dropdown-item\" href=\"profile.php\"><i class=\"bi bi-person-circle me-2\"></i>Profile</a>";
                    echo "</li>";
                    echo "<li>";
                    echo "<a class=\"dropdown-item\" href=\"myblogs.php\"><i class=\"bi bi-journal-text me-2\"></i>My Blogs</a>";
                    echo "</li>";
                    echo "<li><hr class=\"dropdown-divider\"></li>";
                    echo "<li>";
                    echo "<a class=\"dropdown-item text-danger\" href=\"logout.php\"><i class=\"bi bi-box-arrow-right me-2\"></i>Logout</a>";
                    echo "</li>";
                    echo "</ul>";
                    echo "</div>";




                    echo "</div>";
                }
            }



            ?>

        </div>

    </div>
</nav>