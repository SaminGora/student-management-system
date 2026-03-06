<?php
include_once('../connection.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location:login.php");
    exit();
}

// Fetch all exams for dropdown
$exams = [];
$exam_query = mysqli_query($conn, "SELECT * FROM exam");
if ($exam_query) {
    while ($row = mysqli_fetch_assoc($exam_query)) {
        $exams[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Exam Data</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
   
</head>
<body>
  <?php include 'includes/sidebar.php'; ?>
  
  <div class="table-data">
    <h2>Exam Data (Sheet View)</h2>
    
    <form method="post" class="form-inline">
      <label>Class ID:</label>
      <input type="number" name="class_id" placeholder="e.g 1" class="form-control form-control-inline" required value="<?php echo isset($_POST['class_id']) ? htmlspecialchars($_POST['class_id']) : ''; ?>">
      
      <label>Exam:</label>
      <select name="exam_id" class="form-control form-control-inline">
          <option value="">-- Select Exam --</option>
          <?php foreach ($exams as $exam): ?>
            <option value="<?php echo $exam['exam_id']; ?>" <?php if(isset($_POST['exam_id']) && $_POST['exam_id'] == $exam['exam_id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($exam['exam_name']); ?>
            </option>
          <?php endforeach; ?>
      </select>

      <input type="submit" name="find" value="Search" class="btn btn-primary">
    </form>

    <div class="table-responsive">
        <?php
        if (isset($_POST['find']) && !empty($_POST['class_id'])) {
            $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
            $exam_id_filter = isset($_POST['exam_id']) && !empty($_POST['exam_id']) ? mysqli_real_escape_string($conn, $_POST['exam_id']) : null;

            // 1. Get Subjects for this specific class
            // We use the subjects table to ensure we have the correct column order and list
            $subject_sql = "SELECT sub_id, sub_name, full_mark FROM subjects WHERE class_id = '$class_id' ORDER BY sub_id ASC";
            $subject_res = mysqli_query($conn, $subject_sql);
            
            $subjects = [];
            while ($sub = mysqli_fetch_assoc($subject_res)) {
                $subjects[$sub['sub_id']] = $sub;
            }

            // 2. Get Students and their Results
            // LEFT JOIN ensures we list students even if they have no results (optional, but good for class sheet)
            $exam_condition = $exam_id_filter ? "AND r.exam_id = '$exam_id_filter'" : "";
            
            $sql = "
                SELECT 
                    sts.student_id,
                    sts.name AS student_name,
                    sts.roll,
                    r.sub_id,
                    r.obtained_marks,
                    e.exam_name
                FROM students sts
                LEFT JOIN result r ON sts.student_id = r.student_id $exam_condition
                LEFT JOIN exam e ON r.exam_id = e.exam_id
                WHERE sts.class_id = '$class_id'
                ORDER BY sts.roll ASC
            ";
            
            $records = mysqli_query($conn, $sql);
            
            $student_data = [];
            if ($records) {
                while ($row = mysqli_fetch_assoc($records)) {
                    $sid = $row['student_id'];
                    if (!isset($student_data[$sid])) {
                        $student_data[$sid] = [
                            'name' => $row['student_name'],
                            'roll' => $row['roll'],
                            'marks' => [],
                            'total' => 0
                        ];
                    }
                    if ($row['sub_id']) {
                        $student_data[$sid]['marks'][$row['sub_id']] = $row['obtained_marks'];
                        $student_data[$sid]['total'] += $row['obtained_marks'];
                    }
                }
            }

            if (empty($subjects) && empty($student_data)) {
                 echo '<div class="alert alert-warning">No subjects or students found for Class ' . htmlspecialchars($class_id) . '.</div>';
            } else {
        ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Roll</th>
                        <th>Student Name</th>
                        <?php foreach ($subjects as $sub): ?>
                            <th><?php echo htmlspecialchars($sub['sub_name']); ?> <br><small>(<?php echo $sub['full_mark']; ?>)</small></th>
                        <?php endforeach; ?>
                        <th>Total Obtained</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($student_data) > 0): ?>
                        <?php foreach ($student_data as $sid => $data): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['roll']); ?></td>
                            <td><?php echo htmlspecialchars($data['name']); ?></td>
                            <?php foreach ($subjects as $sub_id => $sub): ?>
                                <td>
                                    <?php 
                                    if (isset($data['marks'][$sub_id])) {
                                        echo htmlspecialchars($data['marks'][$sub_id]);
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            <?php endforeach; ?>
                            <td><strong><?php echo htmlspecialchars($data['total']); ?></strong></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="<?php echo count($subjects) + 3; ?>" class="text-center">No students found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php 
            } // end else
        } else {
            echo '<p class="text-muted">Please enter a Class ID to view the exam sheet.</p>';
        }
        ?>
    </div>
  </div>

</body>
</html>
