<?php 
include '../connection.php';
$class = $_GET['class'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
   <link rel="stylesheet" href="/studentmgt/admin/css/fee-status.css">
  <title>View Fee</title>
</head>
<body>
<?php include'includes/sidebar.php';?>
<div class="table-data">
<form method="post">
  <label>Month:</label>
  <input type="search" placeholder="e.g jan" name="search">
  <input type="submit" name="find" value="Find">
</form>

<?php
if(isset($_POST['find'])){
    $var = trim($_POST['search']);
    $sql = "
    SELECT fees.*, students.name, classes.class_name 
    FROM fees
    JOIN students ON fees.student_id = students.student_id
    JOIN classes ON fees.class_id = classes.class_id
    WHERE classes.class_id = '$class'
    AND LOWER(fees.month) LIKE LOWER('%$var%')
    ORDER BY fees.fee_id DESC";
} else {
    $sql = "
    SELECT fees.*, students.name, classes.class_name 
    FROM fees
    JOIN students ON fees.student_id = students.student_id
    JOIN classes ON fees.class_id = classes.class_id
    WHERE classes.class_id = '$class'
    ORDER BY fees.fee_id DESC";
}

$result = mysqli_query($conn, $sql);
?>

<table class="table table-striped">
<tr>
  <th>Student</th>
  <th>Class</th>
  <th>Month</th>
  <th>Total Fee</th>
  <th>Paid</th>
  <th>Status</th>
  <th>Due Date</th>
  <th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
  <td><?php echo $row['name']; ?></td>
  <td><?php echo $row['class_name']; ?></td>
  <td><?php echo $row['month']; ?></td>
  <td><?php echo $row['total_fee']; ?></td>
  <td><?php echo $row['paid_amount']; ?></td>
  <td style="color:<?php 
        echo ($row['status']=='Paid' ? 'green' : ($row['status']=='Partial' ? 'orange' : 'red')); 
      ?>;">
      <?php echo $row['status']; ?>
  </td>
  <td><?php echo $row['due_date']; ?></td>
  <td><a href="edit-fee.php?feeid=<?php echo $row['fee_id']; ?>">Edit</a></td>
</tr>
<?php } ?>
</table>
</div>

</body>
</html>
