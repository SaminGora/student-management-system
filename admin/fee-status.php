<?php
include_once('../connection.php');
$class=$_GET['class'];
if(isset($_POST['add-fee'])) {
    $student_id = $_POST['student_id'];
    $class_id = $class;
    $month = $_POST['month'];
    $total_fee = $_POST['total_fee'];
    $paid_amount = $_POST['paid_amount'];
    $due_date = $_POST['due_date'];

    if ($paid_amount == 0) {
        $status = 'Pending';
    } elseif ($paid_amount < $total_fee) {
        $status = 'Partial';
    } else {
        $status = 'Paid';
    }

    $sql = "INSERT INTO fees (student_id, class_id, month, total_fee, paid_amount, due_date, payment_date, status)
            VALUES ('$student_id', '$class_id', '$month', '$total_fee', '$paid_amount', '$due_date', CURDATE(), '$status')";

    if (mysqli_query($conn, $sql)) {
        header("Location:fee-status.php?success=Fee added successfully");
        exit();
    } else {
        header("Location:fee-status.php?error=Database error");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
     <link rel="stylesheet" href="/studentmgt/admin/css/fee-status.css">
    <title>Add Fee</title>
</head>
<body>
    <?php include'includes/sidebar.php';?>
    <div class="container">
    <h2>Add Students</h2>
    <form method="POST">
         <?php
    if(isset($_GET['error'])){?>
        <p class="error"><?php echo $_GET['error'];?></p>
    <?php }?>
    <?php
    if(isset($_GET['success'])){?>
        <p class="success"><?php echo $_GET['success'];?></p>
    <?php }?>
  <label>Student:</label>
  <select name="student_id" required>
    <?php
    $students = mysqli_query($conn, "SELECT student_id, name FROM students where class_id=$class order by roll DESC");
    while ($row = mysqli_fetch_assoc($students)) {
      echo "<option value='{$row['student_id']}'>{$row['name']}</option>";
    }
    ?>
  </select><br>

  <label>Month:</label>
  <input type="text" name="month" placeholder="e.g. October 2025" required><br>

  <label>Total Fee:</label>
  <input type="number" name="total_fee" step="0.01" required><br>

  <label>Paid Amount:</label>
  <input type="number" name="paid_amount" step="0.01" required><br>

  <label>Due Date:</label>
  <input type="date" name="due_date" required><br>

  <input type="submit" name="add-fee" value="Add Fee" class="btn btn-primary">
</form>
</div>
</body>
</html>