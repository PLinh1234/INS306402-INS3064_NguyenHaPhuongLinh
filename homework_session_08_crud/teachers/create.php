require_once __DIR__ . '/../config/app.php';
<?php
require_once __DIR__ . '/../classes/Database.php';
$db = Database::getInstance();

if ($_POST) {
    $db->insert('teachers', [
        'name' => $_POST['name'],
        'email' => $_POST['email']
    ]);
    header('Location: index.php');
}
?>

<form method="post">
<input name="name" placeholder="Tên"><br>
<input name="email" placeholder="Email"><br>
<button>Lưu</button>
</form>