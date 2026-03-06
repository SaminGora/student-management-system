<?php
include '../connection.php';
include 'includes/sidebar.php';
     session_start();
// If not logged in → go back to home.php
if (!isset($_SESSION['admin_id'])) {
    header("Location:login.php");
    exit();
} 
if (isset($_POST['save_marks'])) {

    $student_id = $_POST['student_id'];
    $exam_id    =  $_POST['exam_id'];

    foreach ($_POST['marks'] as $subject_id => $marks) {

        $sql = "INSERT INTO result 
                (student_id, sub_id, exam_id, obtained_marks)
                VALUES 
                ('$student_id', '$subject_id', '$exam_id', '$marks')";

        mysqli_query($conn, $sql);
    }

    echo "<script>alert('Result inserted successfully');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
    <title>Document</title>
</head>
<body>
 <div class="container">
    <div class="sub-head">
    <h2>Add Result</h2>
    <p><a href="dashboard.php">Dashboard</a>/Add Result</p>
    </div>
    <div class="add-result">
<!-- CLASS SELECTION FORM -->
<form method="POST">
    Class:
       <select name="class_id" id="class_id" required onchange="this.form.submit()">
          <option value="">-- Select Class --</option>
        <?php
      include_once("../connection.php");
      $sql = "SELECT class_id, class_name FROM classes";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['class_id']."'>".$row['class_name']."</option>";
      }
    ?>
  </select>
</form>

<hr>

<?php
/* SHOW RESULT ENTRY FORM ONLY AFTER CLASS SELECTED */
if (isset($_POST['class_id'])) {

    $class_id = $_POST['class_id'];

    $students = mysqli_query($conn, "SELECT * FROM students WHERE class_id = $class_id order by roll asc");
    $subjects = mysqli_query($conn, "SELECT * FROM subjects WHERE class_id = $class_id");
    $exams    = mysqli_query($conn, "SELECT * FROM exam");
?>

   
    <form method="POST">
        
        <input type="hidden" name="class_id" value="<?= $class_id ?>">

        Student:
        <select name="student_id" required>
            <option value="">Select Student</option>
            <?php while ($s = mysqli_fetch_assoc($students)) { ?>
                <option value="<?= $s['student_id'] ?>">
                    <?= $s['name'] ?>
                </option>
            <?php } ?>
        </select>
        <br><br>

        Exam:
        <select name="exam_id" required>
            <option value="">Select Exam</option>
            <?php while ($e = mysqli_fetch_assoc($exams)) { ?>
                <option value="<?= $e['exam_id'] ?>">
                    <?= $e['exam_name'] ?> (<?= $e['year'] ?>)
                </option>
            <?php } ?>
        </select>

        <br><br>

        <h3>Enter Marks</h3>

        <?php while ($sub = mysqli_fetch_assoc($subjects)) { ?>
            <?= $sub['sub_name'] ?> :
            <input type="number"
                   name="marks[<?= $sub['sub_id'] ?>]"
                   max="<?= $sub['full_mark'] ?>"
                   required>
            <br><br>
        <?php } ?>

        <button type="submit" class="add-btn" name="save_marks">Save Result</button>
    </form>
    </div>
<?php } ?>
</body>
</html>