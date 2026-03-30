<!--
Developed by: Andrii Shyiko
Date: 01/03/2026
Purpose: Place order page 
Screen Name: Place order
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stock.css">
    <title>Golf Club Admin</title>
    <style>
        .list 
        {
            text-align: center;
        }
    </style>
</head>

<body>

<?php 
session_start();
include 'sidebar_stock.php'; // The side bar menu included in the file, allows navigation through management screens
include 'db.inc.php'; // The DB connection included in the current file
date_default_timezone_set('UTC');
$date = date('Y-m-d H:i:s');
$_SESSION['time'] = $date;

if (isset($_POST['addItem'])) // if user wants to add an item do this
    {
        $desc = $_POST['hiddenDesc'];
        $qty  = $_POST['reorderQty'];
        $stockid_order = $_POST['hiddenStockId'];
                                
        $_SESSION['order_items'][] = // add each item to the session array
        [
            'hiddenDesc' => $desc,
            'quantity'   => $qty,
            'stock_id'   => $stockid_order
        ];
    }
if (isset($_POST['submitBtn'])) // for submission button use this
    {
        $desc = $_POST['hiddenDesc'];
        $qty  = $_POST['reorderQty'];
        $stockid_order = $_POST['hiddenStockId'];
                                
        $_SESSION['order_items'][] = // add each item to the session array
        [
            'hiddenDesc' => $desc,
            'quantity'   => $qty,
            'stock_id'   => $stockid_order
        ];

        $_SESSION['supplierId'] = $_POST['supplierID']; // make supplier id a session variable

        //prevent SQL injection by separating SQL from user data
        $stmt = mysqli_prepare($con, "INSERT INTO order_golf ( supplier_id ) VALUES (?)");

        //treat data as data only, never as executable SQL
        mysqli_stmt_bind_param
        (
            $stmt,"i",
            $_POST['supplierID']
        );
        // Execute the prepared statement
        if (!mysqli_stmt_execute($stmt)) 
            {
                // If execution fails, throw an error
                die("An Error in the SQL Query: " . mysqli_stmt_error($stmt));
            }

        $orderId = mysqli_insert_id($con); // Grab generated order id from its table
        $_SESSION['orderNum'] = $orderId;  // Assign it to the session variable
        foreach ($_SESSION['order_items'] as $item)// Insert into the DB to ordered_item table
        {
            $stmt2 = mysqli_prepare($con, "INSERT INTO order_item (order_num, stock_num, quantity) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param
            (
                $stmt2, "iii", 
                $orderId, 
                $item['stock_id'], 
                $item['quantity']
            );

            if (!mysqli_stmt_execute($stmt2)) 
            {
                die("Error inserting item: " . mysqli_stmt_error($stmt2));
            }
        }

        header('Location: OrderLetter.php'); //go to location at orderletter.php file
        exit;
    }
?>

<!-- Main Content Area Of The Body-->
<main id="stock__item">
    <div class="main-content">
        <div class="card">
            <h2>Place Order</h2>  
            <h2 class='instruction'>Select item to view it's details</h2>
            <div class="select__box select__box--medium"><?php include 'listboxStockItem.php' ?></div> <!--A listbox of stock items-->
            <script> //Integrated JavaScript 

                function populate() //populate fieldboxes with data
                    {
                        var sel = document.getElementById("listbox"); // Get dropdown menu listbox
                        var result;
                        result = sel.options[sel.selectedIndex].value; // Find currently selected option
                        var itemDetails = result.split(','); // string-to-array converter
                        document.getElementById("stock_id").value = itemDetails[0];
                        document.getElementById("description").value = itemDetails[1].trim();  
                        document.getElementById("quantity_in_stock").value = itemDetails[2].trim(); 
                        document.getElementById("reorder_level").value = itemDetails[3].trim(); 
                        document.getElementById("reorder_quantity").value = itemDetails[4].trim(); 
                        document.getElementById("cost_price").value = itemDetails[5].trim(); 
                        document.getElementById("retail_price").value = itemDetails[6].trim();  
                        document.getElementById("supplier_id").value = itemDetails[7].trim();
                    }
            </script>  

            <br><br>
            <form name="myForm" id="myForm" class="main-form"> <!--Form displayed-->

                <div class="input__box">
                    <label for="stock_id">Stock ID </label>
                    <input type = "text" name = "stock_id" id= "stock_id" disabled >
                </div>

                <div class="input__box">
                    <label for="description">Description </label>
                    <input type = "text" name = "description" id= "description" disabled >
                </div>

                <div class="input__box">
                    <label for="quantity_in_stock">Quantity in Stock </label>
                    <input type = "text" name = "quantity_in_stock" id= "quantity_in_stock" disabled >
                </div>

                <div class="input__box">
                    <label for="reorder_level">Reorder Level </label>
                    <input type = "text" name = "reorder_level" id= "reorder_level" disabled >
                </div>

                <div class="input__box">
                    <label for="reorder_quantity">Reorder Quantity </label>
                    <input type = "text" name = "reorder_quantity" id= "reorder_quantity" disabled >
                </div>

                <div class="input__box">
                    <label for="cost_price">Cost Price </label>
                    <input type = "text" name = "cost_price" id= "cost_price" disabled >
                </div>

                <div class="input__box">
                    <label for="retail_price">Retail Price </label>
                    <input type = "text" name = "retail_price" id= "retail_price" disabled >
                </div>

                <div class="input__box">
                    <label for="supplier_id">Supplier ID </label>
                    <input type = "text" name = "supplier_id" id= "supplier_id" disabled >
                </div>

                <br><br>
            </form>

            <h2 class='instruction'>Select a supplier to order items from</h2>
            <div class="select__box select__box--medium"><?php include 'supplierList.php' ?></div> <!--A listbox of suppliers-->
            <script>
                function getStockItems() 
                    {
                        var supplierID = document.getElementById("supplierList").value;
                        document.getElementById("hiddenSupplierID").value = supplierID;
                        
                        // Reset fields when supplier changes
                        document.getElementById("reorderQty").disabled = true;
                        document.getElementById("reorderQty").value = "";
                        document.getElementById("submitBtn").disabled = true;
                        document.getElementById("addItem").disabled = true;

                        if (supplierID === "") //default page settings for the stock item choice
                        {
                            document.getElementById("stockItem").disabled = true;
                            document.getElementById("stockItem").innerHTML = "<option value=''>-- Select a Supplier First --</option>";
                            return;
                        }

                        // fetch is a built-in browser function that sends a request to a URL
                        // .then() says "once the response arrives, do this with it".
                        // response.text() converts the raw response into readable text — the HTML <option> tags that PHP echoed
                        //
                        // Fetch matching stock items via AJAX (Asynchronous JavaScript and XML)
                        fetch("getStockItems.php?supplier_id=" + supplierID)
                            .then(function(response) { return response.text(); })
                            .then(function(html) {
                                document.getElementById("stockItem").innerHTML = html;
                                document.getElementById("stockItem").disabled = false;
                            });
                    }
                function enableQuantity() 
                    {
                        var sel = document.getElementById("stockItem");
                        var result = sel.options[sel.selectedIndex].value;
                        var details = result.split(',');
                        if (!result) return; // Against the default empty option

                        document.getElementById("reorderQty").disabled = false; // Unlock and fill the fieldbox
                        document.getElementById("hiddenStockId").value = details[0].trim();
                        document.getElementById("hiddenDesc").value = details[1].trim();
                        document.getElementById("reorderQty").value = details[2].trim();
                        document.getElementById("submitBtn").disabled = false; // Unlock send button
                        document.getElementById("addItem").disabled = false; // Unlock add item button
                    }
				function confirmForm()
					{
					 return confirm("Are you sure you want to submit this form?");
					}
            </script>

            <form name="orderForm" id="orderForm" onsubmit="return confirmForm()" method="post" class="main-form">
    
                <div class="input__box">
                    <label for="stockItem">Select Stock Item</label>
                    <?php include 'defaultMsg.php' ?> <!--A default message to choose a supplier first-->
                </div>

                <div class="input__box">
                    <label for="reorderQty">Reorder Quantity</label>
                    <input type="number" name="reorderQty" id="reorderQty" min="1" disabled>
                </div>

                <div>
                    <input type="hidden" name="hiddenDesc" id="hiddenDesc">
                </div>
                <div>
                    <input type="hidden" name="hiddenStockId" id="hiddenStockId">
                </div>
                <div>
                    <input type="hidden" name="supplierID" id="hiddenSupplierID">
                </div>

                <div class="button__box">
                    <input type="submit" name="addItem" id="addItem" value="Add" disabled>
                    <input type="submit" name="submitBtn" id="submitBtn" value="Order" disabled>
                </div>
            </form>
        </div>
    </div>
    <?php include 'navbar_staff.php' ?> <!-- Navigation bar file included for the Staff management and for placing an order -->
</main>

</body>
</html>