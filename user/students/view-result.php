<?php session_start();
include '../../connection.php';
// If not logged in → go back to home.php
 if (!isset($_SESSION['student_id'])) {

   header("Location: ../../index.php");
     exit();
 } 
$student_id =$_SESSION['student_id'];
$exam_id = isset($_POST['submit']) ? $_POST['exam_id'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
    <title>Student Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .result-container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .school-name {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #34495e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #2980b9;
            color: white;
        }

        .summary {
            font-size: 18px;
            margin-top: 10px;
        }

        .summary strong {
            color: #2c3e50;
        }
         .download-btn {
            display: block;
            width: 180px;
            margin: 5px auto;
            padding: 10px 15px;
            background: #3498db;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }

        .download-btn:hover {
            background: #2980b9;
        }
        @media print {
    /* 1. Hide everything on the page */
    body * {
        visibility: hidden;
    }

    /* 2. Make only the result container and its children visible */
    .result-container, .result-container * {
        visibility: visible;
    }

    /* 3. Position the container at the very top-left of the PDF */
    .result-container {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 0;
        padding: 20px;
    }

    /* 4. Hide the download button itself so it doesn't show in the PDF */
    .download-btn {
        display: none;
    }
}
    </style>
</head>
<body>
    <?php include 'includes/sidebar.php'?>
    <div class="container">
        <div class="add-class">
    <form method="post">
        <label>Exam:</label>
        <select name="exam_id" required>
            <option value="">--Select Exam--</option><?php 
        $sql="SELECT * from exam";
        $result=mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['exam_id']."'>".$row['exam_name']."</option>";
        }
        ?>
        </select>
        <input type="submit" value="Select" name="submit">
    </form>
    </div>
    <?php
    if($exam_id){
        
        $sql = "SELECT s.sub_name, s.full_mark, r.obtained_marks, sts.name, sts.class_id
                FROM result r
                JOIN subjects s ON r.sub_id = s.sub_id
                JOIN students sts ON r.student_id = sts.student_id
                WHERE r.student_id = $student_id AND r.exam_id = $exam_id";
        
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result); 

        if($row){ ?>
            <a href="javascript:window.print()" class="download-btn">
                <i class="fas fa-download"></i> Download as PDF
            </a>

            <div class="result-container">
                <div class="school-name">Himalayan Glory English School<br>Ittachhe-2, Bhaktapur</div>

                <h2>Student Result</h2>
                
                <div style="margin-bottom: 20px;">
                    <p><strong>Name:</strong> <?php echo $row['name']?></p>
                    <p><strong>Class:</strong> <?php echo $row['class_id']?></p>
                </div>        

                <table>
                    <tr>
                        <th>Subject</th>
                        <th>Obtained</th>
                        <th>Full Mark</th>
                    </tr>
                    <?php
                    $total_full_marks = 0;
                    $total_obtained = 0;

                    // The "do-while" ensures the first $row we fetched above is printed
                    do {
                        $total_obtained += $row['obtained_marks'];
                        $total_full_marks += $row['full_mark'];
                    ?>
                    <tr>
                        <td><?= $row['sub_name'] ?></td>
                        <td><?= $row['obtained_marks'] ?></td>
                        <td><?= $row['full_mark'] ?></td>
                    </tr>
                    <?php 
                    } while ($row = mysqli_fetch_assoc($result)); 
                    ?>
                </table>

                <div class="summary">
                    <?php
                    // Safety check to avoid division by zero
                    if ($total_full_marks > 0) {
                        $percentage = ($total_obtained / $total_full_marks) * 100;

                        if ($percentage >=90) $grade = "A+";
                        elseif ($percentage >= 80) $grade = "A";
                        elseif ($percentage >= 70) $grade = "B+";
                        elseif ($percentage >= 60) $grade = "B";
                        elseif ($percentage >= 50) $grade = "C+";
                        elseif ($percentage >= 40) $grade = "C";
                        elseif ($percentage >= 35) $grade = "D";
                        else $grade = "Fail";
                    } else {
                        $percentage = 0;
                        $grade = "NG";
                    }
                    ?>
                    <h3>Total: <?= $total_obtained ?> / <?= $total_full_marks ?></h3>
                    <h3>Percentage: <?= round($percentage, 2) ?>%</h3>
                    <h3>Grade: <?= $grade ?></h3>
                </div>
            </div>
        <?php 
        } else {
            echo "<p style='text-align:center; color:gray; margin-top:20px;'>📢 No results found for this exam.</p>"; 
        }
    } ?>
 
   
    </div>
</body>
</html>
