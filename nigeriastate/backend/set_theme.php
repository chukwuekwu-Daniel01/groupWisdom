<?php
session_start();

if (isset($_GET['theme'])) {
    $_SESSION['user_theme'] = $_GET['theme'];
}

echo json_encode(['status' => 'success']);
exit;