<?php
session_start();

    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }elseif($_SESSION['usertype']=='student'){
        header("location:login.php");
    }
    //db connection to show teacher data
    include('db_connection.php');

    $sql = "SELECT * FROM teacher";
    $result = mysqli_query($data, $sql);

    //deleting the teacher 
    if($_GET['teacher_id']){
        $t_id = $_GET['teacher_id'];

        $sql2 = "DELETE FROM teacher WHERE id = '$t_id' ";
        $result2 = mysqli_query($data, $sql2);

        if($result2){
            header('location:admin_view_teacher.php');
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
            <h1>View All Teacher Data</h1>

            <table>
                <tr>
                    <th class="table_th">Teacher Name</th>
                    <th class="table_th">About Teacher</th>
                    <th class="table_th">Image</th>
                    <th class="table_th">Delete</th>
                </tr>
                <?php
                    while($info = $result->fetch_assoc()){
                ?>
                <tr>
                    <td class="table_td"><?php echo "{$info['name']}" ?></td>
                    <td class="table_td"><?php echo "{$info['description']}" ?></td>
                    <td class="table_td"><img src="<?php echo "{$info['image']}" ?>" height="100px" width="100px"></td>
                    <td class="table_td">
                        <?php
                        echo"
                        <a onClick=\"javascript:return confirm('Are You Sure to Delete');\" href='admin_view_teacher.php?teacher_id={$info['id']}' class='btn btn-danger'>Delete</a>
                        ";
                        ?>
                    </td>
                </tr>
                <?php 
                }   
                ?>
            </table>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>