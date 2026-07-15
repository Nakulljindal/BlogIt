
<?php 

session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];



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
    <link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
rel="stylesheet">

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

                <h2 class="fw-bold mb-4">
                    My Profile
                </h2>

                <div class="card shadow-sm">

                    <div class="card-body">

                        <div class="text-center mb-4">

                            <img src="assets/uploads/images.jpg"
                                 width="120"
                                 height ="120"
                                 obbject-fit ="cover"
                                 class="rounded-circle">

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <label>Name</label>

                                <input class="form-control"
                                       value="<?= $user_name ?>"
                                       readonly>

                            </div>

                            <div class="col-md-6">

                                <label>Email</label>

                                <input class="form-control"
                                       value="<?= $user_email ?>"
                                       readonly>

                            </div>

                        </div>

                        <hr>

                        

                        </div>

                        

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