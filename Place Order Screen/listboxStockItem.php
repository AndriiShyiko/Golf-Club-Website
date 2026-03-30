<!--
Developed by: Andrii Shyiko
Date: 01/03/2026
Purpose: Getting items to the place order screen
Screen Name: Place order
-->
<?php 
include "db.inc.php"; // include databse connection
date_default_timezone_set('UTC');

$sql = "SELECT * FROM stock_item WHERE deleted = false"; /*make a query*/

if(!$result = mysqli_query($con, $sql)) /*execute the query*/
    {
        die( 'Error in querying the database' . mysqli_error($con));
    }

echo "<br><select name = 'listbox' class='listbox' id = 'listbox' onclick = 'populate()'>"; //when clicked show populated listbox with student

while ($row = mysqli_fetch_array($result)) //go through database and pick everything 
    {
        $id = $row['stock_id'];
        $desc = $row['description'];
        $qInStock = $row['quantity_in_stock'];
        $reLevel = $row['reorder_level'];
        $reQuantity = $row['reorder_quantity'];
        $costPrice = $row['cost_price'];
        $rePrice = $row['retail_price'];
        $supId = $row['supplier_id'];

        $allText = "$id, $desc, $qInStock, $reLevel, $reQuantity, $costPrice, $rePrice, $supId";
        echo "<option value = '$allText'>$desc</option>"; //show on screen picked data
    }
echo "</select>";
mysqli_close($con); //close connection to the database
?>