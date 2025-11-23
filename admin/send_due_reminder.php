<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/../vendor/autoload.php';
include_once 'D:/xampp/htdocs/studentmgt/connection.php';

// Get today's date
$today = date('Y-m-d');

// Select unpaid or partially paid fees where due date is within 3 days
$sql = "
SELECT fees.*, students.name, students.email, classes.class_name
FROM fees
JOIN students ON fees.student_id = students.student_id
JOIN classes ON fees.class_id = classes.class_id
WHERE fees.status IN ('Pending', 'Partial')
AND fees.due_date <= DATE_ADD(CURDATE(), INTERVAL 3 DAY)
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$count = 0; // count how many emails sent

while ($row = mysqli_fetch_assoc($result)) {
    $email = $row['email'];
    $name = $row['name'];
    $class = $row['class_name'];
    $month = $row['month'];
    $due_date = $row['due_date'];
    $status = $row['status'];
    $total = $row['total_fee'];
    $paid = $row['paid_amount'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'gorasamin6@gmail.com';  // your Gmail
        $mail->Password   = 'fxgt hzqa dfrt fktv';   // your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('gorasamin6@gmail.com', 'School Admin');
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Fee Payment Reminder - $month ($class)";
        $mail->Body = "
        <p>Dear <strong>$name</strong>,</p>
        <p>This is a gentle reminder that your school fee for the month of <strong>$month</strong> is still <strong>$status</strong>.</p>
        <ul>
            <li>Total Fee: Rs. $total</li>
            <li>Paid: Rs. $paid</li>
            <li>Due Date: $due_date</li>
        </ul>
        <p>Please complete your payment as soon as possible to avoid late penalties.</p>
        <p>Thank you,<br>School Management System</p>
        ";


        $mail->send();
        $count++;
    } catch (Exception $e) {
        error_log("Failed to send email to $email: " . $mail->ErrorInfo);
    }
}

echo "<h3>$count reminder emails sent successfully!</h3>";
?>
