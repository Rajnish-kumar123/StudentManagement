<?php
// डेटाबेस कनेक्शन (अपना डेटा यहां अपडेट करें)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentmanagement";

// कनेक्शन बनाएं
$conn = new mysqli($servername, $username, $password, $dbname);

// कनेक्शन चेक करें
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// कोर्स का ID प्राप्त करें
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    // कोर्स डेटा प्राप्त करें
    $sql = "SELECT * FROM courses1 WHERE course_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $course = $result->fetch_assoc();
    } else {
        echo "Course not found!";
        exit();
    }
}

// कोर्स को अपडेट करने का कोड
if (isset($_POST['update_course'])) {
    $course_name = $_POST['course_name'];
    $course_credits = $_POST['course_credits'];
    $course_description = $_POST['course_description'];

    // SQL UPDATE क्वेरी
    $update_sql = "UPDATE courses1 SET course_name = ?, course_credits = ?, course_description = ? WHERE course_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sisi", $course_name, $course_credits, $course_description, $course_id);

    if ($stmt->execute()) {
        echo "<script>alert('Course updated successfully!'); window.location.href='view_courses.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
    <link rel="stylesheet" href="adminhome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
        }
        .btn {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Course</h2>
        <form method="POST" action="update_course.php?course_id=<?php echo $course_id; ?>">
            <div class="mb-3">
                <label for="course_name" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo htmlspecialchars($course['course_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="course_credits" class="form-label">Credits</label>
                <input type="number" class="form-control" id="course_credits" name="course_credits" value="<?php echo htmlspecialchars($course['course_credits']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="course_description" class="form-label">Description</label>
                <textarea class="form-control" id="course_description" name="course_description" rows="4" required><?php echo htmlspecialchars($course['course_description']); ?></textarea>
            </div>
            <button type="submit" name="update_course" class="btn btn-success">Update Course</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
