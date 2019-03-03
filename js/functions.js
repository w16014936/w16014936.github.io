/**
 * Created by chris.gooch on 22/02/2019.
 */

"use strict";
var usernameTaken = false;

// ------------------------------------ SIGN UP FORM NAVIGATION ---------------------------- //
// Go to page 2 of the form
function goSignUpPage2() {
    if (validateFormPage1()) {
        console.log("goSignUpPage2 called");
        // Assign relevant elements to variables
        var formPageOneElements = document.getElementsByClassName("formPage1");
        var formPageTwoElements = document.getElementsByClassName("formPage2");

        var goPage1Button = document.getElementById("returnPage1Button");
        var goPage3Button = document.getElementById("goPage3Button");

        var formStepOne = document.getElementById("formStep1");
        var formStepTwo = document.getElementById("formStep2");

        // Hide form page 1 elements + set to not required
        for (var i = 0; i < formPageOneElements.length; i++) {
            formPageOneElements[i].style.display = "none";
            formPageOneElements[i].attributes["required"] = "";

        }

        // Show form page 2 elements & set to required
        for (var x = 0; x < formPageTwoElements.length; x++) {
            formPageTwoElements[x].style.display = "block";
            formPageTwoElements[x].attributes["required"] = "";
        }

        // Set display type of page 1 and page 3 buttons back to inline
        goPage1Button.style.display = "inline";
        goPage3Button.style.display = "inline";

        // Set style of form position icons
        formStepOne.style.backgroundColor = "#bbbbbb";
        formStepTwo.style.backgroundColor = "#007bff";
        return false;
        // Else form invalid so display error
    } else {
        alert("Please check all fields are valid before proceeding to the next page");
    }


}

// Return to page 1 of the form from page 2
function returnPage1() {
    var formPageOneElements = document.getElementsByClassName("formPage1");
    var formPageTwoElements = document.getElementsByClassName("formPage2");

    var goPage2Button = document.getElementById("goPage2Button");

    var formStepOne = document.getElementById("formStep1");
    var formStepTwo = document.getElementById("formStep2");

    // Hide form page 2 elements
    for (var i = 0; i < formPageTwoElements.length; i++) {
        formPageTwoElements[i].style.display = "none";
    }

    // Show form page 1 elements
    for (var x = 0; x < formPageOneElements.length; x++) {
        formPageOneElements[x].style.display = "block";
    }

    // Set display type of page 2 button page 2 button back to inline
    goPage2Button.style.display = "inline";

    formStepOne.style.backgroundColor = "#007bff";
    formStepTwo.style.backgroundColor = "#bbbbbb";
}

// Got to page 3 of the form
function goSignUpPage3() {
    if (validateFormPage2()) {
        var formPageTwoElements = document.getElementsByClassName("formPage2");
        var formPageThreeElements = document.getElementsByClassName("formPage3");

        var goPage2Button = document.getElementById("returnPage2Button");
        var goPage4Button = document.getElementById("goPage4Button");

        var formStepTwo = document.getElementById("formStep2");
        var formStepThree = document.getElementById("formStep3");

        // Hide form page 2 elements
        for (var i = 0; i < formPageTwoElements.length; i++) {
            formPageTwoElements[i].style.display = "none";
        }

        // Show form page 3 elements
        for (var x = 0; x < formPageThreeElements.length; x++) {
            formPageThreeElements[x].style.display = "block";
        }

        goPage2Button.style.display = "inline";
        goPage4Button.style.display = "inline";

        formStepTwo.style.backgroundColor = "#bbbbbb";
        formStepThree.style.backgroundColor = "#007bff";
    } else {
        alert("Please check all fields are valid before proceeding to the next page");
    }

}

// Return to page 2 of the form from page 3
function returnPage2() {
    var formPageTwoElements = document.getElementsByClassName("formPage2");
    var formPageThreeElements = document.getElementsByClassName("formPage3");

    var returnPage1Button = document.getElementById("returnPage1Button");
    var goPage3Button = document.getElementById("goPage3Button");

    var formStepTwo = document.getElementById("formStep2");
    var formStepThree = document.getElementById("formStep3");

    // Hide form page 3 elements
    for (var i = 0; i < formPageThreeElements.length; i++) {
        formPageThreeElements[i].style.display = "none";
    }

    // Show form page 2 elements
    for (var x = 0; x < formPageTwoElements.length; x++) {
        formPageTwoElements[x].style.display = "block";
    }
    // Change display type of buttons back to inline
    returnPage1Button.style.display = "inline";
    goPage3Button.style.display = "inline";

    formStepTwo.style.backgroundColor = "#007bff";
    formStepThree.style.backgroundColor = "#bbbbbb";
}

