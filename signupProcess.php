<?php
/**
 * Created by PhpStorm.
 * User: chris.gooch
 * Date: 01/03/2019
 * Time: 11:38
 */

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




<?php
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p class='error'>$error</p>";

    }
}
?>

<?php

echo getHTMLFooter();
