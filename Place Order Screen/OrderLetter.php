<!--
Developed by: Andrii Shyiko
Date: 01/03/2026
Purpose: Letter of the succesful order for the Place order screen
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
        .par1
        {
            font-weight: bold;
            font-size:25px ;
        }
        .par2
        {
            display:flex;
            flex-direction: row;
            justify-content:flex-end ;
            font-size: 15px;
        }
        .par3
        {
            display:flex;
            flex-direction: row;
            justify-content: start;
            font-size: 15px;
        }
        .par4
        {
            font-size: 15px;
        }
        .orderNumber
        {
            display: flex;
            flex-direction: row;
            justify-content: center;
            font-size: 15px;
        }
        .itemsOrdered
        {
            display: flex;
            flex-direction: row;
            justify-content: center;

            font-size: 25px;
        }
        .footer
        {
            display: flex;
            flex-direction: row;
            justify-content: center;
            font-size: 15px;
            margin-bottom: 15px;
        }
        .letter
        {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%; /* Adapt form shape */
            max-width: 1200px; /* Limit max width */
            padding: 30px;
            font-size: 15px;
        }
        table 
        {
            width: 50%;/* Center the table block in its container */
            margin: 20px auto; /*Center a block-level element horizontally */
            border-collapse: collapse; /* Merge double borders for a nicer look */
        }
        th, td 
        {
            /* Center the content inside the cells */
            text-align: center; 
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>

<?php 
session_start();
include 'sidebar_stock.php'; // The side bar menu included in the file, allows navigation through management screens
include 'db.inc.php'; // The DB connection included in the current file

$date = $_SESSION['time'] ?? 'No time set';
$suppID = $_SESSION['supplierId'];

$items = $_SESSION['order_items'] ?? [];

// Declaration of the supplier details
$supplierName   = '';
$supplierStreet = '';
$supplierTown   = '';
$supplierCounty = '';

$sql = "SELECT supplier_name, street, town, county FROM supplier WHERE supplier_Id = $suppID"; //Access the database and save names of the supplier of the stock items
    if ($result = mysqli_query($con, $sql)) 
    {
        $row = mysqli_fetch_array($result);
        $supplierName   = $row['supplier_name'] . ",";
        $supplierStreet = $row['street'] . ",";
        $supplierTown   = $row['town'] . ",";
        $supplierCounty = $row['county'] . ".";
    }
?>

<!-- Main Content Area Of The Body-->
<main id="stock__item">
    <div class="main-content">
        <div class="card">
            <p class="par1" >Order Letter to Supplier</p>  
            
            <div class="letter">

                <p class="par2">Golf Club,</p>
                <p class="par2">Carlow</p>
                <p class="par2"><?php echo $date ?></p>

                <p class="par3" name="suppName" id="suppName"> <?php echo $supplierName; ?> </p>
                <p class="par3" name="street" id="street"> <?php echo $supplierStreet; ?> </p>
                <p class="par3" name="town" id="town"> <?php echo $supplierTown; ?> </p>
                <p class="par3" name="county" id="county"> <?php echo $supplierCounty; ?> </p>
                
                <p class="orderNumber">Order Number: <?php echo $_SESSION['orderNum']; ?> </p>

                <p class="par4">Please supply the following stock: </p>
                <!--Seperate item and quantity display-->
                <div>
                    <table>
                        <tr>
                            <th>Description</th>
                            <th>Quantity</th>
                        </tr>
                        <?php foreach ($items as $item): ?>
                            <?php echo "<tr><td>" . $item['hiddenDesc'] . "</td>"; ?> 
                            <?php echo "<td>" . $item['quantity'] . "</td></tr>"; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <p class="footer">Kind regards,</p>
                <p class="footer">Administrator,</p>
                <p class="footer">Pagasus Club.</p>
            </div>
        </div>
    </div>
    <?php include 'navbar_staff.php' ?>
</main>
<?php 
unset($_SESSION['order_items']);
unset($_SESSION['supplierId']); 
?>
</body>
</html>