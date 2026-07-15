
<?php

    include "../db.php";

    $sql = "CREATE TABLE users(
    id INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    user_email VARCHAR(100) NOT NULL UNIQUE,
    user_password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";


    if($conn ->query($sql) === TRUE){
        echo "users table created succerssfully";
    }
    else{
        echo "Error creating table" .$conn->error;
    }


    $sql = "CREATE TABLE blogs(
    blog_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    blog_title VARCHAR(255) NOT NULL,
    blog_description VARCHAR (250) NOT NULL,
    blog_category VARCHAR (50) NOT NULL,
    blog_content LONGTEXT NOT NULL,
    blog_image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if($conn ->query($sql) === TRUE){
        echo "blogs table created succerssfully";
    }
    else{
        echo "Error creating table" .$conn->error;
    }

?>