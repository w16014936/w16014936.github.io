<?php 
/* Manage Timesheet 
 * admin page
 * requires logged on
*/
require_once 'env/environment.php';
require_once 'class/PDODB.php';
require_once 'functions/functions.php';
require_once 'functions/timesheet-functions.php';
session_start();

// Attempt to make connection to the database
$dbConn = PDODB::getConnection();

// Check for logged in user
$loggedIn = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Page title
$pageTitle = 'Manage Timesheet';  

// Check the user role of the logged in user
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// Get the correcct page header depending on the users current role
// If user is not logged in display message to user telling them to log in
if (!isset($loggedIn)){
  echo getHTMLHeader($pageTitle, $loggedIn);
  $errorText = "Sorry you must be logged to access this page. Please login <a href='login.php'>here</a> to login to your account. If you don't currently have an account please contact your system administrator to have one created for you.";
  
} elseif (isset($userRole) && $userRole == 2){        // User level 
  echo getHTMLUserHeader($pageTitle, $loggedIn);
  $errorText = "Sorry you do not have the correct permissions to access this page. Please select a different role <a href='select-role.php'>here</a> to change your account role.";

} elseif (isset($userRole) && $userRole == 1){        // Admin level
  echo getHTMLAdminHeader($pageTitle, $loggedIn);
    
} else{
  echo getHTMLHeader($pageTitle, $loggedIn);
  $errorText = "Sorry you do not have the correct permissions to access this page. Please select a different role <a href='select-role.php'>here</a> to change your account role.";
}
  
?>
<div class="jumbotron text-center">
  <h1><?php echo $pageTitle;?></h1>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-12">
    <?php

    // If not logged in show text
    if (isset($errorText)){
      echo "<p>$errorText</p>";

    } else{
        // The main page content if user has correct permissions
        echo $content = !empty(getTimesheetTable($dbConn, $loggedIn)) ? getTimesheetTable($dbConn, $loggedIn) : "<p class='no-results'>There are currently no timesheets in the system.</p>";
    }

    ?>
    </div>
  </div>
</div>
<?php
echo getHTMLFooter();
getHTMLEnd();