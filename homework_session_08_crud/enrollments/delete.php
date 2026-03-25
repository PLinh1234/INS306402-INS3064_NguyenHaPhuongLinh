require_once __DIR__ . '/../config/app.php';
<?php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0) {
    $db->delete('enrollments', 'id = ?', [$id]);
}

header('Location: index.php?deleted=1');
exit;