<?php
session_start();

    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }elseif($_SESSION['usertype']=='student'){
        header("location:login.php");
    }

    include('db_connection.php');

    $sql = "SELECT * FROM courses";
    $result = mysqli_query($data, $sql);

    // Handle delete action
    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        $delete_sql = "DELETE FROM courses WHERE id = $id";
        $delete_result = mysqli_query($data, $delete_sql);

        if ($delete_result) {
            echo "<script>alert('Course deleted successfully');</script>";
            echo "<script>window.location.href = 'view_course.php';</script>";
        } else {
            echo "<script>alert('Failed to delete course');</script>";
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
        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .table_th{
            padding: 20px;
            font-size: 20px;
            
        }
        .table_td{
            padding: 20px;
            background-color: skyblue;
        }
    </style>
</head>
<body>
    <?php
        include 'admin_sidebar.php';
    ?>

    <div class="content">
        <center>
            <h1>Courses List</h1>
            <table>
                <tr>
                    <th class="table_th">ID</th>
                    <th class="table_th">Course Name</th>
                    <th class="table_th">Description</th>
                    <th class="table_th">Credits</th>
                    <th class="table_th">Delete</th>
                    <th class="table_th">Update</th>

                </tr>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td class='table_td'>{$row['id']}</td>
                                <td class='table_td'>{$row['name']}</td>
                                <td class='table_td'>{$row['description']}</td>
                                <td class='table_td'>{$row['credits']}</td>
                                <td class='table_td'>
                                    <a href='view_course.php?delete_id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this course?');\" class='btn btn-danger'>Delete</a>
                                </td>
                                <td class='table_td'>
                                    <a href='update_course.php?id={$row['id']}' class='btn btn-success'>Update</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No courses found</td></tr>";
                    }
                    ?>
            </table>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>