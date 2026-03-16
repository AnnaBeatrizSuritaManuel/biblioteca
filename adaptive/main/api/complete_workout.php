<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

if (!isLoggedIn()) {
    header('Location: ../pages/login.php');
    exit;
}

$workout_id = (int)($_GET['id'] ?? 0);
$user_id = $_SESSION['user_id'];

if ($workout_id > 0) {
    $conn->query("UPDATE workouts SET status = 'completed' WHERE id = $workout_id AND user_id = $user_id");
}

header('Location: ../pages/calendar.php');
exit;
?>
