<!--
Developed by: Andrii Shyiko
Date: 01/03/2026
Purpose: Adding new staff members
Screen Name: Add staff 
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stock.css">
    <title>Golf Club Pegasus</title>
    <style>
        .managerS
        {
            display:flex;
            align-items: center;
            gap: 8px;
        }
        .managersStat 
        {
            margin: 0;
            font-size: 1rem;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>

<?php include 'sidebar_stock.php' ?> <!-- The side bar menu included in the file, allows navigation through management screens -->

<!-- Main Content Area Of The Body-->
<main id="stock__item">
    <div class="main-content">
        <div class="card">
            <h2>Add Staff</h2>
			<!-- When submit Form is hit, redirection to the create.php executes -->
            <form action="create.php" method="Post" id="staffForm" onsubmit="return confirmForm()" class="main-form">
                <div class="input__box">
                    <label for="firstname">First Name</label> <!--firstname-->
                    <input type="text" name="firstname" id="firstname" title="Enter a name (Characters in range 2-50, no digits)" placeholder="Max (Characters in range 2-50, no digits)" pattern="[a-zA-Z\s\.\-']{2,50}" required>
                </div>
                                    
                <div class="input__box">
                    <label for="surname">Last Name</label> <!--surname-->
                    <input type="text" name="surname" id="surname" title="Enter a last name (Characters in range 2-50, no digits)" placeholder="Verstappen (Characters in range 2-50, no digits)" pattern="[a-zA-Z\s\.\-']{2,50}" required>
                </div>
                                    
                <div class="input__box">
                    <label for="street">Street</label> <!--street-->
                    <input type="text" name="street" id="street" title="Enter a Street (Characters in range 5-100)" placeholder="Maple Drive (Characters in range 5-100)" pattern=".{5,100}" required>
                </div>

                <div class="input__box">
                    <label for="town">Town</label> <!--town-->
                    <input type="text" name="town" id="town" title="Enter a Town (Characters in range 5-100)" placeholder="Carlow (Characters in range 5-100)" pattern=".{5,100}"required>
                </div>

                <div class="input__box">
                    <label for="county">County</label> <!--county-->
                    <input type="text" name="county" id="county" title="Enter a county (Characters in range 5-100)" placeholder="Carlow (Characters in range 5-100)" pattern=".{5,100}"required>
                </div>

                <div class="input__box">
                    <label for="phoneNum">Phone Number</label> <!--Phonenum-->
                    <input type="text" name="phoneNum" id="phoneNum" title="Enter a phone number (3 digits, 3 d. and 4, with '-' in between)" placeholder="123-456-7890 (3 digits, 3 d. and 4, with '-' in between)" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                </div>

                <div class="input__box">
                    <label for="jobTitle">Job Title</label> <!--jobtitle-->
                    <input type="text" name="jobTitle" id="jobTitle" title="Enter a Job Title (Characters in range 2-50, no digits)" placeholder="Assistant (Characters in range 2-50, no digits)" pattern="[a-zA-Z\s\-]{2,50}" required>
                </div>

                <div class="input__box">
                    <label for="managerStatus">Manager Status</label> <!--managerStatus-->
                    <input type="hidden" name="managerStatus" value="0">
                    
                    <div class="managerS">
                        <input type="checkbox" name="managerStatus" id="managerStatus" value="1">
                        <p class="managersStat"></p>
                    </div>
                </div>

                <div class="input__box">
                    <label for="loginName">Login Name</label> <!--loginName-->
                    <input type="text" name="loginName" id="loginName" title="Enter a Login Name (Characters in range 2-50)" placeholder="Pro_Manager436 (Characters in range 2-50)" pattern=".{2,50}" required>
                </div>
                                    
                <div class="input__box">
                    <label for="password">Password</label> <!--password-->
                    <input type="password" name="password" id="password" title="Enter a Password (Characters in range 5-100)" placeholder="(Characters in range 5-100)" pattern=".{5,100}" required>
                </div>

                <div class="button__box"> <!--Submit and clear form buttons-->
                    <input type="submit" id="submitAddStaff" value = "Add" class="submit" style="display: none;"/>
                    <input type="reset" value="Clear" class="clear"/>
                </div>
            </form>         
        </div>
    </div>
    <?php include 'navbar_staff.php' ?> <!-- Navigation bar file included for the Staff management and for placing an order -->
</main>

<script>

    const managerCheckbox = document.getElementById("managerStatus"); // The M.S. checkbox
    const managerStat = document.querySelector(".managersStat"); // The paragraph that displays the hint message
    updateHint(); // The hint function runs on page load for the initial state

    managerCheckbox.addEventListener("change", updateHint); // Listener for the checkbox

    function updateHint() // Updates the hint text based on the checkbox state
    {
        if (managerCheckbox.checked) 
            {
            managerStat.textContent = "(Manager status is selected)";
            } 
        else 
            {
            managerStat.textContent = "(Manager status is NOT selected)";
            }
    }

    // create constants from the form
    const stockForm = document.getElementById("staffForm");
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
<script src="validation.js"></script>
</body>
</html>