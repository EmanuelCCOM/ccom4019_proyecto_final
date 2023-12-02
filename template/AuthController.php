<?php
// Include the database connection file
include 'db_connect.php';

 session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user against admins table
    $isAdmin = validateAdmin($email, $password);

    // Validate user against students table
    $isStudent = validateStudent($email, $password);

    if ($isAdmin) {
        $_SESSION['role'] = 'admin';
        // Redirect to recordsView.php
        header('Location: admin/controllers/recordsController.php');
        exit();
    } elseif ($isStudent) {
        // Redirect to classes.php
        $_SESSION['role'] = 'student';
        header('Location: student/views/classes.php');
        exit();
    } else {
        // Invalid login message
        echo 'Invalid login credentials';
    }
}

function validateAdmin($email, $password)
{
    global $conn;
    $query = "SELECT * FROM admins WHERE email = ? AND pass = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function validateStudent($email, $password)
{
    global $conn;
    $query = "SELECT * FROM student WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}
?>