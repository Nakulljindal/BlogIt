<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blogs</title>
    <link rel="stylesheet" href="css/components/navbar.css">
    <link rel="stylesheet" href="css/components/sidebar.css">
    <link rel="stylesheet" href="css/components/footer.css">
    <link rel="stylesheet" href="css/pages/dashboard.css">
    <link rel="stylesheet" href="css/components/blog-card.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <?php include "components/navbar.php"; ?>

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-3 col-xl-2 p-0">
                <?php include "components/sidebar.php"; ?>
            </div>

            <div class="col-lg-9 col-xl-10">

                <div class="p-4">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <h2 class="fw-bold">My Blogs</h2>

                            <p class="text-muted">
                                Manage all your published articles.
                            </p>

                        </div>

                        <a href="write.php" class="btn btn-dark">
                            Write New Blog
                        </a>

                    </div>

                    <!-- Blog Cards Here -->

                    <section class="pb-5">


                            <div class="row g-4">


                                    <?php include "components/blog-cards.php"; ?>



                            </div>


                    </section>

                </div>

            </div>

        </div>

    </div>

    <?php include "components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>