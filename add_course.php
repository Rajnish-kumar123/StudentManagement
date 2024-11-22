<?php
// Database connection (update with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentmanagement";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Message to display success or error
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $course_credits = $_POST['course_credits'];
    $course_description = $_POST['course_description'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO courses1 (course_id, course_name, course_credits, course_description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $course_id, $course_name, $course_credits, $course_description);

    // Execute and handle the result
    if ($stmt->execute()) {
        $message = "New course added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Course</title>
    <link rel="stylesheet" href="adminhome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            font-weight: bold;
            color: green;
        }
        .error {
            color: red;
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
        <h2>Add New Course</h2>

        <!-- Display Success or Error Message -->
        <?php if (!empty($message)) : ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <!-- Course ID -->
            <div class="form-group">
                <label for="course_id">Course ID:</label>
                <input type="text" id="course_id" name="course_id" placeholder="Enter course ID" required>
            </div>

            <!-- Course Name -->
            <div class="form-group">
                <label for="course_name">Course Name:</label>
                <input type="text" id="course_name" name="course_name" placeholder="Enter course name" required>
            </div>

            <!-- Credits -->
            <div class="form-group">
                <label for="course_credits">Credits:</label>
                <input type="number" id="course_credits" name="course_credits" placeholder="Enter course credits" required>
            </div>

            <!-- Course Description -->
            <div class="form-group">
                <label for="course_description">Course Description:</label>
                <textarea id="course_description" name="course_description" rows="4" placeholder="Enter course description"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit">Add Course</button>

        
            <!-- <p style="text-align: center; margin-top: 20px;">
                <a href="view_courses.php">View All Courses</a>
            </p> -->
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
