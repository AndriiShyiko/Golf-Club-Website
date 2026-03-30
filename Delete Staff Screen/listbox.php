<!--
Developed by: Andrii Shyiko
Date: 01/03/2026
Purpose: Get staff members details
Screen Name: Amend/View Staff
-->
<?php 
include "db.inc.php"; // include databse connection
date_default_timezone_set('UTC');

$sql = "SELECT staff_id, first_name, surname, street, town, county, phone_num, job_title, manager_status, login_name, password, last_updated FROM staff WHERE deleted = false"; /*make a query*/

if(!$result = mysqli_query($con, $sql)) /*execute the query*/
    {
        die( 'Error in querying the database' . mysqli_error($con));
    }

echo "<br><select name = 'listbox' class='listbox' id = 'listbox' onclick = 'populate()'>"; //when clicked show populated listbox with student

while ($row = mysqli_fetch_array($result)) //go through database and pick everything 
    {
        $id = $row['staff_id'];
        $fname = $row['first_name'];
        $sname = $row['surname'];
        $Street = $row['street'];
        $Town = $row['town'];
        $County = $row['county'];
        $Phone = $row['phone_num'];
        $JobTitle = $row['job_title'];
        $ManagerStat = $row['manager_status'];
        $LoginName = $row['login_name'];
        $Password = $row['password'];

        $Update = date("Y-m-d", strtotime($row['last_updated']));

        $allText = "$id, $fname, $sname, $Street, $Town, $County, $Phone, $JobTitle, $ManagerStat, $LoginName, $Password, $Update";
        echo "<option value = '$allText'>$fname $sname</option>"; //show on screen picked data
    }
echo "</select>";
mysqli_close($con); //close connection to the database
?>