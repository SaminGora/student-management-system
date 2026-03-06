<?php
include_once("connection.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border=1 style="border-collapse:collapse;">
    <tr>
        <th>Name</th>
        <th>Roll</th>
        <th>Contact</th>
        <th>Attendence</th>
   </tr>
   <?php
   $sql="SELECT * FROM class12";
   $result=$conn->query($sql);
   while($row=$result->fetch_assoc()){
   ?>
   <tr>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['roll'];?></td>
    <td><?php echo $row['contact'];?></td>
    <td>
    Present
    <input type="radio" required name="attendence[<?php echo $row['roll'];?>]" value="present">
    Absent
    <input type="radio" required name="attendence[<?php echo $row['roll'];?>]" value="absent">

    </td>
   </tr>
   <?php }?>

    </table>
</body>
</html>