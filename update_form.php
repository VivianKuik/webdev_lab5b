<?php
    session_start();
    if (!isset($_SESSION['name'])) {
        echo "<script>alert('You are unauthorized to access this page. Please log in first!'); window.location.href='login.php';</script>";
        exit;
    }

    if (!isset($_GET['token']) || $_GET['token'] !== md5(session_id())) {
        echo "<script>alert('Invalid access. Please use the proper flow to access this page.'); window.location.href='read.php';</script>";
        exit;
    }

    include 'Database.php';
    include 'User.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $userData = $user->getUser($_GET['matric']);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card p-4 shadow">
                    <h2 class="text-center mb-4">Update <?php echo htmlspecialchars($userData['name']); ?>'s Information</h2> 
                        <form action="update.php" method="post">
                            <div class="mb-3">
                                <label for="matric" class="form-label">Matric:</label>
                                <input type="text" name="matric" id="matric" class="form-control" value="<?php echo $userData['matric']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $userData['name']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role:</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="student" <?php if ($userData['role'] == 'student') { echo "selected";} ?>>Student</option>
                                    <option value="lecturer" <?php if ($userData['role'] == 'lecturer') { echo "selected";} ?>>Lecturer</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <input type="submit" value="Update" class="btn btn-primary">
                                <a href="read.php" class="btn btn-secondary ms-2">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
