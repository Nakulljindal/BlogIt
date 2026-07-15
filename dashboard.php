<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$user_id = $_SESSION['id'];

$sql = "SELECT blogs.*, users.user_name
    FROM blogs 
    INNER JOIN users 
    ON users.id = blogs.user_id
    WHERE blogs.user_id = $user_id";

$result = $conn->query($sql);





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/global.css">

    <link rel="stylesheet" href="css/components/navbar.css">
    <link rel="stylesheet" href="css/components/sidebar.css">
    <link rel="stylesheet" href="css/components/footer.css">
    <link rel="stylesheet" href="css/pages/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>


    <?php include "components/navbar.php"; ?>


    <div class="container-fluid">

        <div class="row">

            <!-- Sidebar -->
            <div class="col-lg-3 col-xl-2 p-0">

                <?php include "components/sidebar.php"; ?>

            </div>

            <!-- Main Content -->
            <div class="col-lg-9 col-xl-10">

                <div class="p-4">

                    <!-- Page Heading -->

                    <div class="mb-4">

                        <h2 class="fw-bold">
                            Dashboard
                        </h2>

                        <p class="text-muted">
                            Welcome back! Here's an overview of your blogging activity.
                        </p>

                    </div>

                    <!-- Statistics -->

                    <div class="row g-4">

                        <div class="col-md-4">

                            <div class="card shadow-sm">

                                <div class="card-body">

                                    <h6 class="text-muted">
                                        Total Blogs
                                    </h6>

                                    <h2 class="fw-bold">
                                        <?= $result->num_rows; ?>
                                    </h2>

                                </div>

                            </div>

                        </div>


                        <!-- Recent Blogs -->

                        <div class="card mt-5 shadow-sm">

                            <div class="card-header bg-white">

                                <h5 class="mb-0">
                                    My Recent Blogs
                                </h5>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-hover align-middle mb-0">

                                    <thead>

                                        <tr>

                                            <th>Title</th>

                                            <th>Category</th>

                                            <th>Date</th>

                                            <th>Status</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) { ?>

                                                <tr>

                                                    <td> <?= $row['blog_title'] ?> </td>

                                                    <td><?= $row['blog_category']?> </td>

                                                    <td><?= date("d M Y", strtotime($row["created_at"])) ?></td>

                                                    <td>

                                                        <span class="badge bg-success">
                                                            Published
                                                        </span>

                                                    </td>

                                                    <td>

                                                        <button onclick="window.location.href='updateBlog.php?blog_id=<?= $row['blog_id'] ?>'" class="btn btn-sm btn-outline-dark">
                                                            Edit
                                                        </button>

                                                        <button onclick="window.location.href='deleteBlog.php?blog_id=<?= $row['blog_id'] ?>'" class="btn btn-sm btn-outline-danger">
                                                            Delete
                                                        </button>

                                                    </td>

                                                </tr>

                                            <?php }
                                        } ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?php include "components/footer.php"; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>