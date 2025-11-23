<?php
include_once("../../connection.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add-homework.css">
    <link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css">
    <title>view homework</title></title>
</head>
<body>
    <?php include 'includes/sidebar.php'?>
    <div class="table-data">
        <h2>Homeworks</h2>
          <?php if(isset($_GET['error'])){?>
            <p class="error"><?php echo $_GET['error'];?></p>
       <?php }?>
       <?php if(isset($_GET['success'])){?>
            <p class="success"><?php echo $_GET['success'];?></p>
       <?php }?>
        <table  class="table table-bordered table-dark">
        <tr>
            <th>S.N</th>
            <th>Title</th>
            <th>Homework For</th>
            <th>Description</th>
            <th>File</th>
            <th>Submission date</th>
            <th>Action</th>
        </tr>
        <?php
        $sql="SELECT * from homework";
        $result=mysqli_query($conn,$sql);
        $serial=1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $serial++ . '</td>';
            echo '<td>' . $row['title'] . '</td>';
            echo '<td>' . $row['hw_for'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';

            if (!empty($row['file_path'])) {
                echo '<td><a href="'.$row['file_path'] . '" target="_blank">📄 View File</a></td>';
            } else {
                echo '<td>No file attached</td>';
            }

            echo '<td>' .$row['sub_date'] . '</td>';
            echo '<td>
            <div class="button">
                    <a href="manage-homework.php?editid='.$row['id'].'"><button class="btn btn-primary">Edit</button></a>
                    <a href="manage-homework.php?deleteid='.$row['id'].'"onclick="return confirm(\'Are you sure you want to delete this homework?\')"><button class="btn btn-secondary">Delete</button></a>
                    <a href="view-upload-homework.php?uploadid='.$row['id'].'"><button class="btn btn-secondary">Uploaded Homework</button></a>
                </div>
                </td>';
            echo '</tr>';
        }
        ?>
        </table>
    </div>
</body>
</html>