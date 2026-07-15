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

$sql = "DELETE FROM blogs 
    WHERE blog_id = $blog_id
    AND user_id = {$_SESSION['id']}
    LIMIT 1";

$conn->query($sql);


$conn->close();
header("Location: dashboard.php");
?>