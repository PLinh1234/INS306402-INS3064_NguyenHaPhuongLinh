require_once __DIR__ . '/../config/app.php';
<?php
require_once __DIR__ . '/../classes/Database.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { header('Location: index.php'); exit; }

try {
    $db = Database::getInstance();
    $db->delete('students', 'id = ?', [$id]);
} catch (Exception $e) {
    // Có thể log thêm nếu muốn
}
header('Location: index.php?deleted=1');
exit;