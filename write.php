<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
include "db.php";



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $error = "";

    $user_id = $_SESSION['id'];
    $blog_title = input($_POST['title']);
    $blog_description = input($_POST['description']);
    $blog_category = input($_POST['category']);
    $blog_content = input($_POST['content']);

    $image_name = '';

    if (!empty($_FILES['image']['name'])) {

        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_error = $_FILES['image']['error'];

        if ($image_error != 0) {
            $error .= "Image upload failed!";
        }

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

        if (empty($error)) {

            $image_new_name = uniqid() . "." . $image_extension;

            $image_destination = "assets/uploads/blogs/" . $image_new_name;

            move_uploaded_file($image_tmp, $image_destination);
        }
    }
    $_SESSION['blog_title'] = $blog_title;
    $_SESSION['blog_description'] = $blog_description;
    $_SESSION['blog_category'] = $blog_category;
    $_SESSION['blog_content'] = $blog_content;

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

        $sql = "INSERT INTO blogs (user_id, blog_title, blog_description, blog_category, blog_image, blog_content)
        VALUES ('$user_id', '$blog_title', '$blog_description','$blog_category', '$image_new_name', '$blog_content')";

        if ($conn->query($sql) === TRUE) {
            unset($_SESSION['blog_title']);
            unset($_SESSION['blog_description']);
            unset($_SESSION['blog_category']);
            unset($_SESSION['blog_content']);
            header("Location: index.php");
            exit();

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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

    <title>Write | BlogIt</title>

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

                                Write a New Blog

                            </h2>

                            <form action="write.php" method="POST" enctype="multipart/form-data">

                                <?php if (!empty($error)) {
                                    echo "<p style = 'color: red; text-align: center;'>" . $error . "</p>";
                                } ?>

                                <!-- Title -->

                                <div class="mb-4">

                                    <label class="form-label">

                                        Blog Title

                                    </label>

                                    <input type="text" class="form-control" name="title" placeholder="Enter blog title"
                                        value="<?php
                                        if (!empty($_SESSION['blog_title'])) {
                                            echo $blog_title;
                                        }

                                        ?>" required>

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">

                                        Blog Description

                                    </label>

                                    <input type="text" class="form-control" name="description" value="<?php
                                    if (!empty($_SESSION['blog_description'])) {
                                        echo $blog_description;
                                    }


                                    ?>" placeholder="Enter blog description" required>

                                </div>



                                <!-- Category -->

                                <div class="mb-4">

                                    <label class="form-label">

                                        Category

                                    </label>

                                    <select class="form-select" name="category" placeholder="Select Category">

                                        <option <?= (empty($_SESSION['blog_category']) ? 'selected' : '') ?>>Select
                                            Category</option>
                                        <option <?php if (!empty($_SESSION['blog_category'])) {
                                            echo ($blog_category === "Technology") ? "echo 'selected';" : '';
                                        } ?>>Technology</option>
                                        <option <?php if (!empty($_SESSION['blog_category'])) {
                                            echo ($blog_category === "Programming") ? 'selected' : '';
                                        } ?>>Programming</option>
                                        <option <?php if (!empty($_SESSION['blog_category'])) {
                                            echo ($blog_category === "AI") ? 'selected' : '';
                                        } ?>>AI</option>
                                        <option <?php if (!empty($_SESSION['blog_category'])) {
                                            echo ($blog_category === "Education") ? 'selected' : '';
                                        } ?>>Education</option>
                                        <option <?php if (!empty($_SESSION['blog_category'])) {
                                            echo ($blog_category === "Business") ? 'selected' : '';
                                        } ?>>Business</option>

                                    </select>

                                </div>



                                <!-- Thumbnail -->

                                <div class="mb-4">

                                    <label class="form-label">

                                        Cover Image

                                    </label>

                                    <input type="file" class="form-control" name="image">

                                </div>



                                <!-- Content -->

                                <div class="mb-4">

                                    <label class="form-label">

                                        Blog Content

                                    </label>

                                    <textarea class="form-control" rows="15" name="content"
                                        placeholder="Start writing..." required><?php if (!empty($_SESSION['blog_content'])) {
                                            echo $blog_content;
                                        }
                                        ?></textarea>

                                </div>



                                <!-- Buttons -->

                                <div class="d-flex justify-content-end gap-3">

                                    <button type="reset" class="btn btn-outline-secondary">

                                        Clear

                                    </button>

                                    <button type="submit" class="btn btn-dark">

                                        Publish Blog

                                    </button>

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