// Go to page 4 of the form
function goSignUpPage4() {

    if (validateFormPage3()) {
        var formPageThreeElements = document.getElementsByClassName("formPage3");
        var formPageFourElements = document.getElementsByClassName("formPage4");

        var goPage3Button = document.getElementById("returnPage3Button");
        var submitFormButton = document.getElementById("submitFormButton");

        var formStepThree = document.getElementById("formStep3");
        var formStepFour = document.getElementById("formStep4");

        // Hide form page 3 elements
        for (var i = 0; i < formPageThreeElements.length; i++) {
            formPageThreeElements[i].style.display = "none";
        }

        // Show form page 4 elements
        for (var x = 0; x < formPageFourElements.length; x++) {
            formPageFourElements[x].style.display = "block";
        }

        // Set display type of nav/submit buttons back to inline
        goPage3Button.style.display = "inline";
        submitFormButton.style.display = "inline";

        formStepThree.style.backgroundColor = "#bbbbbb";
        formStepFour.style.backgroundColor = "#007bff";
    } else {
        alert("Some fields still invalid");
    }
}

// Return to page 3 of the form from page 4
function returnPage3() {
    var formPageThreeElements = document.getElementsByClassName("formPage3");
    var formPageFourElements = document.getElementsByClassName("formPage4");

    var returnPage2Button = document.getElementById("returnPage2Button");
    var goPage4Button = document.getElementById("goPage4Button");

    var formStepThree = document.getElementById("formStep3");
    var formStepFour = document.getElementById("formStep4");

    // Hide form page 4 elements
    for (var i = 0; i < formPageFourElements.length; i++) {
        formPageFourElements[i].style.display = "none";
    }

    // Shot form page 3 elements
    for (var x = 0; x < formPageThreeElements.length; x++) {
        formPageThreeElements[x].style.display = "block";
    }

    // Change display type of buttons back to inline
    returnPage2Button.style.display = "inline";
    goPage4Button.style.display = "inline";

    formStepThree.style.backgroundColor = "#007bff";
    formStepFour.style.backgroundColor = "#bbbbbb";

}


// ----------------------------------- END SIGN UP FORM NAVIGATION ---------------------------------- //


//-------------------------------- SIGN UP FORM VALIDATION ----------------------------------------- //
// Returns true if first page of form is valid
function validateFormPage1() {
    // If username taken or password invalid, return false
    if (checkUsernameTaken() || !validatePassword()) {
        return false;
    } else {
        return true;
    }
}

// Checks if the inputted username has already been taken
// Add appropriate styling if taken
function checkUsernameTaken() {
    var inputtedUsername = document.getElementById("signUp-username");
    var usernameValidationMsg = document.getElementById("usernameValidationMsg");

    // Ajax check if username already exists in the database
    // Returns true if taken, false if available
    // Do ajax call
    $.ajax({
        method: "POST",
        url: 'getUsers.php',
        contentType: "application/json",
        response: "data",
        dataType: "json",
        success: checkUsernameTaken
        // On complete...
    }).done(function (data, status, jqxhr) {
        // Iterate through results and check if inputted username already exists
        for (var dbEntry in data) {
            // If exists, return true and exit loop
            if (inputtedUsername.value == data[dbEntry].value) {
                inputtedUsername.style.borderColor = "#f20014";
                usernameValidationMsg.innerHTML = "Username is already taken &#10008";
                usernameValidationMsg.style.display = "block";
                usernameTaken = true;
                break;
                // Else if username left blank, return true and exit loop
            } else if (inputtedUsername.value == null || inputtedUsername.value == "") {
                inputtedUsername.style.borderColor = "#f20014";
                usernameValidationMsg.innerHTML = "Username cannot be left blank &#10008";
                usernameValidationMsg.style.display = "block";
                usernameTaken = true;
                break;
                // Else username is OK, return false
            } else {
                inputtedUsername.style.borderColor = "#0a9800";
                usernameValidationMsg.innerHTML = "Username is available &#10004";
                usernameValidationMsg.style.display = "block";
                usernameTaken = false;
            }
        }
    });

    return usernameTaken;
}

