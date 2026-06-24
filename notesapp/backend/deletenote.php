<?php
include "connection.php";



$active_note_id = $_GET['note_id'];


$statement = "DELETE FROM notes WHERE note_id = ?";
$prepare = mysqli_prepare($connect, $statement);
mysqli_stmt_bind_param($prepare, "i", $active_note_id);
mysqli_stmt_execute($prepare);

if (mysqli_stmt_execute($prepare)) {
    header("location: ../index.php");
    exit();
} else {
    echo "there is an error with delete";
};
