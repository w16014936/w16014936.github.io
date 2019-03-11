<?php
/**
 * Created by PhpStorm.
 * User: chris.gooch
 * Date: 01/03/2019
 * Time: 11:38
 */

require_once 'env/environment.php';
require_once 'functions/functions.php';
require_once 'class/PDODB.php';
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
$dbConn = PDODB::getConnection();

// POST Retrieval of form input
$username = trim(filter_has_var(INPUT_POST, 'username') ? $_POST['username'] : null);
$password = trim(filter_has_var(INPUT_POST, 'password') ? $_POST['password'] : null);
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$title = trim(filter_has_var(INPUT_POST, 'title') ? $_POST['title'] : null);
$forename = trim(filter_has_var(INPUT_POST, 'forename') ? $_POST['forename'] : null);
$surname = trim(filter_has_var(INPUT_POST, 'surname') ? $_POST['surname'] : null);
$dateOfBirth = trim(filter_has_var(INPUT_POST, 'dateOfBirth') ? $_POST['dateOfBirth'] : null);
$email = trim(filter_has_var(INPUT_POST, 'email') ? $_POST['email'] : null);
$phone = trim(filter_has_var(INPUT_POST, 'phone') ? $_POST['phone'] : null);
$address1 = trim(filter_has_var(INPUT_POST, 'address1') ? $_POST['address1'] : null);
$address2 = trim(filter_has_var(INPUT_POST, 'address2') ? $_POST['address2'] : null);
$address3 = trim(filter_has_var(INPUT_POST, 'address3') ? $_POST['address3'] : null);
$address4 = trim(filter_has_var(INPUT_POST, 'address4') ? $_POST['address4'] : null);
$address5 = trim(filter_has_var(INPUT_POST, 'address5') ? $_POST['address5'] : null);
$postcode = trim(filter_has_var(INPUT_POST, 'postcode') ? $_POST['postcode'] : null);
$departmentID = trim(filter_has_var(INPUT_POST, 'departmentID') ? $_POST['departmentID'] : null);
$teamID = trim(filter_has_var(INPUT_POST, 'teamID') ? $_POST['teamID'] : null);
$jobID = trim(filter_has_var(INPUT_POST, 'jobID') ? $_POST['jobID'] : null);
$contractedHours = trim(filter_has_var(INPUT_POST, 'contractedHours') ? $_POST['contractedHours'] : null);


// ---------------------- INSERT USER INTO TIMESHEETS USER ------------------ //
// Create SQL query
$createUserSQL = "INSERT INTO timesheets_user (username, passwordHash)
             VALUES('$username', '$hashedPassword')";
// Prepare the SQL statement and store the result in $sql
$createUserStmt = $dbConn->prepare($createUserSQL);
// Execute the prepared statement
$createUserStmt->execute();



// ------------------------ GET USER ID OF USER JUST CREATED ------------------ //
// Get userID of user just created
$getUserIDSQL = "SELECT userID
                FROM timesheets_user
                WHERE username = '$username'";

$getUserStmt = $dbConn->prepare($getUserIDSQL);
$getUserStmt->execute();
$row = $getUserStmt->fetchObject();

$userID = $row->userID;

echo("User ID is: ".$userID);




// ------------------------- INSERT PERSON INTO TIMESHEETS PERSON ---------------------- //
// Create SQL query
$createPersonSQL = "INSERT INTO timesheets_person(user_id, job_id, team_id, department_id, contracted_hours, title,
 forename, surname, phone_number, email, address_line_1, address_line_2, address_line_3, address_line_4, 
 address_line_5, post_code, date_of_birth)
             VALUES('$userID', '$jobID','$teamID','$departmentID','$contractedHours','$title','$forename','$surname'
             '$phone','$email','$address1','$address2','$address3','$address4','$address5','$postcode',
             '$dateOfBirth')";
// Prepare the SQL statement and store the result in $sql
$createPersonStmt = $dbConn->prepare($createPersonSQL);
// Execute the prepared statement
$createPersonStmt->execute();





// If the password is a match
if (password_verify("pass", $hashedPassword)) {
    echo("Working");
} else {
    echo("Not working");
}


echo("Inputted Username: " . $username);

?>


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