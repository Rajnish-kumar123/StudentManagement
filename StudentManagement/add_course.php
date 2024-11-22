<?php
session_start();

    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }elseif($_SESSION['usertype']=='student'){
        header("location:login.php");
    }

    include('db_connection.php');

    if (isset($_POST['add_course'])) {
        $course_name = $_POST['course_name'];
        $course_description = $_POST['course_description'];
        $course_credits = $_POST['course_credits'];

        $sql = "INSERT INTO courses (name, description, credits) VALUES ('$course_name', '$course_description', '$course_credits')";

        $result = mysqli_query($data, $sql);

        if ($result) {
            echo "<script>alert('Course added successfully');</script>";
        } else {
            echo "<script>alert('Failed to add course');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminhome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .div_deg{
            background-color: skyblue;
            width: 500px;
            padding: 70px 0;
        }
    </style>
</head>
<body>
    <?php
        include 'admin_sidebar.php';
    ?>
    <div class="content">
        <center>
            <h1>Add Course</h1>
            <div class="div_deg">
                <form action="add_course.php" method="POST">
                    <div>
                        <label for="course_name">Course Name:</label>
                        <input type="text" id="course_name" name="course_name" required>
                    </div><br>
                    <div>
                        <label for="course_description">Course Description:</label>
                        <textarea id="course_description" name="course_description" rows="4" required></textarea>
                    </div><br>
                    <div>
                        <label for="course_credits">Course Credits:</label>
                        <input type="number" id="course_credits" name="course_credits" required>
                    </div><br>
                    <div>
                        <button type="submit" name="add_course" class="btn btn-primary">Add Course</button>
                    </div>
                </form>
            </div>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>