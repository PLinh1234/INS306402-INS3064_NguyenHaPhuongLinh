<?php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();

$sql = "SELECT e.id,
               s.name  AS student_name,
               s.email,
               c.title AS course_title,
               e.enrolled_at
        FROM enrollments e
        JOIN students s ON e.student_id = s.id
        JOIN courses  c ON e.course_id  = c.id
        ORDER BY e.enrolled_at DESC";

$enrollments = $db->fetchAll($sql);

$successMessage = '';
if (isset($_GET['success'])) $successMessage = 'Đăng ký thành công!';
elseif (isset($_GET['deleted'])) $successMessage = 'Xóa đăng ký thành công!';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Danh sách đăng ký học</title>
</head>
<body>

<h1>Danh sách đăng ký học</h1>

<?php if ($successMessage): ?>
<p style="color: green;"><?= htmlspecialchars($successMessage) ?></p>
<?php endif; ?>

<p><a href="create.php">+ Thêm đăng ký</a></p>

<table border="1" cellpadding="8">
<tr>
<th>ID</th>
<th>Sinh viên</th>
<th>Email</th>
<th>Khóa học</th>
<th>Thời gian</th>
<th>Hành động</th>
</tr>

<?php foreach ($enrollments as $e): ?>
<tr>
<td><?= $e['id'] ?></td>
<td><?= htmlspecialchars($e['student_name']) ?></td>
<td><?= htmlspecialchars($e['email']) ?></td>
<td><?= htmlspecialchars($e['course_title']) ?></td>
<td><?= $e['enrolled_at'] ?></td>
<td>
<a href="delete.php?id=<?= $e['id'] ?>"
   onclick="return confirm('Xóa đăng ký này?');">Xóa</a>
</td>
</tr>
<?php endforeach; ?>
</table>

</body>
</html>