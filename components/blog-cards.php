<?php

include "db.php";



$currentPage = basename($_SERVER['PHP_SELF']);



if ($currentPage === "explore.php") {

    $sql = "SELECT blogs.*, users.user_name
    FROM blogs 
    INNER JOIN users 
    ON users.id = blogs.user_id";

    $result = $conn->query($sql);



} else if ($currentPage === "myblogs.php") {

    $user_id = $_SESSION['id'];

    $sql = "SELECT blogs.*, users.user_name
    FROM blogs 
    INNER JOIN users 
    ON users.id = blogs.user_id
    WHERE blogs.user_id = $user_id";

    $result = $conn->query($sql);

}
 else if ($currentPage === "index.php") {

    $sql = "SELECT blogs.*, users.user_name
    FROM blogs 
    INNER JOIN users 
    ON users.id = blogs.user_id 
    ORDER BY RAND()
    LIMIT 3";

    $result = $conn->query($sql);

} 

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ?>
        <div class="col-md-6 col-lg-4">

            <div class="card blog-card shadow-sm h-100">
                <!-- Blog Image -->

                <img src="<?php if(empty($row['blog_image'])) { echo 'assets/uploads/default-image.jpg'; } else{ echo 'assets/uploads/blogs/' . $row['blog_image']; }?>" class="card-img-top" alt="Blog Image">

                <div class="card-body d-flex flex-column">

                    <!-- Category -->

                    <span class="badge bg-light text-dark mb-3">

                        <?= $row["blog_category"] ?>

                    </span>

                    <!-- Blog Title -->

                    <h4 class="card-title">
                        <?= $row["blog_title"] ?>

                    </h4>

                    <!-- Short Description -->

                    <p class="card-text">
                        <?= $row["blog_description"] ?>


                    </p>

                    <!-- Author -->

                    <div class="mt-auto">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-muted">

                                    By <?= $row["user_name"] ?>


                                </small>

                                <br>

                                <small class="text-muted">

                                    <?= date("d M Y", strtotime($row["created_at"])) ?>

                                </small>

                            </div>

                            <a href="displayBlog.php?blog_id=<?= $row['blog_id'] ?>" class="btn btn-dark btn-sm">

                                Read More

                            </a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>