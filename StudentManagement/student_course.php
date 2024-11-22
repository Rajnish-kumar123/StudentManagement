<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
} elseif ($_SESSION['usertype'] != 'student') {
    header("location:login.php");
}

include('db_connection.php');

// Fetch courses from the database
$sql = "SELECT * FROM courses";
$result = mysqli_query($data, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="adminhome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        table, .table_th, .table_td{
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
        include('student_sidebar.php');
    ?>
    <div class="content">
        <center>
            <h1>Student Dashboard</h1>
            <br><br>
            <table>
                <tr>
                    <th class="table_th">ID</th>
                    <th class="table_th">Course</th>
                    <th class="table_th">Description</th>
                    <th class="table_th">Credit</th>
                </tr>    
                <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td class='table_td'>{$row['id']}</td>
                                <td class='table_td'>{$row['name']}</td>
                                <td class='table_td'>{$row['description']}</td>
                                <td class='table_td'>{$row['credits']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No courses available</td></tr>";
                    }
                    ?>
            </table>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>