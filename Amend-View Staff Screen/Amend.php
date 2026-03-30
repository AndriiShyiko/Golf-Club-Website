<!--
Developed by: Andrii Shyiko
Date: 01/03/2026
Purpose: Amending staff members
Screen Name: Amend staff
-->
<?php
include 'db.inc.php';

date_default_timezone_set('UTC');

$managerStatus = isset($_POST['managerStatus']) ? 1 : 0;
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = mysqli_prepare($con, "UPDATE staff SET 
    first_name = ?, 
    surname = ?, 
    street = ?, 
    town = ?, 
    county = ?, 
    phone_num = ?, 
    job_title = ?, 
    manager_status = ?, 
    login_name = ?, 
    password = ? 

    WHERE staff_id = ?");

 //treat data as data only, never as executable SQL
    mysqli_stmt_bind_param
    (
        $stmt,"sssssssissi", //all values data types
        $_POST['firstName'],
        $_POST['surname'],
        $_POST['street'],
        $_POST['town'],
        $_POST['county'],
        $_POST['phoneNum'],
        $_POST['jobTitle'],
        $managerStatus,
        $_POST['loginName'],
        $hashed_password,
        $_POST['ID']
    );

if (!mysqli_stmt_execute($stmt))
    {
        echo "Error " . mysqli_error($con);
    }        
else
    {
        if(mysqli_affected_rows($con) != 0)
            {
                echo mysqli_affected_rows($con) . "record(s) updated <br>";
                echo "Person ID " . $_POST['ID'] . ", " . $_POST['firstName'] . " " . $_POST['surname'] . " has been updated";                
            }
        else
            {
                echo "No records were changed";
            }
    }
mysqli_close($con);
?>
<script>
window.location = "AmendView.php"
</script>