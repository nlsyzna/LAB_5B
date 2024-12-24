<?php
include 'database.php';
include 'user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    // Create database connection
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $result = $user->updateUser($matric, $name, $role);

    $db->close();

    // Redirect back to the read page or show a success message
    if ($result === true) {
        header("Location: read.php?success=1");
    } else {
        echo "Error updating user: " . $result;
    }
}
?>