// Checks if password and confirm password fields match
// Returns true if matching
function validatePassword() {
    var password = document.getElementById("signUp-pass");
    var confirmPassword = document.getElementById("signUp-confirmPass");
    var passwordValidationMsg = document.getElementById("passwordValidationMsg");
    var passwordsMatching = false;

    doValidation();

    // doValidation on key press of password or confirm password form fields
    password.onkeyup = doValidation;
    confirmPassword.onkeyup = doValidation;

    // Check passwords match and not blank
    function doValidation() {
        // If passwords not matching
        if (password.value != confirmPassword.value) {
            password.style.borderColor = "#f20014";
            confirmPassword.style.borderColor = "#f20014";
            passwordValidationMsg.innerHTML = "Passwords must be matching &#10008";
            passwordValidationMsg.style.display = "block";
            passwordsMatching = false;
            // else if password field left blank
        } else if (password.value == null || password.value == "") {
            password.style.borderColor = "#f20014";
            confirmPassword.style.borderColor = "#f20014";
            passwordValidationMsg.innerHTML = "Password cannot be left blank &#10008";
            passwordValidationMsg.style.display = "block";
            passwordsMatching = false;
        } // else passwords are OK
        else {
            console.log("Password value:" + password.value);
            console.log("Confirm Pass Value:" + confirmPassword.value);
            password.style.borderColor = "#0a9800";
            confirmPassword.style.borderColor = "#0a9800";
            passwordValidationMsg.innerHTML = "Passwords OK &#10004";
            passwordValidationMsg.style.display = "block";
            passwordsMatching = true;
        }
    }

    return passwordsMatching;
}

// Checks all fields in page 2 of the form are valid, return true if valid
function validateFormPage2() {

    // Assign relevant form elements to variables
    var forename = document.getElementById("signUp-forename");
    var surname = document.getElementById("signUp-surname");
    var dateOfBirth = document.getElementById("signUp-dateOfBirth");
    var email = document.getElementById("signUp-email");
    var phone = document.getElementById("signUp-phone");

    // Assign validate error message elements to variables
    var forenameValidationMsg = document.getElementById("forenameValidationMsg");
    var surnameValidationMsg = document.getElementById("surnameValidationMsg");
    var DOBValidationMsg = document.getElementById("DOBValidationMsg");
    var emailValidationMsg = document.getElementById("emailValidationMsg");
    var phoneValidationMsg = document.getElementById("phoneValidationMsg");

    // run relevant validation on keyup of respective element
    forename.onkeyup = validateforename;
    surname.onkeyup = validateSurname;
    dateOfBirth.onchange = validateDateOfBirth;
    email.onkeyup = validateEmail;
    phone.onkeyup = validatePhone;

    // Do initial call to functions
    validateforename();
    validateSurname();
    validateDateOfBirth();
    validateEmail();
    validatePhone();

    // Check forename not null
    function validateforename() {
        // Change border of field to red if left blank, else change to green
        if (forename.value == null || forename.value == "") {
            forename.style.borderColor = "#f20014";
            forenameValidationMsg.innerHTML = "This field cannot be left blank &#10008";
            forenameValidationMsg.style.display = "block";
            return true;
        } else {
            forename.style.borderColor = "#0a9800";
            forenameValidationMsg.innerHTML = "Field is OK &#10004";
            forenameValidationMsg.style.display = "block";
            return false;
        }
    }

    // Check surname not null
    function validateSurname() {
        // Change border of field to red if left blank, else change to green
        if (surname.value == null || surname.value == "") {
            surname.style.borderColor = "#f20014";
            surnameValidationMsg.innerHTML = "This field cannot be left blank &#10008";
            surnameValidationMsg.style.display = "block";
            return true;
        } else {
            surname.style.borderColor = "#0a9800";
            surnameValidationMsg.innerHTML = "Field is OK &#10004";
            surnameValidationMsg.style.display = "block";
            return false;
        }
    }

    // Check DOB not null
    function validateDateOfBirth() {
        // Change border of field to red if left blank, else change to green
        if (dateOfBirth.value == null || dateOfBirth.value == "") {
            dateOfBirth.style.borderColor = "#f20014";
            DOBValidationMsg.innerHTML = "This field cannot be left blank &#10008";
            DOBValidationMsg.style.display = "block";
            return true;
        } else {
            dateOfBirth.style.borderColor = "#0a9800";
            DOBValidationMsg.innerHTML = "Field is OK &#10004";
            DOBValidationMsg.style.display = "block";
            return false;
        }
    }

    // Check Email not null
    function validateEmail() {
        // Change border of field to red if left blank, else change to green
        if (email.value == null || email.value == "") {
            email.style.borderColor = "#f20014";
            emailValidationMsg.innerHTML = "This field cannot be left blank &#10008";
            emailValidationMsg.style.display = "block";
            return true;
        } else {
            email.style.borderColor = "#0a9800";
            emailValidationMsg.innerHTML = "Field is OK &#10004";
            emailValidationMsg.style.display = "block";
            return false;
        }
    }

    // Check phone number not null
    function validatePhone() {
        // Change border of field to red if left blank, else change to green
        if (phone.value == null || phone.value == "") {
            phone.style.borderColor = "#f20014";
            phoneValidationMsg.innerHTML = "This field cannot be left blank &#10008";
            phoneValidationMsg.style.display = "block";
            return true;
        } else {
            phone.style.borderColor = "#0a9800";
            phoneValidationMsg.innerHTML = "Field is OK &#10004";
            phoneValidationMsg.style.display = "block";
            return false;
        }
    }

    // Return false if validation errors, else return true
    if (validateforename() || validateSurname() || validateDateOfBirth() || validateEmail() || validatePhone()) {
        console.log("Validation errors");
        console.log(forename.value);
        console.log(surname.value);
        console.log(dateOfBirth.value);
        console.log(email.value);
        console.log(phone.value);
        return false;
    } else {
        return true;
    }

}

