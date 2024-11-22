<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
} elseif ($_SESSION['usertype'] != 'admin') {
    header("location:login.php");
}

include('db_connection.php');

$id = $_GET['id'];
$sql = "SELECT * FROM courses WHERE id = $id";
$result = mysqli_query($data, $sql);
$course = mysqli_fetch_assoc($result);

if (isset($_POST['update_course'])) {
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];
    $course_credits = $_POST['course_credits'];

    $update_sql = "UPDATE courses SET name = '$course_name', description = '$course_description', credits = '$course_credits' WHERE id = $id";
    $update_result = mysqli_query($data, $update_sql);

    if ($update_result) {
        echo "<script>alert('Course updated successfully');</script>";
        echo "<script>window.location.href = 'view_course.php';</script>";
    } else {
        echo "<script>alert('Failed to update course');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Link to your existing admin styles -->
    <link rel="stylesheet" href="adminhome.css">
    <style>
        label{
            display: inline-block;
            text-align: right;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_deg{
            background-color: skyblue;
            width: 400px;
            padding: 70px 0;
        }
    </style>
</head>
<body>
    <?php include('admin_sidebar.php'); ?>
    <div class="content">
        <center>
            <h2>Update Course</h2>
            <div class="div_deg">
                <form action="update_course.php?id=<?php echo $id; ?>" method="POST" class="form">
                    <div>
                        <label for="course_name">Course Name:</label>
                        <input type="text" id="course_name" name="course_name" value="<?php echo $course['name']; ?>" required>
                    </div>
                    <div>
                        <label for="course_description">Course Description:</label>
                        <textarea id="course_description" name="course_description" rows="4" required><?php echo $course['description']; ?></textarea>
                    </div>
                    <div>
                        <label for="course_credits">Course Credits:</label>
                        <input type="number" id="course_credits" name="course_credits" value="<?php echo $course['credits']; ?>" required>
                    </div>
                    <div>
                        <input type="submit" name="update_course" value="Update" class="btn btn-success">
                    </div>
                </form>
            </div>
        </center>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
