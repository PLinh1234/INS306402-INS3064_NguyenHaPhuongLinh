<?php
// Trang chủ - điều hướng tới các module
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Enrollment App</title>
<style>
body {
    font-family: Arial;
    background: #f5f5f5;
    text-align: center;
    padding-top: 50px;
}

.container {
    width: 400px;
    margin: auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px #ccc;
}

h1 {
    margin-bottom: 20px;
}

a {
    display: block;
    margin: 10px 0;
    padding: 10px;
    text-decoration: none;
    color: white;
    border-radius: 5px;
}

.students { background: #4CAF50; }
.courses  { background: #2196F3; }
.enroll   { background: #f44336; }

a:hover {
    opacity: 0.8;
}
</style>
</head>
<body>

<div class="container">
    <h1>🎓 Enrollment App</h1>

    <a href="students/index.php" class="students">
        Quản lý Sinh viên
    </a>

    <a href="courses/index.php" class="courses">
        Quản lý Khóa học
    </a>

    <a href="enrollments/index.php" class="enroll">
        Quản lý Đăng ký học
    </a>
</div>

</body>
</html>