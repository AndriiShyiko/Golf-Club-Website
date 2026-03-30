<!--
Developed by: Andrii Shyiko
Date: 01/03/2026
Purpose: Delete staff members
Screen Name: Delete staff
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stock.css?v=2">
    <title>Delete Staff</title>
</head>
<body>
    
    <?php include 'sidebar_stock.php' ?> <!-- The side bar menu included in the file, allows navigation through management screens -->
    <main id="stock__item">
        <div class="main-content">
            <div class="card">
                <h2>Delete a Person</h2>
                <h2 class='instruction'>Please select staff and then click the delete button</h2>

				<div class="select__box select__box--medium"><?php include 'listbox.php'; ?></div> <!--A listbox of the staff members-->

                <script>

                function populate() //populate fieldboxes with data
                    {
                        var sel = document.getElementById("listbox"); // Get dropdown menu listbox
                        var result;
                        result = sel.options[sel.selectedIndex].value; // Find currently selected option
                        var personDetails = result.split(','); // string-to-array converter
                        document.getElementById("ID").value = personDetails[0]; //ID 
                        document.getElementById("firstName").value = personDetails[1].trim(); //Name 
                        document.getElementById("surname").value = personDetails[2].trim(); //Surname
                        document.getElementById("street").value = personDetails[3].trim(); //Street
                        document.getElementById("town").value = personDetails[4].trim(); // Town
                        document.getElementById("county").value = personDetails[5].trim(); //County
                        document.getElementById("phoneNum").value = personDetails[6].trim(); // Phone
                        document.getElementById("jobTitle").value = personDetails[7].trim(); // Job Title
                        document.getElementById("managerStatus").checked = (personDetails[8].trim() == "1");// Check if personDetails[8] is "1" or "true" and set the checked state accordingly
                    }

                function confirmCheck()
                {
                    var response;
                    response = confirm('Are you sure you want to delete this person?');
                    if (response)
                    {
                        document.getElementById("ID").disabled = false;
                        document.getElementById("firstName").disabled = false;
                        document.getElementById("surname").disabled = false;
                        document.getElementById("street").disabled = false;
                        document.getElementById("town").disabled = false;
                        document.getElementById("county").disabled = false;
                        document.getElementById("phoneNum").disabled = false;
                        document.getElementById("jobTitle").disabled = false;
                        document.getElementById("managerStatus").disabled = false;

                        return true;
                    }
                    else
                    {
                        populate();
                        return false;
                    }
                }
                </script>

                <p id = "display"> </p>

                <!--On submit confirmation is triggered, OK choice is followed with redirection to the delete.php file-->
                <form name="deleteForm" action="delete.php" onsubmit="return confirmCheck()" method="Post" class="main-form">

                    <div class="input__box">
                                <label for="ID">ID</label>
                                <input type= "text" name= "ID" id="ID" disabled>
                            </div>

                            <div class="input__box">
                                <label for="firstName">First Name </label>
                                <input type = "text" name = "firstName" id= "firstName" pattern="[a-zA-Z\s\.\-']{2,50}" disabled >
                            </div>

                            <div class="input__box">
                                <label for="surname">Surname </label>
                                <input type = "text" name = "surname" id= "surname" pattern="[a-zA-Z\s\.\-']{2,50}" disabled >
                            </div>

                            <div class="input__box">
                                <label for="street">Street </label>
                                <input type = "text" name = "street" id= "street" pattern=".{5,100}" disabled >
                            </div>

                            <div class="input__box">
                                <label for="town">Town </label>
                                <input type = "text" name = "town" id= "town" pattern=".{5,100}" disabled >
                            </div>

                            <div class="input__box">
                                <label for="county">County </label>
                                <input type = "text" name = "county" id= "county" pattern=".{5,100}" disabled >
                            </div>
                            <div class="input__box">
                                <label for="phoneNum">Phone number </label>
                                <input type = "text" name = "phoneNum" id= "phoneNum" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" disabled >    
                            </div>  

                            <div class="input__box">
                                <label for="jobTitle">Job Title </label>
                                <input type = "text" name = "jobTitle" id= "jobTitle" pattern="[a-zA-Z\s\-]{2,50}" disabled >
                            </div>

                            <div class="input__box">
                                <label for="managerStatus">Manager Status </label>
                                <input type="checkbox" value="true" name="managerStatus" id="managerStatus" disabled >
                            </div>

                    <br><br>
                    <div class="button__box">
                        <input type = "submit" value = "Delete"> 
                    </div>
                    <?php
                        if (ISSET($_SESSION["personid"])) { echo "<h1 class='myMessage'>Record deleted for ".
                            $_SESSION["firstname"] . " " .$_SESSION["lastname"]. "</h1>" ;}
                        //session_destroy();
                    ?>
                </form>
            </div>
        </div>
        <?php include 'navbar_staff.php' ?> <!-- Navigation bar file included for the Staff management and for placing an order -->
    </main>
</body>
</html>