<?php

    include 'Database.php';
    include 'User.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $result = $user->createUser($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role']);

    if ($result === true) {
        echo "<script>alert('User has been added successfully!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('" . $result . "'); window.location.href='register.php';</script>";
    }

    $db->close();
?>
