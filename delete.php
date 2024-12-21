<?php

    session_start();
    if (!isset($_SESSION['name'])) {
        echo "<script>alert('You are unauthorized to access this page. Please log in first!'); window.location.href='login.php';</script>";
        exit;
    }

    include 'Database.php';
    include 'User.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['matric'])) {
            $matric = $_GET['matric'];

            $database = new Database();
            $db = $database->getConnection();

            $user = new User($db);
            $user->deleteUser($matric);

            $db->close();

            header("Location: read.php");
            exit;
        }
    }

?>