/**
 * Created by chris.gooch on 22/02/2019.
 */

"use strict";

// Customise the validation messages for the contact us form
function customFormValidation(element1, element2, element3, element4, validationMessage1, validationMessage2,
                              validationMessage3, validationMessage4) {

    // Set custom form validation messages
    var input1 = document.getElementById(element1),
        input2 = document.getElementById(element2),
        input3 = document.getElementById(element3),
        input4 = document.getElementById(element4);

    // Trigger validateForm() on field change
    input1.onkeyup = validateForm;
    input2.onkeyup = validateForm;
    input3.onkeyup = validateForm;
    input3.onkeyup = validateForm;

    // Default custom messages
    input1.setCustomValidity(validationMessage1);
    input2.setCustomValidity(validationMessage2);
    input3.setCustomValidity(validationMessage3);
    input3.setCustomValidity(validationMessage4);

    // Set/remove messages if fields blank/not blank
    function validateForm() {
        console.log(input3.value);
        if (input1.value == null || input1.value == "") {
            input1.setCustomValidity(validationMessage1);
        } else if (input1.value != null) {
            input1.setCustomValidity("");
        }
        if (input2.value == null || input2.value == "") {
            input2.setCustomValidity(validationMessage2);
        } else if (input2.value != null) {
            input2.setCustomValidity("");
        }
        if (input3.value == null || input3.value == "") {
            input3.setCustomValidity(validationMessage3);
            console.log("pass empty");
        } else if (input3.value != null) {
            input3.setCustomValidity("");
            console.log("pass not empty");
        }
        if (input4.value == null || input3.value == "") {
            input4.setCustomValidity(validationMessage4);
        } else if (input4.value != null) {
            input4.setCustomValidity("");
        }
    }
}

function signUpFormValidation() {
    var signUpUsername = document.getElementById("signUp-username"),
        signUpEmail = document.getElementById("signUp-emailAddress");

    signUpUsername.onkeyup = validateSignUpForm();
    signUpEmail.onkeyup = validateSignUpForm();

    // Default custom messages
    var usernamePrompt = "Please enter a username to be associated with your account";
    var emailPrompt = "Please enter an Email address to be associated with your account";
    signUpUsername.setCustomValidity(usernamePrompt);
    signUpEmail.setCustomValidity(emailPrompt);

    // Set/remove messages if fields blank/not blank
    function validateSignUpForm() {
        if (signUpUsername.value == null || signUpUsername.value == "") {
            signUpUsername.setCustomValidity(usernamePrompt);
        } else if (signUpUsername.value != null) {
            signUpUsername.setCustomValidity("");
        }
        if (signUpEmail.value == null || signUpEmail.value == "") {
            signUpEmail.setCustomValidity(emailPrompt);
        } else if (signUpEmail.value != null) {
            signUpEmail.setCustomValidity("");
        }
    }
}

// Checks if password and confirm password fields match
function validatePassword(passwordID, confirmPasswordID, validationMessage) {
    var password = document.getElementById(passwordID);
    var confirmPassword = document.getElementById(confirmPasswordID);

    doValidation();

    password.onkeyup = doValidation;
    confirmPassword.onkeyup = doValidation;

    function doValidation() {
        if (password.value != confirmPassword.value) {
            confirmPassword.setCustomValidity(validationMessage);
        } else {
            confirmPassword.setCustomValidity("");
        }
    }


}