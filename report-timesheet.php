<?php
/* Timesheet Reports
 * admin page
 * requires logged on
*/
require_once 'env/environment.php';
require_once 'functions/functions.php';
require_once 'class/PDODB.php';
session_start();

// Attempt to make connection to the database
$dbConn = PDODB::getConnection();

// Check for logged in user
$loggedIn = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Page title
$pageTitle = 'Report Timesheet';  

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
<?php

// If not logged in show text
if (isset($errorText)){
	echo "<p>$errorText</p>";

} else{
	// The main page content if user has correct permissions
	?>
    <div class="row">
        <div id="reportConfigContainer" class="col-md-2">
            <h4 class="blockquote text-center">Report Configuration</h4>
            <div class="reportConfig form-group row">
                <label class="col-sm-4 col-form-label">Start Date:</label>
                <div class="col-sm-8">
                    <input type="date" name="startDate" id="startDate" class="form-control">
                </div>
            </div>
            <div class="reportConfig form-group row">
                <label class="col-sm-4 col-form-label">End Date:</label>
                <div class="col-sm-8">
                    <input type="date" name="endDate" id="endDate" class="form-control">
                </div>
            </div>
            <div class="reportConfig form-group row">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="department">Department</label>
                </div>
                <select class="custom-select" id="department">
                    <option value="all">All</option>
                </select>
            </div>
            <div class="reportConfig form-group row">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="project">Project</label>
                </div>
                <select class="custom-select" id="project">
                    <option value="all">All</option>
                </select>
            </div>
            <div class="reportConfig form-group row">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="type">Chart Type</label>
                </div>
                <select class="custom-select" id="type">
                    <option value="line">Line</option>
                    <option value="bar">Vertical Bar</option>
                    <option value="polarArea">Polar Area</option>
                    <option value="radar">Radar</option>
                </select>
            </div>
            <div class="reportConfig form-group row">
                <legend class="col-form-label col-sm-4 pt-0">High Contrast:</legend>
                <div class="col-sm-8">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="highContrast" id="highContrastTrue">
                        <label class="form-check-label">
                            Yes
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="highContrast" id="highContrastFalse" checked>
                        <label class="form-check-label">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="reportConfig form-group row" id="stackRadio">
                <legend class="col-form-label col-sm-4 pt-0">Stack data:</legend>
                <div class="col-sm-8">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="stack" id="stackTrue" checked>
                        <label class="form-check-label">
                            Yes
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="stack" id="stackFalse">
                        <label class="form-check-label">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div id ="smoothLines" class="reportConfig form-group row" id="smoothLines">
                <legend class="col-form-label col-sm-4 pt-0">Line Stiffness:</legend>
                <div class="col-sm-8">
                    <input id="smoothLineSlider" class="form-control-range" type="range" value="0.5" min="0.25" max="1" step="0.01">
                </div>
            </div>
            <div id ="pointRadius" class="reportConfig form-group row">
                <legend class="col-form-label col-sm-4 pt-0">Point Radius:</legend>
                <div class="col-sm-8">
                    <input id="pointRadiusSlider" class="form-control-range" type="range" value="5" min="0" max="10" step="1">
                </div>
            </div>
            <div class="reportConfig form-group row"  id="fillSpace">
                <legend class="col-form-label col-sm-4 pt-0">Fill space:</legend>
                <div class="col-sm-8">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="fillLines" id="fillTrue"  class="form-control" checked>
                        <label class="form-check-label">
                            Yes
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="fillLines" id="fillFalse" checked>
                        <label class="form-check-label">
                            No
                        </label>
                    </div>
                </div>
            </div>

            <div class="reportConfig form-group row">
                <button id="reportUpdate" class="btn btn-secondary btn-lg btn-block">Generate Graph</button>
            </div>
        </div>
        <div id="reportCanvas" class="col-md-10">
            <canvas id="canvas"></canvas>
        </div>
    </div>
    <?php
}
echo getHTMLFooter();

?>
<script src="js/utils.js"></script>
<script src="js/libraries/Chart.min.js" type="text/javascript"></script>
<script src="js/graphs.js" type="text/javascript"></script>
<?php
echo getHTMLEnd();