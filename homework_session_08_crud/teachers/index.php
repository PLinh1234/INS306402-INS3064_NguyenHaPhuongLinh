require_once __DIR__ . '/../config/app.php';
<?php
require_once __DIR__ . '/../classes/Database.php';
$db = Database::getInstance();

$teachers = $db->fetchAll("SELECT * FROM teachers");
?>

<h1>Teachers</h1>
<a href="create.php">+ Thêm</a>

<table border="1">
<?php foreach ($teachers as $t): ?>
<tr>
<td><?= $t['name'] ?></td>
<td><?= $t['email'] ?></td>
<td>
<a href="edit.php?id=<?= $t['id'] ?>">Sửa</a>
<a href="delete.php?id=<?= $t['id'] ?>">Xóa</a>
</td>
</tr>
<?php endforeach; ?>
</table>