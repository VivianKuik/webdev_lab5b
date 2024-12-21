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
    $user = new User($db);
    $result = $user->getUsers();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h4>Welcome, <?php echo $_SESSION['name']; ?>!</h4>

        <div class="table-responsive mt-4">
            <table class="table table-striped table-bordered">
            <thead class="bg-primary">
                    <tr>
                        <th class="text-center">Matric</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Role</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $row["matric"]; ?></td>
                                <td><?php echo $row["name"]; ?></td>
                                <td class="text-center"><?php echo ucfirst(strtolower($row["role"])); ?></td>
                                <td class="text-center">
                                    <a href="update_form.php?matric=<?php echo $row['matric']; ?>&token=<?php echo md5(session_id()); ?>" class="btn btn-warning btn-sm">Update</a>
                                </td>

                                <td class="text-center">
                                    <a href="delete.php?matric=<?php echo $row["matric"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No users found</td></tr>";
                    }
                    $db->close();
                    ?>
                </tbody>
            </table>
        </div>

        <div class="mt-3 text-center">
            <a href="logout.php" class="btn btn-secondary">Logout</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
