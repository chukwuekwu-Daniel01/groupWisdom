<?php
session_start();
include("../connection.php");

// 1. Registration Validation
if (!isset($_POST['name']) || empty(trim($_POST['name']))) {
    $_SESSION['name_error'] = "Name is required";
    header("location: ../../register.php");
    exit;
}

if (!isset($_POST['email']) || empty(trim($_POST['email']))) {
    $_SESSION['email_error'] = "Email is required";
    header("location: ../../register.php");
    exit;
}

if (!isset($_POST['password']) || empty($_POST['password'])) {
    $_SESSION['password_error'] = "Password is required";
    header("location: ../../register.php");
    exit;
}

if (strlen($_POST['password']) <= 6) {
    $_SESSION['password_error'] = "Password must be more than 6 characters";
    header("location: ../../register.php");
    exit;
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];

$check_query = "SELECT email FROM users WHERE email = ?";
$check_stmt = mysqli_prepare($connect, $check_query);
mysqli_stmt_bind_param($check_stmt, "s", $email);
mysqli_stmt_execute($check_stmt);
mysqli_stmt_store_result($check_stmt); 


// If the count is greater than 0, the user already exists
if (mysqli_stmt_num_rows($check_stmt) > 0) {
    $_SESSION['email_error'] = "User already exists. Please login.";
    header("location: ../../login.php"); // Redirects to login page as requested
    exit;
}
// Close the check statement so we can move on to inserting
mysqli_stmt_close($check_stmt); 


// 4. Hash Password and Insert New User
$hash_password = password_hash($password, PASSWORD_DEFAULT);

$insert_query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$insert_stmt = mysqli_prepare($connect, $insert_query);
mysqli_stmt_bind_param($insert_stmt, "sss", $name, $email, $hash_password);

// 5. Final Execution and Session Setup
if (mysqli_stmt_execute($insert_stmt)) {
    
    $new_user_id = mysqli_insert_id($connect);
    

    $_SESSION['user_id'] = $new_user_id;    
    $_SESSION['username'] = $name; 
    $_SESSION['email'] = $email;
    $_SESSION['authenticated'] = true;  

    // Redirect to dashboard, fully authenticated and ready to add notes
    header("location: ../../index.php");
    exit;

} else {
    $_SESSION['email_error'] = "Something went wrong. Please try again.";
    header("location: ../../register.php");
    exit;
}
?>