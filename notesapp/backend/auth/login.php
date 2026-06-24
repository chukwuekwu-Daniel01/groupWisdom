<?php
session_start();
include("../connection.php");

// 1. Guard clauses to ensure fields aren't empty
if (empty(trim($_POST['email'])) || empty($_POST['password'])) {
    $_SESSION['login_error'] = "Please fill in all fields.";
    header("location: ../../login.php");
    exit;
}

$email = trim($_POST['email']);
$password = $_POST['password'];

// 2. SELECT the user from the database to get their ID and hashed password
$query = "SELECT user_id, name, password FROM users WHERE email = ?";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// 3. Fetch the row. If it exists, verify the password
if ($row = mysqli_fetch_assoc($result)) {
    
    // We use password_verify() to check the plain-text password against the hash
    if (password_verify($password, $row['password'])) {
        
        // 4. SUCCESS: Save the critical data into the session
        $_SESSION['user_id'] = $row['user_id']; 
        $_SESSION['username'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['authenticated'] = true;
        
        header("location: ../../index.php");
        exit;
        
    } else {
        $_SESSION['login_error'] = "Incorrect password.";
        header("location: ../../login.php");
        exit;
    }
} else {
    $_SESSION['login_error'] = "Email not found.";
    header("location: ../../login.php");
    exit;
}
?>