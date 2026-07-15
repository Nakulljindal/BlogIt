<?php
session_start();

include "db.php";
if (!isset($_GET['blog_id'])) {
    header("Location: explore.php");
    exit();
}

else {
    $blog_id = $_GET["blog_id"];
    $sql = "SELECT blogs.*, users.user_name
    FROM blogs
    INNER JOIN users
    ON  blogs.user_id = users.id
    WHERE blogs.blog_id = $blog_id 
    LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Blog | BlogIt</title>

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/components/navbar.css">
    <link rel="stylesheet" href="css/components/footer.css">
    <link rel="stylesheet" href="css/pages/displayBlog.css">

</head>

<body>

    <?php include "components/navbar.php"; ?>



    <main class="py-4">

        <div class="container">

            <!-- Cover Image -->

            <div class="blog-image ">

                <img src="assets/uploads/blogs/<?= $row['blog_image'];?>"
                    class="img-fluid rounded-top shadow-sm w-100 border border-bottom-0"
                    alt="Blog Image">

            </div>



            <!-- Blog Content -->

            <div class="blog-container container-fluid  p-5 px-5  bg-white w-100 border border-top-0 rounded-bottom-2">

                <!-- Category -->

                <span class="badge bg-dark mb-3">

                    <?php echo $row['blog_category']; ?>

                </span>

                <!-- Title -->

                <h1 class="blog-title">

                    <?= $row['blog_title'] ?>

                </h1>

                <!-- Author -->

                <div class="blog-meta mb-5">

                    <span>

                        <i class="bi bi-person-fill"></i>

                    <?= $row['user_name'] ?>
                        

                    </span>

                    <span>

                        <i class="bi bi-calendar-event"></i>

                        <?= date("d M Y", strtotime($row["created_at"])) ?>
                        

                    </span>

                </div>

                <!-- Description -->

                <p class="blog-description">

                    <?= $row['blog_description']?>

                </p>

                <hr class="my-5">

                <!-- Actual Blog -->

                <div class="blog-content">

                    <?= nl2br($row['blog_content']) ?>
                    

                </div>



                <!-- Buttons -->

                <div class="mt-5 d-flex justify-content-between">

                    <a href="explore.php"
                        class="btn btn-outline-dark">

                        <i class="bi bi-arrow-left"></i>

                        Back

                    </a>

                    

                </div>

            </div>

        </div>

    </main>



    <?php include "components/footer.php"; ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>