<?php

    session_start();

    include 'Database.php';
    include 'User.php';

    if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
        // Create database connection
        $database = new Database();
        $db = $database->getConnection();

        // Sanitize inputs using mysqli_real_escape_string
        $matric = $db->real_escape_string($_POST['matric']);
        $password = $db->real_escape_string($_POST['password']);

        // Validate inputs
        if (!empty($matric) && !empty($password)) {
            $user = new User($db);
            $userDetails = $user->getUser($matric);

            // Check if user exists and verify password
            if ($userDetails && password_verify($password, $userDetails['password'])) {
                // echo 'Login Successful';
                $_SESSION['name'] = $userDetails['name'];
                setcookie("name",$userDetails['name'], time()+3600);
                header('Location:read.php');
                exit();
            } else {
                // echo 'Login Failed';
                echo "<script>alert('Invalid matric or password, try login again'); window.location.href='login.php';</script>";
            }
        } 
      
        else {
            echo 'Please fill in all required fields.';
        }
    }

?>