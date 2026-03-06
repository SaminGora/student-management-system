<?php
include_once('../connection.php');
session_start();
// If not logged in → go back to home.php
if (!isset($_SESSION['admin_id'])) {
    header("Location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Students</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
</head>
<body>
  <?php include 'includes/sidebar.php'?>
  <div class="table-data">
    <h2>Search Students</h2>
    <div class="search-container" style="margin-bottom: 20px;">
        <form method="post">
            <input type="text" name="search_query" placeholder="Search by Name, Roll, or Class ID..." class="form-control" style="width: 300px; display: inline-block;" required>
            <input type="submit" name="do_search" value="Search" class="btn btn-primary" style="background: #2563eb;">
        </form>
    </div>
    
    <div class="table">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Student Id</th>
                <th>Name</th>
                <th>Class</th>
                <th>Roll</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Parent's Name</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($_POST['do_search'])){
            $search = mysqli_real_escape_string($conn, $_POST['search_query']);
            $sql = "SELECT * FROM students WHERE name LIKE '%$search%' OR roll LIKE '%$search%' OR class_id LIKE '%$search%'";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0){
                $serial = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                    <td>'.$serial++.'</td>
                    <td>'.$row['student_id'].'</td>
                     <td>'.$row['name'].'</td>
                     <td>'.$row['class_id'].'</td>
                     <td>'.$row['roll'].'</td>
                     <td>'.$row['gender'].'</td>
                     <td>'.$row['email'].'</td>
                     <td>'.$row['parent_name'].'</td>
                     <td>'.$row['contact'].'</td>
                    <td>
                    <div class="button">
                    <a href="manage-student.php?editid='.$row['student_id'].'"><button class="btn btn-primary">Edit</button></a>
                    <a href="manage-student.php?deleteid='.$row['student_id'].'" onclick="return confirm(\'Are you sure you want to delete?\')"><button class="btn btn-secondary">Delete</button></a>
                    </div>
                    </td>
                    </tr>';
                }
            } else {
                echo '<tr><td colspan="10" style="text-align:center;">No students found matchingResult "'.$search.'"</td></tr>';
            }
        } else {
            echo '<tr><td colspan="10" style="text-align:center;">Enter a search term above to find students.</td></tr>';
        }
        ?>
        </tbody>
    </table>
    </div>
  </div>
</body>
</html>
