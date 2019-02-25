<?php 
/* Select role */
require_once 'env/environment.php';
require_once 'functions/functions.php';
session_start();

// Check for logged in user
$loggedIn = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Check the user role of the logged in user
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : null;
// Page title
$pageTitle = 'Timesheets';  

// Get the correcct page header depending on the users current role
// If user is not logged in display message to user telling them to log in
if (!isset($loggedIn)){
  echo getHTMLHeader($pageTitle, $loggedIn);
  $errorText = "Sorry you must be logged in to select a user role. Please login <a href='login.php'>here</a> to login to your account. If you don't currently have an account please contacct your system administrator to have one created for you.";

} elseif (isset($userRole) && $userRole == 1){        // User level 
  echo getHTMLUserHeader($pageTitle, $loggedIn);

} elseif (isset($userRole) && $userRole == 2){        // Admin level
  echo getHTMLAdminHeader($pageTitle, $loggedIn);

} else{      // The user is yet to select a role
  //echo getHTMLHeader($pageTitle, $loggedIn);
  echo getHTMLAdminHeader($pageTitle, $loggedIn);
}

?>

<?php

echo getHTMLFooter();