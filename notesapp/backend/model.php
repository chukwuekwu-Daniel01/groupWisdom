<?php 
include('connection.php'); 

function getNotes($user_id) {
    global $connect; 

    $statement = "SELECT note_id, note, timestamp FROM notes WHERE user_id = ? ORDER BY timestamp DESC";
    $prepare = mysqli_prepare($connect, $statement);
    mysqli_stmt_bind_param($prepare, "i", $user_id);
    
    mysqli_stmt_execute($prepare);
    $results = mysqli_stmt_get_result($prepare);
    
    return $results;
}
?>