<?php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();
$errors = [];
$title = '';
$code = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $code  = trim($_POST['code'] ?? '');

    // Validate
    if ($title === '') $errors['title'] = 'Vui lòng nhập tên khóa học.';
    if ($code === '')  $errors['code']  = 'Vui lòng nhập mã khóa học.';

    if (empty($errors)) {
        try {
            // Check trùng code
            $existing = $db->fetch(
                'SELECT id FROM courses WHERE code = ?',
                [$code]
            );

            if ($existing) {
                $errors['code'] = 'Mã khóa học đã tồn tại.';
            } else {
                // INSERT ĐÚNG CỘT
                $db->insert('courses', [
                    'title' => $title,
                    'code'  => $code
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
<title>Thêm khóa học</title>
</head>
<body>

<h1>Thêm khóa học mới</h1>

<form method="post">

<div>
<label>Tên khóa học:</label><br>
<input type="text" name="title" value="<?= htmlspecialchars($title) ?>">
<?php if (!empty($errors['title'])): ?>
<span style="color: red;"><?= htmlspecialchars($errors['title']) ?></span>
<?php endif; ?>
</div>

<div>
<label>Mã khóa học:</label><br>
<input type="text" name="code" value="<?= htmlspecialchars($code) ?>">
<?php if (!empty($errors['code'])): ?>
<span style="color: red;"><?= htmlspecialchars($errors['code']) ?></span>
<?php endif; ?>
</div>

<br>
<button type="submit">Lưu</button>
<a href="index.php">Hủy</a>

</form>

</body>
</html>