require_once __DIR__ . '/../config/app.php';
<?php
require_once __DIR__ . '/../classes/Database.php';
$db = Database::getInstance();

$id = $_GET['id'];
$db->delete('teachers', 'id = ?', [$id]);

header('Location: index.php');