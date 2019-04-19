<?php 
/* Manage Timesheet 
 * admin page
 * requires logged on
*/
require_once 'env/environment.php';
require_once 'functions/functions.php';
require_once 'class/PDODB.php';
session_start();

// Function to get all of the details for timesheets 
function getTimesheetTable($dbConn, $loggedIn = null){
    // Try to carry out the database entries
    try{
        $sqlQuery = "SELECT timesheet_id,
                            timesheets_timesheet.date,
                            CONCAT(timesheets_person.forename, ' ', timesheets_person.surname) AS user_name,
                            activity_type,
                            project_name,
                            time_in,
                            time_out,
                            note
                    FROM timesheets_timesheet
                    JOIN timesheets_person ON timesheets_person.user_id = timesheets_timesheet.user_id 
                    JOIN timesheets_activity ON timesheets_activity.activity_id = timesheets_timesheet.activity_id 
                    JOIN timesheets_project ON timesheets_project.project_id = timesheets_timesheet.project_id 
                ORDER BY YEAR(timesheets_timesheet.date) DESC, MONTH(timesheets_timesheet.date) DESC, DAY(timesheets_timesheet.date) DESC,
                        timesheets_person.surname ASC";

        // Prepare the query
        $stmt = $dbConn->prepare($sqlQuery);

        // Execute the query
        $stmt->execute();

        // Set the mode to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Place all of the records in variable
        $timesheetResults = $stmt->fetchAll();

        // Check the query returned some results
        if($stmt->rowCount() > 0){
            $timesheets =  "<div class='table-responsives'>
                        <table class='table table-dark' >
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>User</th>
                              <th>Activity</th>
                              <th>Project</th>
                              <th>Time In</th>
                              <th>Time Out</th>
                            </tr>
                          </thead>
                          <tbody>";

            foreach ($timesheetResults as $result){
                // timesheet Id
                $timesheet_id = htmlspecialchars($result['timesheet_id']);
                $date = htmlspecialchars($result['date']);
                $user_name = htmlspecialchars($result['user_name']);
                $activity_type = htmlspecialchars($result['activity_type']);
                $project_name = htmlspecialchars($result['project_name']);
                $time_in = htmlspecialchars($result['time_in']);
                $time_out = htmlspecialchars($result['time_out']);


                $timesheets .= "<tr>
                          <td>$date</td>
                          <td>$user_name</td>
                          <td>$activity_type</td>
                          <td>$project_name</td>
                          <td>$time_in</td>
                          <td>$time_out</td>

                          <td class='actions'>
                            <a href='edit-timesheet.php?timesheet_id=$timesheet_id' title='Edit'><i class='fas fa-pencil-alt action-icon' ></i></a>
                            <a href='delete-timesheet.php?timesheet_id=$timesheet_id' title='Delete'><i class='fas fa-times action-icon'></i></a>
                          </td>
                        </tr>";

            }
            // Close the table and div
            $timesheets .= "</tbody>
                    </table>
                  </div>";

        } else{
            $timesheets = null;
        }

    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";
        $timesheets = null;
    }

    return $timesheets;
}

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