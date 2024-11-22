<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
}

// Include database connection
include('db_connection.php');

// Check if a teacher ID is provided via GET
if (isset($_GET['teacher_id'])) {
    $teacher_id = $_GET['teacher_id'];

    // Fetch teacher data for the given ID
    $sql = "SELECT * FROM teacher WHERE id = '$teacher_id'";
    $result = mysqli_query($data, $sql);

    if (mysqli_num_rows($result) > 0) {
        $teacher_data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Teacher not found!');</script>";
        echo "<script>window.location.href = 'admin_view_teacher.php';</script>";
    }
} else {
    echo "<script>alert('Invalid Request!');</script>";
    echo "<script>window.location.href = 'admin_view_teacher.php';</script>";
}

// Update teacher data when form is submitted
if (isset($_POST['update_teacher'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $upload_path = "images/" . $image;

    // If a new image is uploaded, update the image path
    if ($image) {
        move_uploaded_file($tmp_name, $upload_path);
        $sql_update = "UPDATE teacher SET name = '$name', description = '$description', image = '$upload_path' WHERE id = '$teacher_id'";
    } else {
        // If no new image, update only the name and description
        $sql_update = "UPDATE teacher SET name = '$name', description = '$description' WHERE id = '$teacher_id'";
    }

    $update_result = mysqli_query($data, $sql_update);

    if ($update_result) {
        echo "<script>alert('Teacher updated successfully!');</script>";
        echo "<script>window.location.href = 'admin_view_teacher.php';</script>";
    } else {
        echo "<script>alert('Error updating teacher!');</script>";
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
            width: 700px;
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
                <h1>Update Teacher Information</h1>
                <div class="div_deg">
                    <form action="" method="POST" enctype="multipart/form-data" class="form">
                        <div>
                            <label for="name">Teacher Name:</label>
                            <input type="text" name="name" value="<?php echo $teacher_data['name']; ?>" required>
                        </div><br>
                        <div>
                            <label for="description">Description:</label>
                            <textarea name="description" rows="5" required><?php echo $teacher_data['description']; ?></textarea>
                        </div><br>
                        <div>
                            <label for="image">Image:</label>
                            <input type="file" name="image">
                            <p>Current Image:</p>
                            <img src="<?php echo $teacher_data['image']; ?>" height="100px" width="100px">
                        </div><br>
                        <div>
                            <button   on type="submit" name="update_teacher" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>    
            </center>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>