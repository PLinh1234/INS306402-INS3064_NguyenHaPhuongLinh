require_once __DIR__ . '/../config/app.php';
<?php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();

// Lấy course cho filter
$courses = $db->fetchAll("SELECT id, title FROM courses");

$course_id = $_GET['course_id'] ?? 0;
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// BASE SQL
$sql = "FROM enrollments e
        JOIN students s ON e.student_id = s.id
        JOIN courses c ON e.course_id = c.id";

$params = [];

if ($course_id > 0) {
    $sql .= " WHERE e.course_id = ?";
    $params[] = $course_id;
}

// COUNT tổng
$total = $db->fetch("SELECT COUNT(*) as total $sql", $params)['total'];

// DATA
$data = $db->fetchAll(
    "SELECT e.*, s.name student_name, c.title course_title
     $sql
     ORDER BY e.id DESC
     LIMIT $limit OFFSET $offset",
    $params
);

$totalPages = ceil($total / $limit);
?>

<h1>Enrollments</h1>

<form method="get">
<select name="course_id">
<option value="0">-- Tất cả khóa học --</option>
<?php foreach ($courses as $c): ?>
<option value="<?= $c['id'] ?>" <?= $course_id==$c['id']?'selected':'' ?>>
<?= $c['title'] ?>
</option>
<?php endforeach; ?>
</select>
<button>Lọc</button>
</form>

<table border="1">
<tr><th>ID</th><th>Student</th><th>Course</th></tr>

<?php foreach ($data as $row): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['student_name'] ?></td>
<td><?= $row['course_title'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<br>

<!-- PAGINATION -->
<?php for ($i = 1; $i <= $totalPages; $i++): ?>
<a href="?page=<?= $i ?>&course_id=<?= $course_id ?>">
[<?= $i ?>]
</a>
<?php endfor; ?>