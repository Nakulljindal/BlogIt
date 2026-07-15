<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php";




?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Explore | BlogIt</title>

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->

    <link rel="stylesheet" href="css/global.css">

    <link rel="stylesheet" href="css/components/navbar.css">
    <link rel="stylesheet" href="css/components/footer.css">
    <link rel="stylesheet" href="css/components/blog-card.css">

    <link rel="stylesheet" href="css/pages/explore.css">

</head>

<body>

    <!-- Navbar -->

    <?php include "components/navbar.php"; ?>



    <!-- Header -->

    <section class="explore-header py-5">

        <div class="container text-center">

            <h1 class="fw-bold">
                Explore Blogs
            </h1>

            <p class="text-muted">
                Discover stories, tutorials and ideas shared by our community.
            </p>

        </div>

    </section>



    <!-- Search -->

    <section class="pb-5">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-7">

                    <form>

                        <div class="input-group">

                            <input type="text" class="form-control" placeholder="Search blogs...">

                            <button class="btn btn-dark">

                                <i class="bi bi-search"></i>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>



    <!-- Blogs -->

    <section class="pb-5">

        <div class="container">

            <div class="row g-4">


                    <?php include "components/blog-cards.php"; ?>



            </div>

        </div>

    </section>



    <!-- Footer -->

    <?php include "components/footer.php"; ?>



    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>