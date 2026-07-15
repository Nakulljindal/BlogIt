<?php

include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = "";
    $login_user_email = $_POST['user_email'];
    $login_user_password = $_POST['user_password'];

    $login_user_email = formInput($login_user_email);
    $login_user_password = formInput($login_user_password);




    $sql = "SELECT * FROM users WHERE user_email = '$login_user_email' LIMIT 1";

    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $user_name = $row["user_name"];
        $user_email = $row["user_email"];
        $user_password = $row["user_password"];
        $created_at = $row["created_at"];
        $updated_at = $row["updated_at"];
        if (password_verify($login_user_password, $user_password)) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['id'] = $id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;

            header("Location: dashboard.php");
            exit();
        } else {
            $error .= "Invalid Email or Password";
        }

    } else {
        $error .= "Error finding your account.";
    }





}

function formInput($data)
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

    <title>Login | BlogIt</title>

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/components/navbar.css">
    <link rel="stylesheet" href="css/components/footer.css">
    <link rel="stylesheet" href="css/components/auth.css">

</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->

    <?php include "components/navbar.php"; ?>



    <!-- Login Section -->

    <main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-md-6 col-lg-5 col-xl-4">

                    <div class="card auth-card shadow-sm">

                        <div class="card-body p-4">

                            <h2 class="text-center fw-bold mb-2">
                                Welcome Back
                            </h2>

                            <p class="text-center text-muted mb-4">
                                Login to continue writing and reading blogs.
                            </p>

                            <?php if (!empty($error)) {
                                echo "<p style = 'color: red; text-align: center;'>" . $error . "</p>";
                            } ?>


                            <form action="login.php" method="POST">

                                <div class="mb-3">

                                    <label class="form-label">
                                        Email Address
                                    </label>

                                    <input type="email" name="user_email" class="form-control"
                                        placeholder="Enter your email" required>

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">
                                        Password
                                    </label>

                                    <input type="password" name="user_password" class="form-control"
                                        placeholder="Enter your password" required>

                                </div>

                                <button type="submit" class="btn btn-dark w-100">

                                    Login

                                </button>

                            </form>

                            <div class="text-center mt-4">

                                Don't have an account?

                                <a href="signup.php">
                                    Sign Up
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>



    <!-- Footer -->

    <?php include "components/footer.php"; ?>



    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>