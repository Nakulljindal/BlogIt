<?php

session_start();
include "db.php";


if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}


if (!isset($_GET['blog_id'])) {
    header("Location: dashboard.php");
    exit();
}

$blog_id = (int) $_GET['blog_id'];

$sql = "SELECT *
        FROM blogs
        WHERE blog_id = $blog_id
        AND user_id = {$_SESSION['id']}
        LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: dashboard.php");
    exit();
}

$row = $result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $error = "";
    $blog_title = input($_POST['blog_title']);
    $blog_description = input($_POST['blog_description']);
    $blog_category = input($_POST['blog_category']);
    $blog_content = input($_POST['blog_content']);
    $blog_id = $_POST['blog_id'];
    $image_new_name = $row['blog_image'];

    if (!empty($_FILES['image']['name'])) {
        $old_image = "assets/uploads/blogs/" . $row['blog_image'];
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_error = $_FILES['image']['error'];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_extension = strtolower($image_extension);
        $allowed_extensions = [
            "jpg",
            "jpeg",
            "png",
            "webp"
        ];
        if (!in_array($image_extension, $allowed_extensions)) {
            $error .= "Only JPG, JPEG, PNG and WEBP are allowed.";
        }
        $image_new_name = uniqid() . "." . $image_extension;
        $image_destination = "assets/uploads/blogs/" . $image_new_name;
        move_uploaded_file($image_tmp, $image_destination);
    }
    if (file_exists($old_image)) {
        unlink($old_image);
    }
    if (empty($blog_title)) {
        $error .= "Blog Title is Required!\n";
    }
    if (empty($blog_description)) {
        $error .= "Blog Description is Required!\n";
    }
    if (empty($blog_category) || $blog_category === "Select Category") {
        $error .= "Blog Category is Required!\n";
    }
    if (empty($blog_content)) {
        $error .= "Blog Content is Required!\n";
    }



    if (empty($error)) {

        $sql = "UPDATE blogs
        SET 
        blog_title = '$blog_title',
        blog_description = '$blog_description',
        blog_category = '$blog_category',
        blog_content = '$blog_content',
        blog_image = '$image_new_name'
        WHERE blog_id= '$blog_id'
        ";

        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard.php");
        }


        $conn->close();
    }

}

function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update | BlogIt</title>

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->

    <link rel="stylesheet" href="css/global.css">

    <link rel="stylesheet" href="css/components/navbar.css">
    <link rel="stylesheet" href="css/components/footer.css">

    <link rel="stylesheet" href="css/pages/write.css">

</head>

<body>

    <!-- Navbar -->

    <?php include "components/navbar.php"; ?>



    <main class="py-5">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="card shadow-sm border-0">

                        <div class="card-body p-5">

                            <h2 class="fw-bold mb-4">

                                Update Blog

                            </h2>

                            <form action="updateBlog.php?blog_id=<?= $row['blog_id'] ?>" method="POST"
                                enctype="multipart/form-data">

                                <?php if (!empty($error)) {
                                    echo "<p style = 'color: red; text-align: center;'>" . $error . "</p>";
                                } ?>

                                <input type="hidden" name="blog_id" value="<?= $row['blog_id'] ?>">

                                <!-- Title -->

                                <div class="mb-4">

                                    <label class="form-label">

                                        Blog Title

                                    </label>

                                    <input type="text" class="form-control" name="blog_title"
                                        placeholder="Enter blog title" value="<?= $row['blog_title'] ?>" required>

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">

                                        Blog Description

                                    </label>

                                    <input type="text" class="form-control" name="blog_description"
                                        value="<?= $row['blog_description'] ?>" placeholder="Enter blog description"
                                        required>

                                </div>



                                <!-- Category -->

                                <div class="mb-4">

                                    <label class="form-label">

                                        Category

                                    </label>

                                    <select class="form-select" name="blog_category" placeholder="Select Category">

                                        <option>Select Category</option>
                                        <option <?= (($row['blog_category']) === 'Technology') ? 'selected' : ''; ?>>
                                            Technology</option>
                                        <option <?= (($row['blog_category']) === 'Programming') ? 'selected' : ''; ?>>
                                            Programming</option>
                                        <option <?= (($row['blog_category']) === 'AI') ? 'selected' : ''; ?>>AI</option>
                                        <option <?= (($row['blog_category']) === 'Education') ? 'selected' : ''; ?>>
                                            Education</option>
                                        <option <?= (($row['blog_category']) === 'Business') ? 'selected' : ''; ?>>Business
                                        </option>

                                    </select>

                                </div>



                                <!-- Thumbnail -->


                                <div class="mb-4">

                                    <label class="form-label d-flex flex-column">

                                        Cover Image
                                        <img src="assets/uploads/blogs/<?= $row['blog_image'] ?>"
                                            class="img-fluid rounded mb-3" style="max-width:150px;">

                                    </label>

                                    <input type="file" class="form-control" name="image">

                                </div>



                                <!-- Content -->

                                <div class="mb-4">

                                    <label class="form-label">

                                        Blog Content

                                    </label>

                                    <textarea class="form-control" rows="15" name="blog_content"
                                        placeholder="Start writing..." required><?= $row['blog_content'] ?></textarea>

                                </div>



                                <!-- Buttons -->

                                <div class="d-flex justify-content-end gap-3">

                                    <button type="reset" class="btn btn-outline-secondary">

                                        Clear

                                    </button>

                                    <input type="submit" class="btn btn-dark" value="Update Blog">
                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>



    <!-- Footer -->

    <?php include "components/footer.php"; ?>



    <!-- Bootstrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>




</html>