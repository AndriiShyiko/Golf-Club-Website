<!--
Developed by: Andrii Shyiko
Date: 01/03/2026
Purpose: Place order helper, for getting items
Screen Name: Place order
-->
<?php 
include "db.inc.php";
date_default_timezone_set('UTC');

$supplierID = isset($_GET['supplier_id']) ? intval($_GET['supplier_id']) : 0; //check if there is an id set if not give it a default value

if ($supplierID === 0) // if supplier is not chosen give the default msg
    {
        echo "<option value=''>-- Select a Supplier First --</option>"; //display a default value
        exit;
    }

$sql = "SELECT stock_id, description, reorder_quantity FROM stock_item WHERE supplier_id = $supplierID";

if (!$result = mysqli_query($con, $sql)) 
    {
        die('Error in querying the database' . mysqli_error($con));
    }

echo "<option value=''>-- Select an Item --</option>"; //if a supplier is chosen then display next msg

while ($row = mysqli_fetch_array($result))  
    {
        $desc = $row['description'];
        $qty  = $row['reorder_quantity'];
        $stock_id = $row['stock_id'];

        $allText  = "$stock_id, $desc, $qty";
        echo "<option value='$allText'>$desc</option>";
    }

mysqli_close($con);
?>