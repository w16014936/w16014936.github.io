<?php
require_once 'env/environment.php';
require_once 'functions/functions.php';
session_start();

// Check for logged in user
$loggedIn = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Check the user role of the logged in user
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : null;
// Page title
$pageTitle = 'Timesheets';

// Get the correct page header depending on the users role and wheter or not they are logged in
if (!isset($loggedIn)) {
    echo getHTMLHeader($pageTitle, $loggedIn);

} elseif (isset($userRole) && $userRole == 1) {
    echo getHTMLUserHeader($pageTitle);

} elseif (isset($userRole) && $userRole == 2) {
    echo getHTMLAdminHeader($pageTitle);

} else {
    echo getHTMLHeader($pageTitle, $loggedIn);
}

// Creates connection to database
$db = getConnection();

?>
    <div class="jumbotron text-center">
        <?php
        // Create heading depending on chosen account type
        $accountType = filter_has_var(INPUT_GET, "accountType") ? $_GET["accountType"] : null;
        if (!isset($accountType)) {
            echo("<h1>Sign up for a free account</h1>");
        } else if ($accountType == 1) {
            echo("<h1>Sign up for a free account</h1>");
        } else if ($accountType == 2) {
            echo("<h1>Sign up for a pro account");
        } else {
            echo("<h1>Sign up for a free account</h1>");
        }
        ?>
    </div>


