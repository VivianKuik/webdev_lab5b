<?php
    
    session_start();
    if (!isset($_SESSION['name'])) {
        echo "<script>alert('You are unauthorized to access this page. Please log in first!'); window.location.href='login.php';</script>";
        exit;
    }

    include 'Database.php';
    include 'User.php';

    $database = new Database();
    $db = $database->getConnection();


    $user = new User ($db);

    $user->updateUser($_POST['matric'], $_POST['name'], $_POST['role']);

    $db->close();

    echo "<script>alert('Data has been updated successfully!'); window.location.href='read.php';</script>";

?>
