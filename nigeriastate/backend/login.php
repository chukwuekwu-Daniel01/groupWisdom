<?php 
session_start();

 include 'database.php';

$email = $_POST['email'];
$password = $_POST['password'];


foreach ($users_data as $user) {
    if ($email === $user['email'] && $password === $user['password']) {
        $_SESSION['authenticated'] = true;
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];

       header("Location: ../index.php");

        exit;
    }
}

echo "Try again";

?>