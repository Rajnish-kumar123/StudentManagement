<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentmanagement";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch students and courses
$students_sql = "SELECT student_id, student_name FROM students";
$courses_sql = "SELECT course_id, course_name FROM courses1";
$students_result = $conn->query($students_sql);
$courses_result = $conn->query($courses_sql);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];

    $insert_sql = "INSERT INTO student_courses (student_id, course_id) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ii", $student_id, $course_id);
    if ($stmt->execute()) {
        $message = "Course assigned successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Assign Course to Student</h2>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="student_id" class="form-label">Select Student</label>
                <select name="student_id" id="student_id" class="form-control" required>
                    <option value="">-- Select Student --</option>
                    <?php while ($row = $students_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['student_id']; ?>">
                            <?php echo htmlspecialchars($row['student_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="course_id" class="form-label">Select Course</label>
                <select name="course_id" id="course_id" class="form-control" required>
                    <option value="">-- Select Course --</option>
                    <?php while ($row = $courses_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['course_id']; ?>">
                            <?php echo htmlspecialchars($row['course_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Assign Course</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>
