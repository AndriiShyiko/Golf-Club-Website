<!--
Developed by: Andrii Shyiko
Date: 01/03/2026
Purpose: Delete staff members
Screen Name: Delete staff
-->
<?php 
session_start();
include 'db.inc.php';

$sql = "UPDATE staff SET deleted = true WHERE staff_Id = '$_POST[ID]'";

if (! mysqli_query($con, $sql))
{
    echo "Error " . mysqli_error($con);
}

// Set session variables
$_SESSION["personid"] = $_POST['delid'];
$_SESSION["firstname"] = $_POST['delfirstname'];
$_SESSION["lastname"] = $_POST['dellastname'];

mysqli_close($con);
?>

<script>
window.location = "DeleteStaff.php"
</script>