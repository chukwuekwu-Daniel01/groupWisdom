<?php 
session_start();
include "connection.php"; 


if (!isset($_SESSION['user_id'])) {
    header("location: ../login.php"); 
    exit;
}

if (empty(trim($_POST['note']))) {
    header("location: ../index.php"); 
    exit;
}

$active_user_id = $_SESSION['user_id'];
$note_text = trim($_POST['note']);

// 3. Secure Prepared Statement
// Notice we skip the 'timestamp' column entirely. MySQL handles it automatically.
$statement = "INSERT INTO notes (user_id, note) VALUES (?, ?)";
$prepare = mysqli_prepare($connect, $statement);

// Bind params: 'i' for Integer (user_id), 's' for String (note)
mysqli_stmt_bind_param($prepare, "is", $active_user_id, $note_text);


if (mysqli_stmt_execute($prepare)) {

    header("location: ../index.php");
    exit;
} else {
    // If something goes wrong, show the error (useful for debugging)
    die("Error saving note: " . mysqli_error($connect));
}
?>