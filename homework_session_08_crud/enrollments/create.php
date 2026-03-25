require_once __DIR__ . '/../config/app.php';
<?php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();

// Lấy data dropdown
$students = $db->fetchAll("SELECT id, name FROM students ORDER BY name");
$courses  = $db->fetchAll("SELECT id, title FROM courses ORDER BY title");

$errors = [];
$student_id = 0;
$course_id  = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = (int) ($_POST['student_id'] ?? 0);
    $course_id  = (int) ($_POST['course_id'] ?? 0);

    if ($student_id <= 0) $errors['student'] = 'Chọn sinh viên.';
    if ($course_id <= 0)  $errors['course']  = 'Chọn khóa học.';

    if (empty($errors)) {
        try {
            // Check trùng
            $exists = $db->fetch(
                "SELECT id FROM enrollments WHERE student_id = ? AND course_id = ?",
                [$student_id, $course_id]
            );

            if ($exists) {
                $errors['general'] = 'Đã đăng ký rồi.';
            } else {
                $db->insert('enrollments', [
                    'student_id' => $student_id,
                    'course_id'  => $course_id
                ]);

                header('Location: index.php?success=1');
                exit;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Thêm đăng ký</title>
</head>
<body>

<h1>Thêm đăng ký học</h1>

<?php if (!empty($errors['general'])): ?>
<p style="color:red"><?= htmlspecialchars($errors['general']) ?></p>
<?php endif; ?>

<form method="post">

<div>
<label>Sinh viên:</label><br>
<select name="student_id">
<option value="0">-- Chọn --</option>
<?php foreach ($students as $s): ?>
<option value="<?= $s['id'] ?>" <?= $s['id']==$student_id?'selected':'' ?>>
<?= htmlspecialchars($s['name']) ?>
</option>
<?php endforeach; ?>
</select>
<?php if (!empty($errors['student'])): ?>
<span style="color:red"><?= $errors['student'] ?></span>
<?php endif; ?>
</div>

<div>
<label>Khóa học:</label><br>
<select name="course_id">
<option value="0">-- Chọn --</option>
<?php foreach ($courses as $c): ?>
<option value="<?= $c['id'] ?>" <?= $c['id']==$course_id?'selected':'' ?>>
<?= htmlspecialchars($c['title']) ?>
</option>
<?php endforeach; ?>
</select>
<?php if (!empty($errors['course'])): ?>
<span style="color:red"><?= $errors['course'] ?></span>
<?php endif; ?>
</div>

<br>
<button type="submit">Đăng ký</button>
<a href="index.php">Hủy</a>

</form>

</body>
</html>