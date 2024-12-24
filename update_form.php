<?php
include 'database.php';
include 'user.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['matric'])) {
    // Get the matric value from the GET request
    $matric = $_GET['matric'];

    // Create database connection and fetch user details
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $userDetails = $user->getUser($matric);

    $db->close();

    if ($userDetails) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update User</title>
        </head>
        <body>
            <h1>Update User</h1>
            <form action="update.php" method="post">
                <label for="matric">Matric:</label>
                <input type="text" id="matric" name="matric" value="<?php echo $userDetails['matric']; ?>" readonly><br>
                
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $userDetails['name']; ?>" required><br>
                
                <label for="role">Access Level:</label>
                <select name="role" id="role" required>
                    <option value="lecturer" <?php if ($userDetails['role'] == 'Lecturer') echo "selected"; ?>>Lecturer</option>
                    <option value="student" <?php if ($userDetails['role'] == 'Student') echo "selected"; ?>>Student</option>
                </select><br>
                
                <button type="submit">Update</button>
                <a href="read.php">Cancel</a>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "User not found.";
    }
}
?>
