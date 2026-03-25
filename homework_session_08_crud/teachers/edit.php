require_once __DIR__ . '/../config/app.php';
<?php
require_once __DIR__ . '/../classes/Database.php';
$db = Database::getInstance();

$id = $_GET['id'];
$teacher = $db->fetch("SELECT * FROM teachers WHERE id = ?", [$id]);

if ($_POST) {
    $db->update('teachers', [
        'name' => $_POST['name'],
        'email' => $_POST['email']
    ], 'id = ?', [$id]);

    header('Location: index.php');
}
?>

<form method="post">
<input name="name" value="<?= $teacher['name'] ?>"><br>
<input name="email" value="<?= $teacher['email'] ?>"><br>
<button>Lưu</button>
</form>