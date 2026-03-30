<!--
Developed by: Andrii Shyiko
Date: 01/03/2026
Purpose: Supplier list for the place order page
Screen Name: Place order
-->
<?php 
include "db.inc.php"; // include databse connection
date_default_timezone_set('UTC');

$sql = "SELECT supplier_id, supplier_name FROM supplier"; /*make a query*/

if(!$result = mysqli_query($con, $sql)) /*execute the query*/
    {
        die( 'Error in querying the database' . mysqli_error($con));
    }

echo "<br><select name = 'supplierList' class='listbox' id = 'supplierList' onchange = 'getStockItems()'>"; //when clicked show populated listbox with student
echo "<option value=''>-- Select a Supplier --</option>";
while ($row = mysqli_fetch_array($result)) //go through database and pick everything 
    {
        $id = $row['supplier_id'];
        $name = $row['supplier_name'];

        echo "<option value = '$id'>$id - $name</option>"; //show on screen picked data
    }
echo "</select>";
mysqli_close($con); //close connection to the database
?>