<?php
echo('
<div class="container">
<h4 class="formPage1 formTitles">Please enter a username and password:</h4>
<h4 id="formPage2Title" class="formPage2 formTitles" style="display: none">Please enter your personal information:</h4>
<h4 class="formPage3 formTitles" style="display: none">Please enter your address details:</h4>
<br>
        <div class="row justify-content-center align-items-center">
           
            <div class="col-sm-4">
                <form onsubmit="" action="signupProcess.php" id="signUpForm" class="form" name="signupForm" method="POST">
                    <!---------------------- Start form page 1 ----------------------->
                    <div class="formPage1" id="formPage1">
                    <div class="form-group">
                        <input type="text" id="signUp-username" class="form-control" placeholder="Username"
                               name="username" />
                               <p id="usernameValidationMsg" class="formPage1 formErrorMessages" style="display: none"></p>
                    </div>
                    <div class="form-group">
                        <input type="password" id="signUp-pass" class="form-control" placeholder="Password"
                               name="password"
                               />
                               <p id="passwordValidationMsg" class="formPage1 formErrorMessages" style="display: none">Passwords must be matching &#10008</p>
                    </div>
                    <div class="form-group">
                        <input type="password" id="signUp-confirmPass" class="form-control"
                               placeholder="Confirm Password"
                               name="confirmPassword" />
                    </div>
                    <div class="login-error">
                    </div>
                    
                    <span onclick="goSignUpPage2(); validateFormPage2()" id="goPage2Button" class="formButtons formPage1">Go to page 2</span>
                    
                    </div>
                    <!--------------------- End form page 1 ----------------------->
                    
                    
                    <!-------------------- Start form page 2 ---------------------->
                    <div class="formPage2" id="formPage2" style="display: none">
                    <div class="form-group">
                        <select class="form-control" name="title">
                            <option value="Miss">Miss</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Ms">Ms</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" id="signUp-forename" class="form-control" placeholder="Forename"
                               name="forename" />
                               <p id="forenameValidationMsg" class="formPage2 formErrorMessages" style="display: none"></p>
                    </div>
                    <div class="form-group">
                        <input type="text" id="signUp-surname" class="form-control" placeholder="Surname"
                               name="surname" />
                               <p id="surnameValidationMsg" class="formPage2 formErrorMessages" style="display: none"></p>
                    </div>
                    <div class="form-group">
                        <input type="date" id="signUp-dateOfBirth" class="form-control" placeholder="Date of Birth"
                               name="dateOfBirth" />
                               <p id="DOBValidationMsg" class="formPage2 formErrorMessages" style="display: none"></p>
                    </div>
                    <div class="form-group">
                        <input type="text" id="signUp-email" class="form-control" placeholder="Email Address"
                               name="email" />
                               <p id="emailValidationMsg" class="formPage2 formErrorMessages" style="display: none"></p>
                    </div>
                    <div class="form-group">
                        <input type="number" id="signUp-phone" class="form-control" placeholder="Phone Number"
                               name="phone" />
                               <p id="phoneValidationMsg" class="formPage2 formErrorMessages" style="display: none"></p>
                    </div>
                    
                    
                    <span onclick="returnPage1()" id="returnPage1Button" class="formButtons formPage2">Go to page 1</span>
                    <span onclick="goSignUpPage3()" id="goPage3Button" class="formButtons formPage2">Go to page 3</span>
                    </div>           
                    <!---------------------- End form page 2 ------------------------>
                    
                    
                    
                    <!---------------- Start form page 3 --------------------------->
                   <div class="formPage3" id="formPage3" style="display: none">
                   <div class="form-group">
                        <input type="text" id="signUp-address1" class="form-control" placeholder="Address Line 1"
                               name="address1" />
                               <p id="address1ValidationMsg" class="formPage3 formErrorMessages" style="display: none"></p>
                    </div>
                    <div class="form-group">
                        <input type="text" id="signUp-address2" class="form-control" placeholder="Address Line 2 (Optional)"
                               name="address2" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="signUp-address3" class="form-control" placeholder="Address Line 3 (Optional)"
                               name="address3" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="signUp-address4" class="form-control" placeholder="Address Line 4 (Optional)"
                               name="address4" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="signUp-address5" class="form-control" placeholder="Address Line 5 (Optional)"
                               name="address5" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="signUp-postcode" class="form-control" placeholder="Post Code"
                               name="postcode" />
                               <p id="postCodeValidationMsg" class="formPage3 formErrorMessages" style="display: none"></p>
                    </div>
                   
                   <span onclick="returnPage2()" id="returnPage2Button" class="formButtons formPage3">Go to page 2</span>
                   <span onclick="goSignUpPage4()" id="goPage4Button" class="formButtons formPage3">Go to page 4</span>
                   </div>
                   <!------------------- End form page 3 ------------------------->
                   
                   <!------------------- Start form page 4 --------------------->
                   <div class="formPage4" id="formPage4" style="display:none">
                   <div class="form-group">
                        <select class="form-control" name="jobID">
                            <option value="1">Job 1</option>
                            <option value="2">Job 2</option>
                            <option value="3">Job 3</option>
                            <option value="4">Job 4</option>
                        </select>
                   </div>
                   <div class="form-group">
                        <input type="number" min="0" id="contractedHours" class="form-control" placeholder="Contracted Hours"
                               name="contractedHours" />
                               <p id="contractedHoursValidationMsg" class="formPage4 formErrorMessages" style="display: none"></p>
                   </div>
                   <div class="form-group">
                       <select class="form-control" name="teamID">
                            <option value="1">Team 1</option>
                            <option value="2">Team 2</option> 
                            <option value="3">Team 3</option> 
                            <option value="4">Team 4</option>
                       </select>
                   </div>
                   <div class="form-group">
                       <select class="form-control" name="departmentID">
                            <option value="1">Department 1</option>
                            <option value="2">Department 2</option> 
                            <option value="3">Department 3</option> 
                            <option value="4">Department 4</option>
                       </select>
                   </div>
                  <span onclick="returnPage3()" id="returnPage3Button" class="formButtons formPage4">Go to page 3</span>
                  <span onclick="submitForm()" id="submitFormButton" class="formButtons formPage4">Submit Form</span>
                   
                   </div>
                   <!------------------ End form page 4 --------------------->
                   
                   
                   
                   
                
                </form>
            </div> 
        </div>
            <div class="col-sm-4"></div>
        </div>
    
    <div id="formStepsContainer">
        <span style="background-color: #007bff" id="formStep1" class="formSteps"></span>
        <span id="formStep2" class="formSteps"></span>
        <span id="formStep3" class="formSteps"></span>
        <span id="formStep4" class="formSteps"></span>
    </div>
');

?>

    <script>    // Prevents the form from being submitted
        $("#signUpForm").submit(function (e) {
            e.preventDefault();
        });

        // Do initial validation to change form field border colours on page load
        checkUsernameTaken();
        validatePassword();
        validateFormPage2();
        validateFormPage3();
        validateFormPage4();
    </script>


<?php
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p class='error'>$error</p>";

    }
}
?>

<?php

echo getHTMLFooter();
getHTMLEnd();