<!--
Developed by: Andrii Shyiko
Date: 01/03/2026
Purpose: Amending staff members
Screen Name: Amend staff
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stock.css?v=2">
    <title>Golf Club Admin</title>
</head>

<body>

<?php include 'sidebar_stock.php' ?> <!-- The side bar menu included in the file, allows navigation through management screens -->

<!-- Main Content Area -->
<main id="stock__item">
    <div class="main-content">
        <div class="card">
            <h2>Amend/View Staff</h2>
            <h2 class='instruction'>Please select a staff member and then click the amend button if you wish to update</h2>
			
			<div class="select__box select__box--medium">
            <?php include 'listbox.php'?> <!--Connection to the listbox file is included-->
			</div>                   
            <script> //Integrated JavaScript 

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
                        document.getElementById("loginName").value = personDetails[9].trim();
                        document.getElementById("password").value = personDetails[10];
                        document.getElementById("lastUpdated").value = personDetails[11].trim( );
                    }
                function toggleLock() //unlock or lock filedboxes to enter data
                    {
                        if(document.getElementById("amendViewbutton").value == "Amend Details") //unlock
                           {
                                document.getElementById("firstName").disabled = false;
                                document.getElementById("surname").disabled = false;
                                document.getElementById("street").disabled = false;
                                document.getElementById("town").disabled = false;
                                document.getElementById("county").disabled = false;
                                document.getElementById("phoneNum").disabled = false;
                                document.getElementById("jobTitle").disabled = false;
                                document.getElementById("managerStatus").disabled = false;
                                document.getElementById("loginName").disabled = false;
                                document.getElementById("password").disabled = false;
                                document.getElementById("amendViewbutton").value = "View Details";
                            }
                        else // lock
                            {
                                document.getElementById("firstName").disabled = true;
                                document.getElementById("surname").disabled = true;
                                document.getElementById("street").disabled = true;
                                document.getElementById("town").disabled = true;
                                document.getElementById("county").disabled = true;
                                document.getElementById("phoneNum").disabled = true;
                                document.getElementById("jobTitle").disabled = true;
                                document.getElementById("managerStatus").disabled = true;
                                document.getElementById("loginName").disabled = true;
                                document.getElementById("password").disabled = true;
                                document.getElementById("amendViewbutton").value = "Amend Details";
                            } 
                    }
                function confirmCheck() //Confirmation message of changing data inside the database
                    {
                        var response;
                        response = confirm('Are you sure you want to save these changes?');
                        if (response) //confirmed
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
                                document.getElementById("loginName").disabled = false;
                                document.getElementById("password").disabled = false;
                                return true;
                            }
                        else //cancelled
                            {
                                populate();
                                toggleLock();
                                return false;
                            }
                    }
            </script>  

            <br><br>
            <h2>
                <input class="amendButton" type = "button" value = "Amend Details" id="amendViewbutton" onclick = "toggleLock()"> <!--Unlock/lock fieldboxes-->
            </h2>
            <form name="myForm" id="myForm" action="Amend.php" onsubmit="return confirmCheck()" method="post" class="main-form"> <!--Form displayed-->
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
                <div class="input__box">
                    <label for="loginName">Login Name </label>
                    <input type = "text" name = "loginName" id= "loginName" pattern=".{2,50}" disabled >
                </div>

                <div class="input__box">
                    <label for="password">Password </label>
                    <input type = "text" name = "password" id= "password" pattern=".{5,100}" disabled >
                </div>

                <div class="input__box">
                    <label for="lastUpdated">Last Updated </label>
                    <input type = "date" name = "lastUpdated" id= "lastUpdated" disabled >
                </div>

                <br><br>
                <div class="button__box">
                    <input class="submit" id="submitAddStaff" type = "submit" value = "Save" style="display: none;"> <!--Button for saving changes-->
                </div>
            </form>
        </div>
    </div>
    <?php include 'navbar_staff.php' ?>
</main>

<script>
    // create constants from the form
    const stockForm = document.getElementById("myForm");
    const buttonSent = document.getElementById("submitAddStaff");

    // check form validity and choose between block and none
    buttonSent.style.display = stockForm.checkValidity() ? 'block' : 'none';

    // check the input for validity
    stockForm.addEventListener('input', (e) => 
    {
        buttonSent.style.display = stockForm.checkValidity() ? 'block' : 'none';
    })

    // function that removes button sent
    function removeSentBtn() 
    {
        buttonSent.style.display = 'none';
    }

</script>
</body>
</html>