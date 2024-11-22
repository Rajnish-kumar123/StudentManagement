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

// कोर्स डेटा निकालें
$sql = "SELECT * FROM courses1";
$result = $conn->query($sql);

// डिलीट एक्शन
if (isset($_GET['delete'])) {
    $course_id = $_GET['delete'];
    $delete_sql = "DELETE FROM courses1 WHERE course_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $stmt->close();
    header("Location: view_courses.php"); // Redirect to refresh the page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Courses</title>
    <link rel="stylesheet" href="adminhome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
            padding:0px;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
        include 'admin_sidebar.php';
    ?>
    <div class="container">
        <h2>Available Courses</h2>
        
        <table>
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Credits</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['course_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_credits']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_description']); ?></td>
                            <td>
                                <a href="update_course.php?course_id=<?php echo $row['course_id']; ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="view_courses.php?delete=<?php echo $row['course_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No courses available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php
$conn->close();
?>
