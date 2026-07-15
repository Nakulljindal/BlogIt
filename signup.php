<?php

include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = "";
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $confirmPassword = $_POST['confirmPassword'];

    $user_name = formInput($user_name);
    $user_email = formInput($user_email);
    $user_password = formInput($user_password);
    $confirmPassword = formInput($confirmPassword);

    if (empty($user_name)) {
        $error .= "Name is required!\n";
    }

    if (empty($user_email)) {
        $error .= "Email is required!\n";
    }

    if (empty($user_password)) {
        $error .= "Password is required!\n";
    }

    if (empty($confirmPassword)) {
        $error .= "Password is required!\n";
    }

    if ($user_password !== $confirmPassword) {
        $error .= "Password does not match!";
    }
    
    $sql = "SELECT user_email FROM users WHERE user_email = '$user_email' LIMIT 1";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $error = "This Email is already registered";
    }

    $user_password = hashPassword($user_password);


    if (empty($error)) {
        $sql = "INSERT INTO users (user_name, user_email, user_password)
        VALUES ('$user_name', '$user_email', '$user_password')
        
        ";
        if ($conn->query($sql)) {
            header("Location: login.php");
            exit();
        } else {
            echo "Query Failed" . $conn->error;
        }

    }


}

function hashPassword($data)
{
    $data = password_hash($data, PASSWORD_DEFAULT);
    return $data;
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

    <title>Sign Up | BlogIt</title>

    <!-- Bootstrap CSS -->

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



    <!-- Signup Section -->

    <main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-md-7 col-lg-6 col-xl-5">

                    <div class="card auth-card shadow-sm">

                        <div class="card-body p-4">

                            <h2 class="text-center fw-bold mb-2">
                                Create Your Account
                            </h2>

                            <p class="text-center text-muted mb-4">
                                Join BlogIt and start sharing your stories.
                            </p>

                            <?php if(!empty($error)){ echo "<p style = 'color: red; text-align: center;'>" . $error . "</p>"; }?>
                            <form action="signup.php" method="POST">


                                <div class="mb-3">
                                    <label class="form-label">
                                        Full Name
                                    </label>

                                    <input type="text" name="user_name" class="form-control"
                                        placeholder="Enter your full name" required>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Email Address
                                    </label>

                                    <input type="email" name="user_email" class="form-control"
                                        placeholder="Enter your email" required>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Password
                                    </label>

                                    <input type="password" name="user_password" class="form-control"
                                        placeholder="Create a password" required>

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">
                                        Confirm Password
                                    </label>

                                    <input type="password" name="confirmPassword" class="form-control"
                                        placeholder="Confirm your password" required>

                                </div>

                                <button type="submit" class="btn btn-dark w-100">

                                    Create Account

                                </button>

                            </form>

                            <div class="text-center mt-4">

                                Already have an account?

                                <a href="login.php">
                                    Login
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