// Checks all fields in page 3 of the form are valid, return true if valid
function validateFormPage3() {

    // Assign relevant form elements to variables
    var address1 = document.getElementById("signUp-address1");
    var postCode = document.getElementById("signUp-postcode");

    // Assign validate error message elements to variables
    var address1ValidationMsg = document.getElementById("address1ValidationMsg");
    var postCodeValidationMsg = document.getElementById("postCodeValidationMsg");

    // run relevant validation of keyup of respective element
    address1.onkeyup = validateAddress1;
    postCode.onkeyup = validatePostCode;

    // Do initial call to functions
    validateAddress1();
    validatePostCode();

    // Check address 1 not null
    function validateAddress1() {
        if (address1.value == null || address1.value == "") {
            address1.style.borderColor = "#f20014";
            address1ValidationMsg.innerHTML = "This field cannot be left blank &#10008";
            address1ValidationMsg.style.display = "block";
            return true;
        }
        else {
            address1.style.borderColor = "#0a9800";
            address1ValidationMsg.innerHTML = "Field is OK &#10004";
            address1ValidationMsg.style.display = "block";
            return false;
        }
    }

    // Check post code not null
    function validatePostCode() {
        if (postCode.value == null || postCode.value == "") {
            postCode.style.borderColor = "#f20014";
            postCodeValidationMsg.innerHTML = "This field cannot be left blank &#10008";
            postCodeValidationMsg.style.display = "block";
            return true;
        } else {
            postCode.style.borderColor = "#0a9800";
            postCodeValidationMsg.innerHTML = "Field is OK &#10004";
            postCodeValidationMsg.style.display = "block";
            return false;
        }
    }

    // If field validation fails, return false
    if (validateAddress1() || validatePostCode()) {
        return false;
    } else { // Else validation passed, return true
        return true;
    }

    // Return false if validation errors, else return true
}

function validateFormPage4() {

    // Assign relevant form elements to variables
    var contractedHours = document.getElementById("contractedHours");

    // Assign validate error message elements to variables
    var contractedHoursValidationMsg = document.getElementById("contractedHoursValidationMsg");

    // Run relevant validation of keyup of respective elements
    contractedHours.onchange = validateContractedHours;
    contractedHours.onkeyup = validateContractedHours;

    // Do initial call to functions
    validateContractedHours();

    function validateContractedHours() {
        if (contractedHours.value == null || contractedHours.value == "") {
            contractedHours.style.borderColor = "#f20014";
            contractedHoursValidationMsg.innerHTML = "This field cannot be left blank &#10008";
            contractedHoursValidationMsg.style.display = "block";
            return true;
        } else if (isNaN(contractedHours.value)) {
            contractedHours.style.borderColor = "#f20014";
            contractedHoursValidationMsg.innerHTML = "You must enter a number &#10008";
            contractedHoursValidationMsg.style.display = "block";
            return true;
        } else {
            contractedHours.style.borderColor = "#0a9800";
            contractedHoursValidationMsg.innerHTML = "Field is OK &#10004";
            contractedHoursValidationMsg.style.display = "block";
            return false;
        }
    }

    // If validation fails, return false
    if (validateContractedHours()) {
        return false;
    } else { // Else validation passed, return true
        return true;
    }

}

// -------------------------------- END SIGN UP FORM VALIDATION ---------------------------------- //


// ----------------------------------- SUBMIT FORM --------------------------------------------//
function submitForm() {
    var signUpForm = document.getElementById("signUpForm");
    if (validateFormPage4()) {
        alert("Form submitted!");
        signUpForm.submit();
    } else {
        alert("Some fields still invalid");
    }
}


// --------------------------------- END SUBMIT FORM -----------------------------------------//
