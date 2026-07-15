<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['id'])) {
    $user_name = $_SESSION['user_name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>BlogIt | Home</title>

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Component CSS -->

    <link rel="stylesheet" href="css/components/navbar.css">
    <link rel="stylesheet" href="css/components/hero.css">
    <link rel="stylesheet" href="css/components/blog-card.css">
    <link rel="stylesheet" href="css/components/footer.css">
    
    <!-- Global CSS -->

    <link rel="stylesheet" href="css/global.css">

</head>

<body>

    <!-- Navbar -->

    <?php include "components/navbar.php"; ?>



    <!-- Hero -->

    <?php include "components/hero.php"; ?>



    <!-- Featured Blogs -->

    <section class="container py-5">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                Featured Blogs
            </h2>

            <p class="text-muted">
                Discover stories from our community.
            </p>

        </div>

                            <section class="pb-5">


                            <div class="row g-4">


                                    <?php include "components/blog-cards.php"; ?>



                            </div>


                    </section>


    </section>



    <!-- Newsletter -->

    <section class="py-5 bg-light">

        <div class="container text-center">

            <h2 class="fw-bold">
                Stay Updated
            </h2>

            <p class="text-muted mb-4">
                Get the latest articles delivered directly to your inbox.
            </p>

            <form class="row justify-content-center">

                <div class="col-md-6">

                    <div class="input-group">

                        <input
                            type="email"
                            class="form-control"
                            placeholder="Enter your email">

                        <button
                            class="btn btn-dark"
                            type="submit">

                            Subscribe

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </section>



    <!-- Footer -->

    <?php include "components/footer.php"; ?>



    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>